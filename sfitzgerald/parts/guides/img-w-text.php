<?php if (have_rows('images_with_text')): ?>
    <section class="img-w-text">
        <div class="img-w-text__container grid-container">
            <?php if ($section_title = get_field('img_w_text_title')): ?>
                <h2 class="img-w-text__title">
                    <?php echo $section_title; ?>
                </h2>
            <?php endif; ?>
            <div class="img-w-text__items">
                <?php while (have_rows('images_with_text')): the_row(); ?>
                    <div class="img-w-text__item">
                        <?php if ($image = get_sub_field('image')): ?>
                            <div class="img-w-text__image">
                                <?php echo wp_get_attachment_image($image['id'], 'large'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($text = get_sub_field('text')): ?>
                            <div class="img-w-text__text">
                                <?php echo $text; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
