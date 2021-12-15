<section class="testimonial">
    <div class="testimonial__blocks">

        <div class="row">
            <div class="testimonial__blocks--container">
                <div class="testimonial__blocks--col testimonial__blocks--col--content" data-scroll>
                    <div class="copy">
                        <h2 class="headline text-theme">
                            <?php echo $tier->heading; ?>
                        </h2>
                        <?php echo $tier->content; ?>

                        <div class="testimonial__list" data-scroll>
                            <?php
                            if (!empty($tier->testimonial)) :
                                foreach ($tier->testimonial as $li_main) :
                                    $li_main = (object) $li_main;
                                    ?>
                                    <div class="testimonial-block">
                                        <img src="<?php echo $img_path; ?>/icons/quotes-icon.png" alt="" class="supplemental-img">
                                        <?php echo $li_main->content; ?>
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

    </div>

</section>