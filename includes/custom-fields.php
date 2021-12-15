<?php
$custom_fields_array = array(
	// campaign info
	"thankyou_page",
	"phone_number",
	"ats_link",
	"recruiter_email",
	"form_id",
);

global $post;
$parent_page_id = $post->post_parent;
$parent_pages = get_post_ancestors($post->ID);
if (in_array("lp-thank", $page_settings->type)) {
	// thank you page will grab campaign info from parent page
	foreach ($custom_fields_array as $custom_field) {
		$$custom_field = get_field($custom_field, $parent_page_id);

	}
} else {
	foreach ($custom_fields_array as $custom_field) {
		$$custom_field = get_field($custom_field);
	}
}

$page_settings->type[] = "post-" . $post->ID;
$test_mode = false;
// for local development
if ($_SERVER['SERVER_ADDR'] === "::1" || $_SERVER["SERVER_ADDR"] === "127.0.0.1") {
	$test_mode = true;
	$thankyou_page = "/thank-you";
	$phone_number = "555-555-5555";
}