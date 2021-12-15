<section class="video bg-theme">
	<div class="row">
		<div class="video--content" data-scroll>
			<div class="copy">
				<h2 class="headline text-white">
					<?php echo $tier->heading; ?>
				</h2>
			</div>

		</div>
	</div>

	<div class="video--image bg-cover" style="background-image:url('<?php echo $tier->image['sizes']['large']; ?>');">
		<a href="<?php echo $tier->video_embed; ?>" data-lity><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/build/img/icons/karlstorz_play_icon.svg"></a>
	</div>
</section>