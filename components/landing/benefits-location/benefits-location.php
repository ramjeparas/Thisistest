<section class="benefits-location text-brown">
	<div class="row">
		<div class="benefits-location--container" data-scroll>
			<div class="benefits-location--col">
				<div class="copy">
					<h2 class="headline text-green">
						<?php echo $tier->heading; ?>
					</h2>

					<ul>
						<?php
						if (!empty($tier->list)) :
							foreach ($tier->list as $li_main) :
								$li_main = (object) $li_main;
								?>
								<li>
									<?php echo $li_main->copy; ?>
								</li>
								<?php
							endforeach;
						endif;
						?>
					</ul>

					<?php echo $tier->copy; ?>
				</div>
			</div>
		</div>
	</div>
</section>