<?php
/**
 * Template Name: Magnet page
 */
get_header(); ?>


<main class="main-content">
    <?php get_template_part('parts/guides/hero'); ?>
    <?php if (get_field('graphic_enable_section')) {
        get_template_part('parts/guides/graphic');
    }
    if (get_field('list_enable_section')) {
        get_template_part('parts/guides/list');
    }
    if (get_field('img_w_text_enable_section')) {
        get_template_part('parts/guides/img-w-text');
    }
    if (get_field('points_enable_section')) {
        get_template_part('parts/guides/points');
    }
    if (get_field('pros_cons_enable_section')) {
        get_template_part('parts/guides/pros-cons');
    }
    if (get_field('resources_enable_section')) {
        get_template_part('parts/guides/resources');
    } ?>
</main>

<?php get_footer(); ?>
