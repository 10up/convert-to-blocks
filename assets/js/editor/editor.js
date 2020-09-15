import ClassicBlockTransformer from './transform/ClassicBlockTransformer';

/**
 * GutenbridgeEditorSupport connects the JS implementation of
 * Gutenbridge to Gutenberg JS.
 */
class GutenbridgeEditorSupport {
	/**
	 * Returns the singleton instance of GutenbridgeEditorSupport.
	 *
	 * @returns {GutenbridgeEditorSupport}
	 */
	static getInstance() {
		if (!this.instance) {
			this.instance = new GutenbridgeEditorSupport();
		}

		return this.instance;
	}

	/**
	 * Activates the GutenbridgeEditorSupport
	 */
	enable() {
		document.addEventListener('DOMContentLoaded', this.didBlockEditorLoad.bind(this));
	}

	/**
	 * Executes the classic to block transform.
	 */
	didBlockEditorLoad() {
		const transformer = new ClassicBlockTransformer();
		transformer.execute();
	}
}

const support = GutenbridgeEditorSupport.getInstance();
support.enable();

export default GutenbridgeEditorSupport;
