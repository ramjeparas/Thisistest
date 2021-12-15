<div class="form--copy">
	<?php echo $hero->form_copy; ?>
	<?php
	if ($response->error === true) {
		echo "<p class='form--error'>{$response->messages[0]}</p>";
	}
	?>
</div>
<form class="form" action="" method="POST" role="form" enctype="multipart/form-data">

	<label>
		<span class="show-for-sr">Name</span>
		<input type="text" name="fullname" placeholder="Name*" aria-label="Name" pattern="[a-zA-Z\s]+" required>
	</label>
    <label>
        <span class="show-for-sr">Email</span>
        <input type="email" name="email" placeholder="Email*" aria-label="Email Address" required>
    </label>
	<label>
		<span class="show-for-sr">Phone</span>
		<input type="tel" name="phone" placeholder="Phone*" aria-label="Telephone" data-phone-field required>
	</label>


	<label>
		<span class="show-for-sr">Location of interest</span>
		<select name="location" id="location" required>
			<option value="" selected disabled>Location of interest</option>
			<option value="El Segundo, CA">El Segundo, CA</option>
			<option value="Auburn, MA">Auburn, MA</option>
            <option value="Stafford, TX">Stafford, TX</option>
            <option value="Remote/Field based">Remote/Field based</option>
		</select>
	</label>
	<label>
		<span class="show-for-sr">Job type</span>
		<select name="jobtype" id="jobtype" required>
			<option value="" selected disabled>Job type</option>

            <option value="Sales & Customer Support">Sales & Customer Support</option>
            <option value="Manufacturing & Logistics">Manufacturing & Logistics</option>
            <option value="On-site Services">On-site Services</option>
            <option value="IT/Software Engineering">IT/Software Engineering</option>
            <option value="Research & Development">Research & Development</option>
            <option value="Marketing">Marketing</option>
            <option value="Finance">Finance</option>
            <option value="Legal & Compliance">Legal & Compliance</option>
            <option value="Corporate Operations">Corporate Operations</option>
		</select>
	</label>
    <!--
        <div class="form--wrappear">
            <p class="text-strong">Sign up for our upcoming event</p>
            <div>
                <input type="radio" name="textme" id="textme-yes" value="Yes" required>
                <label for="textme-yes">
                    Diversity Conference<br/>
                    We’re making our workplace a more diverse, inclusive, and equitable one.
                    Attend our event to learn more about how KARL STORZ is achieving these goals.
                </label>

            </div>

        </div> form-wrapper -->
	<button class="form--button" type="submit" name="submit" value="submit">
		Explore Jobs
	</button>


    <p class="form--terms">
        By submitting your information, you agree to the <a href="https://www.karlstorz.com/us/en/data-privacy.htm" target="_blank" rel="noopener noreferrer">Terms &amp; Conditions</a>.
    </p>
</form>