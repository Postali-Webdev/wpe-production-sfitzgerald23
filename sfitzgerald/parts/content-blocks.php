<?php

// Check rows existexists.
if (have_rows('content_block')): ?>
    <section class="content-block">
        <div class="grid-container fluid">

            <?php // Loop through rows.
            while (have_rows('content_block')) : the_row();
                $image_side = get_sub_field('image_side');
                $parent_index = get_row_index(); ?>
                <div class="grid-x">
                    <div
                        class="cell small-12  medium-12 large-6  <?php echo $image_side ? "content-block-order" : '' ?>">
                        <?php if ($image = get_sub_field('image')): ?>
                            <picture>
                                <?php if ($mobile_image = get_sub_field('mobile_image')): ?>
                                    <source media="(max-width:640px)"
                                            srcset="<?php echo esc_url($mobile_image['url']); ?>">
                                <?php endif; ?>
                                <?php echo wp_get_attachment_image($image['ID'], 'large', false, ['class' => 'content-block__img']); ?>
                            </picture>
                        <?php endif; ?>
                    </div>
                    <div class="cell small-12 medium-12 large-6">
                        <?php
                        // Check rows existexists.
                        if (have_rows('text')): ?>
                            <div class="content-block__list">
                                <?php while (have_rows('text')) : the_row();
                                    // Load sub field value.
                                    $index = get_row_index(); ?>
                                    <div class="content-block__item <?php echo $index == 2 ? "second-item" : false ?>">
                                        <?php if ($title = get_sub_field('title')): ?>
                                            <h2 class="content-block__item-title"><?php echo $title; ?></h2>
                                        <?php endif; ?>
                                        <?php if ($text = get_sub_field('text')): ?>
                                            <?php echo $text; ?>
                                        <?php endif; ?>
                                        <?php if ($button = get_sub_field('button')): ?>
                                            <a class="button read-more" href="<?php echo esc_url($button['url']); ?>"
                                               target="<?php echo esc_attr($button['target'] ?: '_self'); ?>"><?php echo esc_html($button['title']); ?></a>
                                        <?php endif; ?>
                                    </div>

                                <?php endwhile; ?>
                            </div>
                        <?php endif;
                        ?>
                    </div>
                </div>

            <?php endwhile; ?>

        </div>
    </section>
<?php endif; ?>
