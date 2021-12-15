<section class="benefits bg-theme">
	<div class="row">
		<div class="benefits__container section-row">
			<div class="benefits__col benefits__col--content" data-scroll>
				<div class="copy text-white">
                    <h2 class="headline text-center">
                        <?php echo $tier->heading; ?>
                    </h2>
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