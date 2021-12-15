<section class="img-content">
    <div class="img-content__blocks bg-theme text-white img-pos-<?php echo $tier->image_position; ?> <?php echo $tier->custom_class; ?>">

        <div class="row">
            <div class="img-content__blocks--container">
                <div class="img-content__blocks--col img-content__blocks--col--content" data-scroll>
                    <div class="copy">
                        <h2 class="headline">
                            <?php echo $tier->heading; ?>
                        </h2>
                        <?php echo nl2br($tier->content); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="img-content__blocks--image bg-cover" style="background-image:url('<?php echo $tier->image['sizes']['large']; ?>');" data-scroll></div>
    </div>

</section>