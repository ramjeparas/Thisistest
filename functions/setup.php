<?php
function create_custom_table()
{
	global $wpdb;
	$table_name = "submissions";

	$wpdb->query(
		"CREATE TABLE $table_name (
			id INT AUTO_INCREMENT PRIMARY KEY,
			timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			name VARCHAR(100) DEFAULT NULL,
			email VARCHAR(60) DEFAULT NULL,
			phone VARCHAR(60) DEFAULT NULL,
			location VARCHAR(100) DEFAULT NULL,
			jobtype VARCHAR(100) DEFAULT NULL,
			form_url TEXT DEFAULT NULL,
			form_id VARCHAR(60) DEFAULT NULL,
			recruiter VARCHAR(60) DEFAULT NULL
		)"
	);

	exit("table created");
}
if (!empty($_GET['create_custom_table']) && is_user_logged_in()) {
	add_action('init', 'create_custom_table');
}