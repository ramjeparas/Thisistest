<?php
// _ create column labels
function submissions_column_labels()
{
	global $table_info;

	$output = [];
	foreach ($table_info as $section => $columns) {
		if (is_array($columns)) {
			foreach ($columns as $column_id => $column) {
				switch ($section) {
					case "columns":
						$output[$column_id] = $column->label;
						break;
					case "custom_questions":
						$output["Questions"][$column_id] = $column;
						break;
					case "media_columns":
						$output["UTM"][$column_id] = "UTM " . $column;
						break;
					default:
						$output[$column_id] = $column;
						break;
				}
			}
		}
	}

	// echo "<pre>", var_dump($output), "</pre>";
	// exit();

	return $output;
}

// _ create submission row
function submissions_create_row($row)
{
	global $table_info;

	// * process some columns values
	$custom_questions = json_decode($row->custom_questions);
	$result = json_decode($row->result);

	// * read utms
	// $utm_params = [];
	// if (stripos($row->form_url, "utm_") !== false) {
	// 	$row->form_url = str_replace("/?", "", $row->form_url);
	// 	parse_str($row->form_url, $utm_params);
	// }

	$output = [];
	foreach ($table_info as $section => $columns) {
		if (is_array($columns)) {
			$sub_row = [];
			foreach ($columns as $column_id => $column) {
				switch ($section) {
					case "custom_questions":
						$value = (!empty($custom_questions->$column_id)) ? $custom_questions->$column_id->a : "";
						$sub_row[$column] = $value;
						break;
					case "media_columns":
						$sub_row[$column] = (!empty($utm_params[$column_id])) ? $utm_params[$column_id] : "";
					case "extra_columns":
						if ($column_id === "post_status" && $row->post_status === "Rejected") {
							$output[$column_id] = $row->$column_id . " - " . substr($result->Description, 0, 150) . "...";
							break;
						}
					default:
						$output[$column_id] = $row->$column_id;
						break;
				}
			}
			if (!empty($sub_row)) {
				$output[] = $sub_row;
			}
		}
	}

	// echo "<pre>", var_dump($output), "</pre>";
	// exit();

	return $output;
}

// _ get file for download
// * workaround for large files
function get_export_file($temp_file)
{
	$filename = "export.csv";
	header("Content-Disposition: attachment; filename=\"$filename\"");

	set_time_limit(0);
	$file = fopen($temp_file, "rb");
	while (!feof($file)) {
		print(fread($file, 1024 * 8));
	}

	// * remove file
	unlink($temp_file);
}
