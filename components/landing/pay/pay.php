<section class="pay">
	<div class="pay__image bg-cover" style="background-image:url('<?php echo $tier->image['sizes']['large']; ?>');" data-scroll></div>
	<div class="row">
		<div class="pay__container">
			<div class="pay__col pay__col--content" data-scroll>
				<div class="copy text-brown">
					<h2 class="headline text-green">
						<?php echo $tier->heading; ?>
					</h2>

					<?php echo $tier->copy; ?>
				</div>
			</div>
			<div class="pay__col pay__col--content" data-scroll>
				<div class="copy text-brown">
					<img src="<?php echo $img_path; ?>landing/early_access.png" alt="" class="supplemental-img">
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