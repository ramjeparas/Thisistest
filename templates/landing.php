<?php
/*
Template Name: Landing
 */

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

ob_start('ob_gzhandler');

$img_path = get_stylesheet_directory_uri() . "/assets/build/img/";

$page_settings = (object) [
	"type" => [
		"lp-landing",
	],
	"master_copy" => 8,
];

include __DIR__ . "./../includes/custom-fields.php";

if ($test_mode) {
	$page_settings->master_copy = 8;
}

if (!empty(get_field("master_copy_override"))) {
	$page_settings->master_copy = get_field("master_copy_override");
}


include __DIR__ . "./../includes/form-settings--main.php";


// * header
include __DIR__ . "./../components/global/header/header.php";

// * nav
//include __DIR__ . "./../components/global/nav/nav.php";

// * hero
$hero = (object) get_field('hero', $page_settings->master_copy);
include __DIR__ . "./../components/landing/hero/hero.php";

// * loops through tiers
if (have_rows('tiers', $page_settings->master_copy)) {
	while (have_rows('tiers', $page_settings->master_copy)) {
		the_row();
		$section_name = get_row_layout();
		$tier = (object) get_sub_field("tier");
		include __DIR__ . "./../components/landing/$section_name/$section_name.php";
	}
}

// * footer
include __DIR__ . "./../components/global/footer/footer-nav.php";
include __DIR__ . "./../components/global/footer/footer.php";