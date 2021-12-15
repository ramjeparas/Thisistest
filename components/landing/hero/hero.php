<section class="hero">
	<div class="row">
		<div class="hero__container">
			<div class="hero__copy">
                <?php
                $custom_logo_id = get_theme_mod( 'custom_logo' );
                $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );

                if ( has_custom_logo() ) {
                    echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '" title="'.get_bloginfo('name').'" class="logo">';
                    echo '<h1 class="hide-h1">' . get_bloginfo('name') . '</h1>';
                } else {
                    echo '<h1 class="text-theme">' . get_bloginfo('name') . '</h1>';
                }
                ?>
				<?php echo $hero->hero_copy; ?>
			</div>

                <div class="hero__form bg-theme text-white">

                    <div class="form-cont">
                        <div class="form__copy" id="form">
                            <?php include __DIR__."./../form/form--main.php"; ?>
                        </div>
                    </div>
                </div>

		</div>
	</div>
</section>