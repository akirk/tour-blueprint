<?php
$tour_json = str_replace( array( "'", PHP_EOL ), array( "\\'", "' . PHP_EOL . '" ), file_get_contents( __DIR__ . '/tour.json' ) );
$json = <<<END
{
	"landingPage": "/wp-admin/",
	"preferredVersions": {
		"php": "8.0",
		"wp": "latest"
	},
	"steps": [
		{
			"step": "login",
			"username": "admin",
			"password": "password"
		},
		{
			"step": "installPlugin",
			"pluginZipFile": {
				"resource": "url",
				"url": "https://codeload.github.com/Automattic/tour/zip/refs/heads/restrict-by-url"
			}
		},
		{
				"step": "runPHP",
				"code": "<?php require_once 'wordpress/wp-load.php'; wp_insert_post(array('post_title' => 'Test Tour', 'post_type' => 'tour', 'post_content' => '{$tour_json}', 'post_status' => 'publish')); ?>"
		}

	]
}
END;
file_put_contents( __DIR__ . '/blueprint-tour.json', $json);
