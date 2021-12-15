<section class="careers bg-teal text-white">
	<div class="careers__image bg-cover" style="background-image:url('<?php echo $tier->image['sizes']['large']; ?>');" data-scroll></div>
	<div class="row">
		<div class="careers__container">
			<div class="careers__col careers__col--content" data-scroll>
				<div class="copy">
					<h2 class="headline">
						<?php echo $tier->heading; ?>
					</h2>

					<?php echo $tier->copy; ?>

					<ul>
						<?php
						if (!empty($tier->list)) :
							foreach ($tier->list as $li_main) :
								$li_main = (object) $li_main;
								?>
								<li>
									<span><img src="<?php echo $li_main->image['sizes']['medium']; ?>" alt=""></span>
									<span><?php echo $li_main->copy; ?></span>
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
</section>