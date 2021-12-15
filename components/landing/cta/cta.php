<section class="cta">
	<div class="row">
		<div class="cta__container section-row">
			<div class="cta__col cta__col--content text-center" data-scroll>
				<h2 class="headline text-theme">
					<span><?php echo $tier->heading; ?></span>
				</h2>
                <?php echo $tier->content; ?>
				<a href="#form" class="button cta__col--apply" data-smooth>
					<?php echo $tier->button; ?>
				</a>
			</div>
		</div>
	</div>
</section>