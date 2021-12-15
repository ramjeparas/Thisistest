<?php
global $wpdb;

// $wpdb->show_errors();
// $wpdb->print_error();

$response = (object) [
	"error" => false,
	"messages" => [],
];


if (isset($_POST['email'])) {
	$post_fields_array = array(
		"fullname",
		"phone",
		"email",
        "location",
        "jobtype",
	);

	$table_name = "submissions";

    $table_data = [
        "form_id" => $form_id,
        "form_url" => $_SERVER['REQUEST_URI'],
    ];




	// process field values
	foreach ($post_fields_array as $post_field) {
		if ($required === true) {
			if (empty($_POST[$post_field]) || strlen($_POST[$post_field]) < 1) {
				$response->error = true;
				$response->messages[] = "Please double check the form fields and try again.";

				if (!empty($_GET['testing'])) {
					$response->messages[] = "field: $post_field";
				}
			}
		}

		switch ($post_field) {
			case "phone":
				$$post_field = filter_var($_POST[$post_field], FILTER_SANITIZE_NUMBER_INT);
				if ($post_field == "phone" && strlen(str_replace("-", "", $$post_field)) < 7) {
					$response->error = true;
					$response->messages[] = "Please enter a valid phone number";
				}
				break;
			case "email":
				$$post_field = filter_var($_POST[$post_field], FILTER_SANITIZE_EMAIL);
				if (!empty($$post_field)) {
					if (!filter_var($$post_field, FILTER_VALIDATE_EMAIL)) {
						$response->error = true;
						$response->messages[] = "Please check your email is valid.";
					}
				}
				break;
			default:
				$$post_field = filter_var($_POST[$post_field], FILTER_SANITIZE_STRING);
				$$post_field = ucwords(strtolower($$post_field));
		}

		$table_data[$post_field] = $$post_field;
	}



	if (!empty($_GET['testing']) && is_user_logged_in()) {
		echo "<pre>";
		echo var_dump($table_data);
		echo "</pre>";
		echo "<pre>";
		echo var_dump($response);
		echo "</pre>";
		exit();
	}

	if ($response->error === false) {

        //echo $table_data;
		$success = $wpdb->insert($table_name, $table_data);

		if ($success) {

			$subject = "Thank you so much for your interest in Karl Storz.";
			$mail_applicant =
				"
			Hello $fullname,<br><br>
			Thank you so much for your interest in Karl Storz!<br><br>
			A recruiting professional will be reviewing your information and will be in contact with you shortly.
			<br><br>
			Thank you,<br>
			Karl Storz
			";
			if ($fullname === "Testerson") {
				//$to = "ramje@paragonoutsourcing.com";
                $to = "hosting+careersatkarlstorz@bayardad.com";
			} else {
				$to = $fullname . "<" . $email . ">";
			}

			// message
			$message = "<html><head></head><body>$mail_applicant</body></html>";
			$headers = array(
				"Content-Type: text/html; charset=UTF-8",
				"From: Karl Storz <no-reply@careersatkarlstorz.com>",
			);
			wp_mail($to, $subject, $message, $headers);

			// send email to client
			if ($fullname === "Testerson") {
				//$client_to = "ramje@paragonoutsourcing.com";

                $client_to = "hosting+careersatkarlstorz@bayardad.com";
            } else {

                $client_to = "TalentAcquisitionKSEA@KarlStorz.com";

			}

			$client_subject = "Karl Storz - New Application";


            $client_mail =
                "
				Name: $fullname <br>
				Phone: $phone <br>
				Email: $email <br>
				Location of Interest: $location <br>
				Job Type: $jobtype <br>
				Form URL: $table_data[form_url]<br>
				";


			// message
			$client_message = "<html><head></head><body>$client_mail</body></html>";
			$client_headers = array(
				"Content-Type: text/html; charset=UTF-8",
				"From: Karl Storz <no-reply@careersatkarlstorz.com>",
			);

			if (($fullname === "Testerson") || ($cdl !== "No")) {
				wp_mail($client_to, $client_subject, $client_message, $client_headers, $attachment);
			}

			wp_redirect($thankyou_page);
			exit();
		} else {
			$response->error = true;
			$response->messages[] = "There was an error. Please try again.";
		}
	}
}