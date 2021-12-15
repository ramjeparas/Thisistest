<section class="schedule">
	<div class="schedule__blocks bg-teal text-white">
		<div class="schedule__blocks--image bg-cover" style="background-image:url('<?php echo $tier->image['sizes']['large']; ?>');" data-scroll></div>
		<div class="row">
			<div class="schedule__blocks--container">
				<div class="schedule__blocks--col schedule__blocks--col--content" data-scroll>
					<div class="copy">
						<h2 class="headline">
							<?php echo $tier->heading; ?>
						</h2>
						<?php echo $tier->copy; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="schedule__list">
		<div class="row">
			<div class="schedule__list--container">
				<div class="schedule__list--col" data-scroll>
					<img src="<?php echo $img_path; ?>landing/mytime.png" alt="" class="supplemental-img">
				</div>
				<div class="schedule__list--col" data-scroll>
					<div class="copy text-brown">
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
					</div>
				</div>
			</div>
		</div>
	</div>
</section>