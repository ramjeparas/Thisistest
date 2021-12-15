<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

ob_start('ob_gzhandler');

$img_path = get_stylesheet_directory_uri() . "/assets/build/img/";

$page_settings = (object) [
	"type" => [
		"lp-submissions",
	],
];

$test_mode = false;
if (!is_user_logged_in()) {
	exit("Please log in");
}
// for local development
if ($_SERVER['SERVER_ADDR'] === "::1") {
	$test_mode = true;
}

include "includes/submissions-settings.php";

// * header
include "components/global/header/header.php";

// * submissions table
include "components/submissions/results/results.php";

// * footer
include "components/global/footer/footer.php";