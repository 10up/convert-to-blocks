/**
 * ESLint flat config. Extends the `@wordpress/scripts` default config.
 */

/**
 * WordPress dependencies
 */
import defaultConfig from '@wordpress/scripts/config/eslint.config.cjs';

export default [
	{
		ignores: [
			'assets/js/**/vendor/**',
			'build/**',
			'node_modules/**',
			'vendor/**',
		],
	},
	...defaultConfig,
	{
		languageOptions: {
			globals: {
				module: 'readonly',
				process: 'readonly',
				wp: 'readonly',
				lodash: 'readonly',
			},
		},
	},
];
