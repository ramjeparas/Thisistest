<?php
/*
Template Name: Thank You
*/

ob_start('ob_gzhandler');

$img_path = get_stylesheet_directory_uri() . "/assets/build/img/";

$page_settings = (object) [
	"type" => [
		"lp-thank",
	],
];

include __DIR__ . "./../includes/custom-fields.php";

// * header
include __DIR__ . "./../components/global/header/header.php";

// * nav
// include __DIR__ . "./../components/global/nav/nav.php";

// * thank you
include __DIR__ . "./../components/thank/thank.php";

// * footer
include __DIR__ . "./../components/global/footer/footer-nav.php";
include __DIR__ . "./../components/global/footer/footer.php";