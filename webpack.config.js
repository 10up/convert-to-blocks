const defaultConfig = require('@wordpress/scripts/config/webpack.config');

module.exports = {
	...defaultConfig,
	entry: {
		...defaultConfig.entry,
		editor: './assets/js/editor/editor.js',
	},
	module: {
		...defaultConfig.module,
	},
};
