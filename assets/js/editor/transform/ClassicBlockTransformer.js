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
	}

	/**
	 * Runs the Classic to Gutenberg Block transform on the current document.
	 */
	execute() {
		const coreEditor = this.wp.data.select('core/block-editor');
		const blocks = coreEditor.getBlocks();

		if (this.validBlocks(blocks)) {
			/* Currently set to do 3 levels of recursion */
			this.convertBlocks(blocks, 1, 3);
		}
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
	convertBlocks(blocks, depth = 1, maxDepth = 3) {
		const n = blocks.length;
		let i;
		let block;
		let innerBlocks;

		for (i = 0; i < n; i++) {
			block = blocks[i];
			innerBlocks = { block };

			this.transform(block);

			if (depth <= maxDepth && this.validBlocks(innerBlocks)) {
				this.convertBlocks(innerBlocks, depth + 1, maxDepth);
			}
		}
	}

	/**
	 * If the specified block is a freeform / classic block, replaces it
	 * with corresponding Gutenberg blocks
	 *
	 * @param {object} block The current block object
	 */
	transform(block) {
		if (this.isFreeformBlock(block)) {
			this.wp.data
				.dispatch('core/block-editor')
				.replaceBlocks(block.clientId, this.blockHandler(block));
		} else if (block.innerBlocks && block.innerBlocks.length > 0) {
			this.convertBlocks(block.innerBlocks);
		}
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
