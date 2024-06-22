/**
 * ClassicBlockTransformer upgrades classic content on the current document into
 * Gutenberg Blocks.
 *
 * Props: Ty Bailey & Gutenberg Core
 */
class ClassicBlockTransformer {
	/**
	 * Saves a local wp object for later lookup.
	 */
	constructor() {
		this.wp = window.wp;
		this.didTransform = false;
	}

	/**
	 * Runs the Classic to Gutenberg Block transform on the current document.
	 *
	 * @returns {boolean} The result of the transformation.
	 */
	async execute() {
		const coreEditor = this.wp.data.select('core/block-editor');
		const blocks = coreEditor.getBlocks();

		if (this.validBlocks(blocks)) {
			/* Currently set to do 3 levels of recursion */
			await this.convertBlocks(blocks, 1, 3);
		}

		return this.didTransform;
	}

	/**
	 * Converts the specified blocks and it's nested blocks if within
	 * the depth constraints.
	 *
	 * Note: This function is called recursively. Specifying a very high
	 * maxDepth can crash the browser.
	 *
	 * @param {Array}  blocks The list of blocks to convert
	 * @param {number} depth The current call stack depth
	 * @param {number} maxDepth The maximum allowed depth
	 */
	async convertBlocks(blocks, depth = 1, maxDepth = 3) {
		const promises = blocks.map(async (block) => {
			const innerBlocks = { block };

			await this.transform(block);

			if (depth <= maxDepth && this.validBlocks(innerBlocks)) {
				await this.convertBlocks(innerBlocks, depth + 1, maxDepth);
			}
		});

		await Promise.all(promises);
	}

	/**
	 * If the specified block is a freeform / classic block, replaces it
	 * with corresponding Gutenberg blocks
	 *
	 * @param {object} block The current block object
	 */
	async transform(block) {
		if (this.isFreeformBlock(block)) {
			const gutenbergBlocks = this.blockHandler(block);

			this.wp.data
				.dispatch('core/block-editor')
				.replaceBlocks(block.clientId, gutenbergBlocks);

			if (Array.isArray(gutenbergBlocks)) {
				const promises = gutenbergBlocks.map((block) =>
					this.waitForDOMManipulation(block.clientId),
				);
				await Promise.all(promises);
			}

			this.didTransform = true;
		} else if (block.innerBlocks && block.innerBlocks.length > 0) {
			await this.convertBlocks(block.innerBlocks);
		}
	}

	/**
	 * Waits for DOM manipulation to finish.
	 *
	 * @param {string} clientId The block ID.
	 *
	 * @returns {Promise<void>} A promise that resolves when DOM manipulation is detected or when no DOM manipulation happens.
	 */
	async waitForDOMManipulation(clientId = '') {
		let iframeElement;
		let block;

		// Resolves after the editor iframe canvas is inserted.
		await new Promise((resolve) => {
			const intervalId = setInterval(() => {
				iframeElement = document.getElementsByName('editor-canvas');

				if (iframeElement.length > 0) {
					iframeElement = iframeElement[0];
					clearInterval(intervalId);
					resolve();
				}
			}, 100);
		});

		// Resolves after the transformed block is inserted.
		await new Promise((resolve) => {
			const intervalId = setInterval(() => {
				const iframeDocument =
					iframeElement.contentDocument || iframeElement.contentWindow.document;

				if (iframeDocument.body) {
					block = iframeDocument.getElementById(`block-${clientId}`);

					if (block) {
						clearInterval(intervalId);
						resolve();
					}
				}
			}, 100);
		});

		return new Promise((resolve) => {
			const observer = new MutationObserver((mutationList, observer) => {
				if (observer.timeoutId) {
					clearTimeout(observer.timeoutId);
				}

				observer.timeoutId = setTimeout(() => {
					observer.disconnect();
					resolve();
				}, 100);
			});

			observer.observe(block, { childList: true, subtree: true });

			// We resolve if there is no DOM manipulations happening
			setTimeout(() => {
				observer.disconnect();
				resolve();
			}, 100);
		});
	}

	/**
	 * Uses the Core Raw HTML Block Handler to convert classic block to
	 * corresponding blocks
	 *
	 * @param {object} block The block object
	 * @returns {object}
	 */
	blockHandler(block) {
		const { blocks } = this.wp;

		return blocks.rawHandler({
			HTML: blocks.getBlockContent(block),
		});
	}

	/* helpers */

	/**
	 * Checks if the blocks specified are valid
	 *
	 * @param {Array} blocks The array of blocks
	 * @returns {boolean}
	 */
	validBlocks(blocks) {
		return blocks && blocks.length > 0;
	}

	/**
	 * Checks if the specified block is a freeform/classic block
	 *
	 * @param {object} block The block object
	 * @returns {boolean}
	 */
	isFreeformBlock(block) {
		return block.name === 'core/freeform';
	}
}

export default ClassicBlockTransformer;
