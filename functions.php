<?php
// _ admin login functions for submissions
if (is_admin() && (is_user_logged_in() && stripos(wp_get_current_user()->user_login, "submissions_") !== false)) {
	wp_redirect("/submissions");
	exit();
}

function my_login_logo()
{?>
	<style type="text/css">
		#login h1 a, .login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/build/img/logos/logo.svg);
			width:250px;
			height:75px;
			background-size: contain;
			background-repeat: no-repeat;
			padding-bottom: 0px;
		}
	</style>
<?php }
add_action('login_enqueue_scripts', 'my_login_logo');

function my_login_logo_url()
{
	return home_url();
}
add_filter('login_headerurl', 'my_login_logo_url');

function my_login_logo_url_title()
{
	return get_bloginfo('name');;
}
add_filter('login_headertext', 'my_login_logo_url_title');


add_theme_support( 'custom-logo' );

// _ Adds in post type for site settings
function create_posttypes()
{
	$options = array(
		'label' => 'LP Settings',
		'public' => false,
		'publicly_queryable' => true,
		'show_ui' => true,
		'menu_icon' => 'dashicons-media-document',
		'has_archive' => true,
		'supports' => array('title', 'thumbnail', 'revisions'),
	);
	register_post_type('lp_settings', $options);
}
// hook
add_action('init', 'create_posttypes');


// _ Display page template column
add_filter( 'manage_pages_columns', 'page_column_views' );
add_action( 'manage_pages_custom_column', 'page_custom_column_views', 5, 2 );
function page_column_views( $defaults )
{
	$defaults['page-layout'] = __('Template');
	return $defaults;
}

function page_custom_column_views( $column_name, $id )
{
	if ( $column_name === 'page-layout' ) {
		$set_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
		if ( $set_template == 'default' ) {
			echo 'Default';
		}
		$templates = get_page_templates();
		ksort( $templates );
		foreach ( array_keys( $templates ) as $template ) :
			if ( $set_template == $templates[$template] ) echo $template;
		endforeach;
	}
}


// Remove emojis
function disable_emojis_wp_head() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_wp_tinymce' );
}
add_action( 'init', 'disable_emojis_wp_head' );

function disable_emojis_wp_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

// Remove other crap in your example
add_action( 'get_header', function() {
    remove_action('wp_head', 'rsd_link'); // Really Simple Discovery service endpoint, EditURI link
    remove_action('wp_head', 'wp_generator'); // XHTML generator that is generated on the wp_head hook, WP version
    remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
    remove_action('wp_head', 'index_rel_link'); // index link
    remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
    remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
    remove_action('wp_head', 'start_post_rel_link', 10, 0); // start link
    remove_action('wp_head', 'parent_post_rel_link', 10, 0); // prev link
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // relational links 4 the posts adjacent 2 the currentpost
    remove_action('template_redirect', 'wp_shortlink_header', 11);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
}, 99);

// Remove adminbar inline css on frontend
function removeinline_adminbar_css_frontend() {
    if ( has_filter( 'wp_head', '_admin_bar_bump_cb' ) ){
        remove_filter( 'wp_head', '_admin_bar_bump_cb' );
    }
}
add_filter( 'wp_head', 'removeinline_adminbar_css_frontend', 1 );


// _ setup
include "functions/setup.php";

//create_custom_table();

// _ tools
include "functions/tools.php";


// _ submissions
include "functions/submissions.php";