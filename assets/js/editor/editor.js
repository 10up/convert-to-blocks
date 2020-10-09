import ClassicBlockTransformer from './transform/ClassicBlockTransformer';

/**
 * ConnectToBlocksSupport connects the JS implementation of
 * Connect to Blocks to Gutenberg JS.
 */
class ConnectToBlocksEditorSupport {
	/**
	 * Returns the singleton instance of ConnectToBlocksEditorSupport.
	 *
	 * @returns {ConnectToBlocksEditorSupport}
	 */
	static getInstance() {
		if ( !this.instance ) {
			this.instance = new ConnectToBlocksEditorSupport();
		}

		return this.instance;
	}

	/**
	 * Activates the ConnectToBlocksEditorSupport
	 */
	enable() {
		document.addEventListener( 'DOMContentLoaded', this.didBlockEditorLoad.bind( this ) );
	}

	/**
	 * Executes the classic to block transform.
	 */
	didBlockEditorLoad() {
		const transformer = new ClassicBlockTransformer();
		transformer.execute();
	}
}

const support = ConnectToBlocksEditorSupport.getInstance();
support.enable();

export default ConnectToBlocksEditorSupport;
