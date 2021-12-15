<section class="careers">
	<div class="row">
		<div class="careers__container">
			<div class="careers__col careers__col--content" data-scroll>
				<div class="copy">
                    <div class="<?php echo $tier->icon_class; ?>">
                        <h2 class="headline text-theme">
                            <?php echo $tier->heading; ?>
                        </h2>

                        <?php echo $tier->content; ?>
                    </div>
					<div class="flipbox-cont">
						<?php
						if (!empty($tier->list)) :
							foreach ($tier->list as $li_main) :
								$li_main = (object) $li_main;
								?>
                        <div class="flipbox">

                            <?php
                            if(!wp_is_mobile()){
                                ?>
                                <div class="front">
                                    <div class="content">
                                        <h3 class="text-theme"><?php echo $li_main->heading; ?></h3>

                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="back" style="<?php echo (wp_is_mobile()) ? 'opacity: 1;' : '' ?>">
                                <div class="content">
                                    <h3 class="text-theme"><?php echo $li_main->heading; ?></h3>
                                    <span><?php echo $li_main->content; ?></span>
                                </div>
                            </div>
                        </div>
								<?php
							endforeach;
						endif;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>