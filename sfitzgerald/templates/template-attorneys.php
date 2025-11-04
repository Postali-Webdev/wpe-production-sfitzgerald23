<?php
/**
 * Template Name: Attorneys
 */
get_header(); ?>

<main class="main-content">
    <?php get_template_part('parts/page-hero'); ?>
    <div class="grid-container">
        <div class="grid-x ">
            <div class="cell medium-8">
                <?php
                if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                }
                ?>
            </div>
        </div>
        <div class="grid-x grid-margin-x">
            <div class="cell large-8 medium-8 small-12">
                <div class="grid-x attorneys-wrap custom-template-content grid-margin-x">
                    <!-- BEGIN of Blog posts -->

                    <?php

                    // arguments, adjust as needed
                    $args = array(
                        'post_type' => 'attorneys',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                    );

                    $id = get_the_ID();

                    global $wp_query;
                    $wp_query = new WP_Query($args);

                    if ($wp_query->have_posts()) : ?>
                        <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                            <div class="cell large-4 medium-6 small-12">

                                <?php get_template_part('parts/loop', 'attorneys'); ?>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <div class="grid-x grid-margin-x">
                    <?php echo do_shortcode('[usp]'); ?>
                </div>
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
