<?php
/**
 * Template Name: Testimonials
 */
get_header();
global $post;
$page_id = $post->ID;
?>

<main class="main-content">
    <?php get_template_part('parts/page-hero'); ?>
    <div class="grid-container">
        <div class="grid-x ">
            <div class="cell  medium-8">
                <?php
                if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                }
                ?>
            </div>
        </div>
        <div class="grid-x grid-margin-x" style="margin-left: 0; margin-right: 0;">
            <div class="cell large-8 medium-8 small-12" style="margin-left: 0; margin-right: 0;">
                <?php the_content(); ?>

                <div class="grid-x template-testimonials custom-template-content grid-margin-x">
                    <!-- BEGIN of Blog posts -->

                    <?php
                    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
                    // arguments, adjust as needed
                    $args = array(
                        'post_type' => 'testimonial',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
//                         'paged'          => $paged,
                    );
                    $id = get_the_ID();

                    global $wp_query;
                    $wp_query = new WP_Query($args);

                    if ($wp_query->have_posts()) : ?>
                        <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                            <div class="cell small-12">
                                <div class="testimonials__item">
                                    <?php
                                    $google_link = get_field('google_review_link');
                                    $author = get_field('author');
                                    ?>
                                    <?php if ($testimonial_heading = get_field('pre-heading')) : ?>
                                        <h2><?php echo $testimonial_heading; ?></h2>
                                    <?php endif; ?>
                                    <a href="<?php echo $google_link; ?>"><?php display_svg(asset_path('images/google-initial.svg')); ?></a>
                                    <h3><?php the_title(); ?></h3>
                                    <?php the_content(); ?>
                                    <h3 class="testimonials__author"><?php echo $author; ?></h3>
                                    <?php display_svg(asset_path('images/stars.svg')); ?>
                                </div>
                            </div>
                        <?php endwhile; ?>

                        <?php wp_reset_postdata();
                    endif; ?>
                </div>
                <?php if ($bottom_text = get_field('bottom_text', $page_id)) : ?>
                    <div class="testimonials__bottom-text">
                        <?php echo $bottom_text; ?>
                    </div>
                <?php endif; ?>
            </div>
            <!-- BEGIN of sidebar -->
            <div class="large-4 medium-4 small-12 cell sidebar">
                <?php get_sidebar('right'); ?>
            </div>
            <!-- END of sidebar -->
        </div>
    </div>
</main>


<?php get_footer(); ?>
