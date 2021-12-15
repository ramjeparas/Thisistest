<?php
global $wpdb;

$admin_check = in_array(wp_get_current_user()->user_login, ["bayard", "submissions_admin"]);

// * filter submit
if (isset($_POST['filter_submit'])) {
	$filter_fields = [
		"min_date",
		"max_date",
		"campaign",
	];

	$filter_url = [];
	foreach ($filter_fields as $filter) {
		if (!empty($_POST[$filter])) {
			$$filter = filter_var($_POST[$filter], FILTER_SANITIZE_STRING);
			$$filter = strtolower(trim($$filter));
			$$filter = urlencode($$filter);
			$filter_url[] = "{$filter}={$$filter}";
		}
	}
	if (!empty($filter_url)) {
		$filter_url = implode("&", $filter_url);
		wp_redirect(home_url() . "/submissions/?{$filter_url}");
	}
}

// * ===================
// * get submissions
// * ===================
$table_info = (object) [
	"name" => "submissions",
	"columns" => [
		"timestamp" => (object) [
			"label" => "Timestamp",
			"width" => 10,
		],
		"first_name" => (object) [
			"label" => "First Name",
			"width" => 10,
		],
		"last_name" => (object) [
			"label" => "Last Name",
			"width" => 10,
		],
		"phone" => (object) [
			"label" => "Phone",
			"width" => 10,
		],
		"email" => (object) [
			"label" => "Email",
			"width" => 10,
		],
	],
	"custom_questions" => [
		"location" => "Location W",
		"job_type" => "Job Type",
		"location_drivers" => "Location D",
		"cdl" => "CDL-A",
		"experience" => "Experience",
	],
	"extra_columns" => [
		"form_url" => "Form URL",
		"form_id" => "Form ID",
	],
];

// if ($_SERVER['SERVER_ADDR'] === "::1") {
// 	$table_info->name = "submissions_bayard";
// }

// * if admin, add media columns
// if ($admin_check) {
// 	$table_info->media_columns = [
// 		"utm_source" => "Source",
// 		"utm_medium" => "Medium",
// 		"utm_campaign" => "Campaign",
// 	];
// }

// * below uses $table_info
$table_columns = submissions_column_labels();

// * filters
$filter_tests = 1;
if (wp_get_current_user()->user_login !== "bayard" || (!empty($_GET["hide-tests"]))) {
	$filter_tests = $wpdb->prepare(
		"`last_name` NOT LIKE %s",
		[
			"Testerson",
		]
	);
}
$filter_min_date = 1;
if (!empty($_GET['min_date'])) {
	$min_date_input = filter_var($_GET['min_date'], FILTER_SANITIZE_STRING);
	$filter_min_date = $wpdb->prepare(
		"`timestamp` >= %s",
		[
			$min_date_input,
		]
	);
}
$filter_max_date = 1;
if (!empty($_GET['max_date'])) {
	$max_date_input = filter_var($_GET['max_date'], FILTER_SANITIZE_STRING);
	$filter_max_date = $wpdb->prepare(
		"`timestamp` < %s",
		[
			$max_date_input,
		]
	);
}
$filter_campaign = 1;
if (!empty($_GET['campaign'])) {
	$campaign = filter_var($_GET['campaign'], FILTER_SANITIZE_STRING);
	$campaign = str_replace("+", " ", $campaign);
	$filter_campaign = $wpdb->prepare(
		"`form_id` = %s",
		[
			$campaign,
		]
	);
}

// * where query
$where_query = "($filter_tests) AND ($filter_campaign) AND ($filter_min_date) AND ($filter_max_date)";

// * total results count
$total_results = $wpdb->get_results(
	"SELECT COUNT(*) as count
	FROM $table_info->name
	WHERE $where_query"
);
$total_results = $total_results[0]->count;

// * limit & pagination
// * get page number
// * NOTE: Do not use 'page' in a WordPress environment
$page = (!empty($_GET['pg'])) ? (int) $_GET['pg'] : 1;
$limit = 100;
$total_pages = ceil($total_results / $limit);
$starting_limit = ($page - 1) * $limit;
$limit_query = $wpdb->prepare(
	"LIMIT %d, %d", [
		$starting_limit,
		$limit,
	]);

// * get rows
$results = $wpdb->get_results(
	"SELECT *
	FROM $table_info->name
	WHERE $where_query
	ORDER BY `id` DESC
	$limit_query"
);

// * create campaign list
$campaign_urls = $wpdb->get_results(
	"SELECT DISTINCT `form_id`
	FROM $table_info->name
	WHERE `last_name` NOT LIKE 'Testerson'
	ORDER BY `form_id`"
);
$campaign_list = [];
foreach ($campaign_urls as $row) {
	$campaign_list[] = $row->form_id;
}
sort($campaign_list);

// * ===================
// * export
// * ===================
if (isset($_POST["export"])) {
	$temp_file = "/home/joinunfi/temp.csv";
	$output = fopen($temp_file, "w");

	// * first row as column labels
	$csv_row = [];
	foreach ($table_columns as $column_id => $column) {
		if (is_array($column)) {
			foreach ($column as $sub_id => $sub_column) {
				$csv_row[] = $sub_column;
			}
		} else {
			$csv_row[] = $column;
		}
	}
	fputcsv($output, $csv_row);

	// * output subsmissions
	// * buffer get results
	for ($count = 1; $count <= $total_pages; $count++) {
		$starting_limit = ($count - 1) * $limit;
		$limit_query = $wpdb->prepare(
			"LIMIT %d, %d", [
				$starting_limit,
				$limit,
			]);
		$results = $wpdb->get_results(
			"SELECT *
			FROM $table_info->name
			WHERE $where_query
			ORDER BY `id` DESC
			$limit_query"
		);

		foreach ($results as $row) {
			$row_data = submissions_create_row($row);
			$csv_row = [];

			foreach ($row_data as $column_id => $column) {
				if (is_array($column)) {
					foreach ($column as $sub_id => $sub_column) {
						$csv_row[] = $sub_column;
					}
				} else {
					$csv_row[] = $column;
				}
			}

			fputcsv($output, $csv_row);
		}
	}

	get_export_file($temp_file);
	exit();
}