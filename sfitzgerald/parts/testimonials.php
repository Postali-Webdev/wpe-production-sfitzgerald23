<?php
$featured_posts = get_field('testimonials');
if ($featured_posts): ?>
    <section class="testimonials ">
        <div class="grid-container fluid">
            <?php if ($testimonials_title = get_field('testimonials_title')): ?>
                <div class="grid-x">
                    <div class="cell text-center">
                        <h2 class="testimonials__title"><?php echo $testimonials_title; ?> </h2>
                    </div>
                </div>
            <?php endif; ?>
            <div class="grid-x">
                <div class="cell small-12 text-center">
                    <?php the_content(); ?>
                </div>
                <div class="cell small-12 text-center">
                    <div class="testimonials__slider">
                        <?php foreach ($featured_posts as $post):
                            $google_link = get_field('google_review_link');

                            // Setup this post for WP functions (variable must be named $post).
                            setup_postdata($post); ?>
                            <div class="testimonials__item">
                                <a href="<?php echo $google_link; ?>"><?php display_svg(asset_path('images/google-initial.svg')); ?></a>
                                <?php the_content(); ?>
                                <?php display_svg(asset_path('images/stars.svg')); ?>
                                <?php if ($author = get_field('author')): ?>
                                    <h3><?php echo $author; ?></h3>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>

                        <?php
                        // Reset the global post object so that the rest of the page works correctly.
                        wp_reset_postdata(); ?>

                    </div>
                    <div class="testimonials__arrows-wrap">
                        <div class="testimonials__prev-arrow"><i class="fa-regular fa-angle-left"></i></div>
                        <div class="testimonials__next-arrow"><i class="fa-regular fa-angle-right"></i></div>
                    </div>
                    <div class="testimonials__button">
                        <?php
                        if ($testimonials_button = get_field('testimonials_button')):?>
                            <a class="button" href="<?php echo esc_url($testimonials_button['url']); ?>"
                               target="<?php echo esc_attr($testimonials_button['target'] ?: '_self'); ?>"><?php echo esc_html($testimonials_button['title']); ?></a>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
