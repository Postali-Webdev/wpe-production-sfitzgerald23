<?php if (have_rows('cta')): ?>
    <section class="cta">
        <div class="grid-container">
            <div class="grid-x grid-margin-x cta__list">
                <?php
                while (have_rows('cta')) : the_row();
                    $index = get_row_index(); ?>
                    <div class="cta__item cell small-12 medium-12 large-4">
                        <?php if ($title = get_sub_field('title')): ?>
                            <?php
                            echo '<h3 class="cta__item-title">' . $title . '</h3>';
                        endif;
                        if ($link = get_sub_field('link')):?>
                            <a class="button <?php echo $index == 2 ? 'button-green' : false; ?>"
                               href="<?php echo esc_url($link['url']); ?>"
                               target="<?php echo esc_attr($link['target'] ?: '_self'); ?>"><?php echo esc_html($link['title']); ?></a>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

<?php endif; ?>


