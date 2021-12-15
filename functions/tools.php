<?php
// * load styling and scripts
// * WP shows blank login page and blank page search results
// * if these are loaded from find_pages()
function cstmtools_header() {
	?>
	<style>
	h1.cstmtools {
		font: bold 24px sans-serif;
	}
	h1.cstmtools small {
		color: #555;
		font: bold 16px sans-serif;
	}
	table.cstmtools {
		margin-bottom: 50px;
		padding: 2px;
		border: 1px solid black;
	}
	table.cstmtools thead {
		cursor: pointer;
	}
	table.cstmtools tr {
		border-bottom: 3px solid LightGray;
	}
	table.cstmtools th,
	table.cstmtools td {
		margin: 0;
		padding: 7px;
		border-right: 1px solid LightGray;
		text-align: left;
	}
	table.cstmtools th:last-of-type,
	table.cstmtools td:last-of-type {
		border-right: 0;
	}
	table.cstmtools th {
		background-color: black;
		color: white;
		font: bold 12px sans-serif;
	}
	table.cstmtools td {
		font: normal 12px sans-serif;
	}
	table.cstmtools tbody tr:nth-of-type(even) {
		background-color: #eee;
	}
	table.cstmtools tbody tr:hover {
		background-color: Yellow;
	}
	ul.cstmtoolsnav {
		list-style-type: none;
		padding: 0;
	}
	ul.cstmtoolsnav li {
		display: inline;
		padding: 0 5px;
		border-right: 1px solid #555;
		font: normal 12px sans-serif;
	}
	ul.cstmtoolsnav li:last-of-type {
		border-right: none;
	}
	</style>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<!-- https://www.kryogenix.org/code/browser/sorttable/ -->
	<script src="https://cdn.jsdelivr.net/npm/sorttable@1.0.2/sorttable.min.js"></script>
	<ul class="cstmtoolsnav">
		<li><a href="?get_templates=1">Get Templates</a></li>
		<li><a href="?get_overrides=1">Get Overrides</a></li>
		<li><a href="?unused_templates=1">Unused Templates</a></li>
	</ul>
<?php
}

// * list all pages with their corresponding templates
function get_templates()
{
	global $wpdb;

	$matchTemplates = $wpdb->get_results(
		"
		SELECT wp_posts.id, wp_posts.post_title, wp_postmeta.meta_value, wp_postmeta.meta_key, wp_posts.post_type, wp_postmeta.post_id, wp_posts.post_status
		FROM wp_posts, wp_postmeta
		WHERE wp_posts.post_status LIKE 'publish'
			AND wp_posts.id = wp_postmeta.post_id
			AND wp_posts.post_type = 'page'
			AND wp_postmeta.meta_key = '_wp_page_template'
		GROUP BY wp_posts.id
		ORDER BY wp_posts.post_title ASC
		"
	);

	echo "
		<h1 class='cstmtools'>Match Pages to Templates</h1>
		<table cellspacing='0' class='cstmtools sortable'>
			<thead>
				<tr>
					<th>count</th>
					<th>id</th>
					<th>post_title</th>
					<th>url</th>
					<th>meta_value</th>
				</tr>
			</thead>
			<tbody>
	";
	$countTemplates = 1;
	foreach ( $matchTemplates as $template ) {
		$pgLink = get_permalink( $template->post_id );
		$pgLinkShort = str_replace(home_url(), "", $pgLink);
		$find    = strpos($pgLink, '?p');

		if ($find === false) {
			echo "
			<tr>
				<td>$countTemplates</td>
				<td>$template->id</td>
				<td>$template->post_title</td>
				<td><a href='$pgLink'>$pgLinkShort</a></td>
				<td>$template->meta_value</td>
			</tr>";
			$countTemplates++;;
		}
	}
	echo "
			</tbody>
		</table>
	";

	exit();
}
if (!empty($_GET['get_templates']) && is_user_logged_in()) {
	add_action( 'init', 'cstmtools_header', 1, 1 );
	add_action( 'init', 'get_templates');
}

// * list all pages overriding master copy as defined in the page template
function get_overrides()
{
	global $wpdb;

	// meta_key value to search for varies by site
	// use the name of the master copy override field in
	// WP > Custom Fields > Field Groups > Campaign > Master Copy Override
	// sometimes Campaign is "Content" and Master Copy Override is "Master Copy"
	$matchMasterCopyOverrides = $wpdb->get_results(
		"
		SELECT wp_postmeta.meta_id, wp_postmeta.post_id, wp_postmeta.meta_key, wp_postmeta.meta_value, wp_posts.id, wp_posts.post_title
		FROM wp_postmeta,wp_posts
		WHERE wp_postmeta.meta_key = 'master_copy'
		AND wp_postmeta.meta_value = wp_posts.id
		ORDER BY wp_postmeta.post_id
		"
	);

	echo "
		<h1 class='cstmtools'>Find Pages Using Master Copy Overrides<br>
		<small>If this table is empty, you may want to confirm the MySQL query is correct.</small></h1>
		<table cellspacing='0' class='cstmtools sortable'>
			<thead>
				<tr>
					<th>count</th>
					<th>override post_id</th>
					<th>override post_title</th>
					<th>url</th>

					<th>page post_id</th>
				</tr>
			</thead>
			<tbody>
	";

	$countOverrides = 1;
	foreach ( $matchMasterCopyOverrides as $override ) {
		$pgLink = get_permalink( $override->post_id );
		$pgLinkShort = str_replace(home_url(), "", $pgLink);
		$find1  = strpos($pgLink, '?p');
		$find2  = strpos($pgLink, '-revision-');

		if (($find1 === false) && ($find2 === false)) {
			echo "
				<tr>
					<td>$countOverrides</td>
					<td>$override->meta_value</td>
					<td>$override->post_title</td>
					<td><a href='$pgLink'>$pgLinkShort</a></td>
					<td>$override->post_id</td>
				</tr>";
			$countOverrides++;;
		}
	}
	echo "
			</tbody>
		</table>
	";

	exit();
}
if (!empty($_GET['get_overrides']) && is_user_logged_in()) {
	add_action( 'init', 'cstmtools_header', 1, 1 );
	add_action( 'init', 'get_overrides');
}

// * find unused templates
function unused_templates()
{
	include_once ABSPATH . 'wp-admin/includes/theme.php';
	$available_templates = get_page_templates();

	echo "<h1 class='cstmtools'>Available Templates</h1>";
	echo "<pre>";
	print_r($available_templates);
	echo "</pre>";

	global $wpdb;
	$result = $wpdb->get_results("SELECT DISTINCT `meta_value` FROM wp_postmeta WHERE `meta_key` = '_wp_page_template'");
	$used_templates = array();
	foreach ($result as $template) {
		$used_templates[] = $template->meta_value;
	}

	$unused_templates = array_diff($available_templates, $used_templates);

	echo "<h1 class='cstmtools'>Unused Templates</h1>";
	echo "<pre>";
	print_r($unused_templates);
	echo "</pre>";
	exit();
}
if (isset($_GET['unused_templates']) && is_user_logged_in()) {
	add_action( 'init', 'cstmtools_header', 1, 1 );
	add_action('init', 'unused_templates');
}