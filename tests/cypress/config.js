const { defineConfig } = require('cypress');
const path = require( 'path' );

// Resolve the package directory
const wpEnvPackagePath = require.resolve( '@wordpress/env/package.json' );
const wpEnvLibPath = path.join( path.dirname( wpEnvPackagePath ), 'lib' );

// Directly require the files using their resolved paths
const { loadConfig } = require( path.join( wpEnvLibPath, 'config', 'index.js' ) );
const getCacheDirectory = require( path.join( wpEnvLibPath, 'config', 'get-cache-directory.js' ) );


module.exports = defineConfig({
	fixturesFolder: 'tests/cypress/fixtures',
	screenshotsFolder: 'tests/cypress/screenshots',
	videosFolder: 'tests/cypress/videos',
	downloadsFolder: 'tests/cypress/downloads',
	video: false,
	e2e: {
		setupNodeEvents(on, config) {
			return setBaseUrl(on, config);
		},
		specPattern: 'tests/cypress/e2e/**/*.test.{js,jsx,ts,tsx}',
		supportFile: 'tests/cypress/support/e2e.js',
	},
	reporter: 'mochawesome',
	reporterOptions: {
		mochaFile: 'mochawesome-[name]',
		reportDir: 'tests/cypress/reports',
		overwrite: false,
		html: false,
		json: true,
	},
	chromeWebSecurity: false
});

/**
 * Set WP URL as baseUrl in Cypress config.
 *
 * @param {Function} on    function that used to register listeners on various events.
 * @param {object} config  Cypress Config object.
 * @returns config Updated Cypress Config object.
 */
const setBaseUrl = async (on, config) => {
  const cacheDirectory = await getCacheDirectory();
  const wpEnvConfig = await loadConfig( cacheDirectory );

	if (wpEnvConfig) {
		const port = wpEnvConfig.env.tests.port || null;

		if (port) {
			config.baseUrl = wpEnvConfig.env.tests.config.WP_SITEURL;
		}
	}

	return config;
};
