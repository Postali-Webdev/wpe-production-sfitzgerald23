<?php
$faq_list = get_field('faq_list');
$faq_title = get_field('faq_title');
$faq_subtitle = get_field('faq_subtitle');
if ($faq_list): ?>

    <section class="faq-section">
        <div class="grid-container ">
            <div class="grid-x">
                <div class="cell medium-4">
                    <div class="faq-section__slider-nav-wrap">
                        <div class="faq-section__slider-nav-prev"><i class="fa-regular fa-angle-left"></i></div>
                        <div class="faq-section__slider-nav-next"><i class="fa-regular fa-angle-right"></i></div>
                    </div>
                    <?php if ($faq_title) : ?>
                        <h2 class="faq-section__title"><?php echo $faq_title; ?></h2>
                    <?php endif; ?>
                    <?php if ($faq_subtitle) : ?>
                        <h3 class="faq-section__sub-title"><?php echo $faq_subtitle; ?></h3>
                    <?php endif; ?>
                </div>
                <div class="cell medium-8">
                    <div class="faq-section__slider">
                        <?php foreach ($faq_list as $post):
                            // Setup this post for WP functions (variable must be named $post).
                            setup_postdata($post); ?>
                            <div class="faq-section__item">
                                <h3><a class="faq-section__item-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <a class="button faq-section__button" href="<?php the_permalink(); ?>"><?php _e('learn more'); ?></a>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <?php
    // Reset the global post object so that the rest of the page works correctly.
    wp_reset_postdata(); ?>
<?php endif; ?>
