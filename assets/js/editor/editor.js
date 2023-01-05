import ClassicBlockTransformer from './transform/ClassicBlockTransformer';
import MigrationClient from './transform/MigrationClient';

let loaded = false;

/**
 * ConvertToBlocksSupport connects the JS implementation of
 * Convert to Blocks to Gutenberg JS.
 */
class ConvertToBlocksEditorSupport {
	/**
	 * Returns the singleton instance of ConvertToBlocksEditorSupport.
	 *
	 * @returns {ConvertToBlocksEditorSupport}
	 */
	static getInstance() {
		if (!this.instance) {
			this.instance = new ConvertToBlocksEditorSupport();
		}

		return this.instance;
	}

	/**
	 * Activates the ConvertToBlocksEditorSupport
	 */
	enable() {
		document.addEventListener('DOMContentLoaded', this.didBlockEditorLoad.bind(this));
	}

	/**
	 * Executes the classic to block transform.
	 */
	didBlockEditorLoad() {
		const { registerPlugin } = window.wp.plugins;
		const transformer = new ClassicBlockTransformer();

		if (!registerPlugin) {
			return;
		}

		registerPlugin('convert-to-blocks', {
			render: () => {
				// Don't render more than once, to avoid triggering multiple migrations
				if (loaded) {
					return null;
				}

				loaded = true;

				// This delay allows Gutenberg to initialize legacy content into freeform blocks
				setTimeout(() => {
					const result = transformer.execute();
					const config = window.convert_to_blocks_agent || false;

					// if no migration config, then ignore this request
					if (!config) {
						return null;
					}

					const client = new MigrationClient(config);

					// if no blocks transformed, then we can jump to the next post
					if (!result) {
						client.next();
						return null;
					}

					client.save();

					return null;
				}, 500);

				return null;
			},
		});
	}
}

const support = ConvertToBlocksEditorSupport.getInstance();
support.enable();

export default ConvertToBlocksEditorSupport;
