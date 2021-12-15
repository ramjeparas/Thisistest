<nav class="nav" role="navigation">
	<div class="row">
		<div class="nav--container">
			<div class="nav--brand">
				<img src="<?php echo $img_path; ?>logos/logo.svg" alt="UNFI logo">
			</div>
			<div class="nav--contact text-right">
				<?php if ($phone_number) : ?>
					<strong>Call us now!</strong><br>
					<a href="tel:<?php echo $phone_number; ?>">
						<strong><?php echo $phone_number; ?></strong>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</nav>