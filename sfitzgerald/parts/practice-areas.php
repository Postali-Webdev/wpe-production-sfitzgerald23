<?php if (have_rows('practice_areas')): ?>
    <section class="practice-areas">
        <div class="grid-container">
            <div class="grid-x grid-margin-x">
                <?php
                while (have_rows('practice_areas')) : the_row(); ?>
                    <div class="cell medium-6 practice-areas__item-wrap">
                        <div class="practice-areas__item">
                            <?php if ($practice_areas_icon = get_sub_field('practice_areas_icon')) :
                                display_svg($practice_areas_icon);
                            endif; ?>
                            <?php if ($practice_areas_text = get_sub_field('practice_areas_text')) :
                                echo $practice_areas_text;
                            endif; ?>
                            <?php if ($practice_areas_button = get_sub_field('practice_areas_button')): ?>
                                <a class="button" href="<?php echo esc_url($practice_areas_button['url']); ?>"
                                   target="<?php echo esc_attr($practice_areas_button['target'] ?: '_self'); ?>"><?php echo esc_html($practice_areas_button['title']); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
