<?php if (have_rows('points')): ?>
    <section class="points">
        <div class="points__container grid-container">
            <?php if ($section_title = get_field('points_title')): ?>
                <h2 class="points__title">
                    <?php echo $section_title; ?>
                </h2>
            <?php endif; ?>
            <?php if ($section_subtitle = get_field('points_subtitle')): ?>
                <h5 class="points__subtitle">
                    <?php echo $section_subtitle; ?>
                </h5>
            <?php endif; ?>

            <div class="points__items">
                <?php while (have_rows('points')) :
                    the_row();
                    $icon = get_sub_field('icon');
                    $text = get_sub_field('text');
                    if ($icon && $text): ?>
                        <div class="points__item">
                            <div class="points__icon">
                                <?php echo wp_get_attachment_image($icon['id'], 'large'); ?>
                            </div>
                            <div class="points__text">
                                <?php echo $text; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile;; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
