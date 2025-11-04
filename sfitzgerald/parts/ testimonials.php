<?php
$testimonials_title = get_field('testimonials_title');
?>
<section class="testimonials">
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <div class="cell text-center">
                <h2 class="testimonials__title"><?php echo $testimonials_title; ?> </h2>

            </div>
        </div>
        <div class="grid-x grid-margin-x">
            <div class="cell text-center">
                <div class="testimonials__slider">
                    <?php
                    $featured_posts = get_field('testimonials');
                    if( $featured_posts ): ?>

                            <?php foreach( $featured_posts as $post ):
                                $google_link = get_field('google_review_link');
                                $author = get_field('author');
                                // Setup this post for WP functions (variable must be named $post).
                                setup_postdata($post); ?>
                                <div class="testimonials__item">
                                    <a href="<?php echo $google_link; ?>"><?php display_svg(asset_path('images/google-initial.svg')); ?></a>
                                    <?php the_content(); ?>
                                    <?php display_svg(asset_path('images/stars.svg')); ?>
                                    <h3><?php echo $author; ?></h3>
                                </div>
                            <?php endforeach; ?>

                        <?php
                        // Reset the global post object so that the rest of the page works correctly.
                        wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
                <div class="testimonials__arrows-wrap">
                    <div class="testimonials__prev-arrow"><i class="fa-regular fa-angle-left"></i></div>
                    <div class="testimonials__next-arrow"><i class="fa-regular fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</section>
