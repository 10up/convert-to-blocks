#!/bin/bash
wp-env run tests-wordpress chmod -c ugo+w /var/www/html
wp-env run tests-cli wp rewrite structure '/%postname%/' --hard
wp-env run tests-cli wp post create ./sample-post.txt  --post_title='Classic Post' --post_status=publish

# Disable gutenberg editor welcome guide modal.
wp-env run tests-cli wp user meta add admin wp_persisted_preferences '{"core\/edit-post":{"isComplementaryAreaVisible":true,"welcomeGuide":false},"_modified":"2023-10-05T11:26:20.517Z"}' --format=json
