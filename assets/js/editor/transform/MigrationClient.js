const { wp, location } = window;

/**
 * MigrationClient provides the client-side support for the BE MigrationAgent.
 */
class MigrationClient {
	/**
	 * Initializes the client with the specified config settings.
	 *
	 * @param {object} config The convert to blocks config
	 */
	constructor(config) {
		this.config = config;
		this.saved = false;
		this.didNext = false;
	}

	/**
	 * Saves the curent post by manually dispatching savePost.
	 */
	save() {
		// don't rerun after save
		if (this.saved) {
			return;
		}

		this.saved = true;

		const { dispatch, subscribe } = wp.data;
		const editor = dispatch('core/editor');

		subscribe(this.didSave.bind(this));
		editor.savePost();
	}

	/**
	 * On Post save, runs the next post migration.
	 */
	didSave() {
		const { select } = wp.data;
		const isSavingPost = select('core/editor').isSavingPost();
		const isAutosavingPost = select('core/editor').isAutosavingPost();

		if (isAutosavingPost && !isSavingPost) {
			return;
		}

		if (this.hasNext()) {
			this.next();
		}
	}

	/**
	 * Checks if there is a post in the queue.
	 *
	 * @returns {boolean} True or false if next is present.
	 */
	hasNext() {
		if (this.didNext) {
			return false;
		}

		if (!this.hasNextConfig()) {
			return false;
		}

		return this.config.agent.next;
	}

	/**
	 * Navigates to the next post to migrate.
	 */
	next() {
		if (!this.hasNextConfig()) {
			return;
		}

		this.didNext = true;
		location.href = this.config.agent.next;
	}

	/**
	 * Checks if the next migration post data is present in config.
	 *
	 * @returns {boolean} True or false if next config is present
	 */
	hasNextConfig() {
		if (!this.config) {
			return false;
		}

		if (!this.config.agent) {
			return false;
		}

		if (!this.config.agent.next) {
			return false;
		}

		return true;
	}
}

export default MigrationClient;
