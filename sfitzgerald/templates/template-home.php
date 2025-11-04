<?php
/**
 * Template Name: Home Page
 */
get_header(); ?>

<!--HOME PAGE SLIDER-->
<?php if (shortcode_exists('slider')) {
    echo do_shortcode('[slider]');
} ?>
<!--END of HOME PAGE SLIDER-->
<main>
    <?php get_template_part('parts/hero-home'); ?>
    <?php get_template_part('parts/awards'); ?>
    <?php get_template_part('parts/text-image'); ?>
    <?php get_template_part('parts/content-blocks'); ?>
    <?php get_template_part('parts/testimonials'); ?>
    <?php get_template_part('parts/cta'); ?>
    <?php get_template_part('parts/attorneys'); ?>
    <?php get_template_part('parts/media'); ?>
    <?php get_template_part('parts/practice-areas'); ?>
    <?php get_template_part('parts/cta'); ?>
    <?php get_template_part('parts/guides'); ?>
    <?php get_template_part('parts/faq'); ?>
    <?php get_template_part('parts/blog'); ?>
</main>

<!-- END of main content -->

<?php get_footer(); ?>
