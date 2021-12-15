<?php
// get the selected location
$sltLocation = $_GET['location'];

$sltLocationParts = explode(", ", $sltLocation);
$strCity = str_replace(' ', '', $sltLocationParts[0]);
$strState = $sltLocationParts[1];

// display different options for specific locations
if ( strcasecmp($strCity,"allentown") === 0 ) {
	echo '
	<option value="" selected disabled>How many years of experience do you have?*</option>
	<option value="1-2 years">1-2 years</option>
	<option value="2-3 years">2-3 years</option>
	<option value="4-5 years">4-5 years</option>
	<option value="6+ years">6+ years</option>
	';
} elseif ( strcasecmp($strCity,"hudsonvalley") === 0 ) {
	echo '
	<option value="" selected disabled>How many years of experience do you have?*</option>
	<option value="6 months - 1 year">6 months - 1 year</option>
	<option value="2-3 years">2-3 years</option>
	<option value="4-5 years">4-5 years</option>
	<option value="6+ years">6+ years</option>
	';
} else {
	echo '
	<option value="" selected disabled>How many years of experience do you have?*</option>
	<option value="0-1 years">0-1 years</option>
	<option value="2-3 years">2-3 years</option>
	<option value="4-5 years">4-5 years</option>
	<option value="6+ years">6+ years</option>
	';
}
?>