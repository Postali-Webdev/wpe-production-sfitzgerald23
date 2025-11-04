<?php
/**
 * Template Name: Guides
 */
get_header(); ?>

<main class="main-content">
    <?php get_template_part('parts/page-hero'); ?>
    <div class="grid-container">
        <div class="grid-x ">
            <div class="cell medium-8 ">
                <?php
                if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                }
                ?>
            </div>
        </div>
        <div class="grid-x grid-margin-x">
            <div class="cell large-8 medium-8 small-12">
                <div class="grid-x template-guides guides custom-template-content grid-margin-x">
                    <div class="cell small-12">
                        <div class="guides__forms">
                            <?php $got_questions = get_field('got_questions_form'); ?>
                            <?php if (class_exists('GFAPI') && !empty($got_questions) && is_array($got_questions)) : ?>
                                <div class="guides__forms-questions">
                                    <?php echo do_shortcode("[gravityform id='{$got_questions['id']}' title='true' description='true' ajax='true']"); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- BEGIN of Blog posts -->

                    <?php
                    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
                    // arguments, adjust as needed
                    $args = array(
                        'post_type' => 'guides',
                        'post_status' => 'publish',
                        'posts_per_page' => 10,
                        'paged'          => $paged,
                    );

                    $id = get_the_ID();

                    global $wp_query;
                    $wp_query = new WP_Query($args);

                    if ($wp_query->have_posts()) : ?>
                        <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                            <div class="cell small-12">

                                <div class="guides__item">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail(); ?>
                                    </a>
                                    <div class="guides__item-text">
                                        <h2><?php the_title(); ?></h2>
                                        <?php $subtitle = get_field("guides_sub_title"); ?>
                                        <?php if ($subtitle): ?>
                                            <h3><?php echo $subtitle; ?></h3>
                                        <?php endif; ?>
                                        <?php $content = get_extended(get_post_field('post_content')); ?>
                                        <p class="template-faq__text "><?php echo $content['extended'] ? $content['main'] : wp_trim_words(get_the_content(), 30) ?></p>
                                        <a href="<?php the_permalink(); ?>" class="button"><?php _e('Download Here') ?></a>
                                    </div>

                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <?php foundation_pagination(); ?>
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
