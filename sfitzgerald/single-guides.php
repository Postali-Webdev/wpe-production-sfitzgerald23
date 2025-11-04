<?php
/**
 * Single
 *
 * Loop container for single post content
 */
get_header(); ?>

<main class="main-content">
    <?php $page_thumbnail = get_the_post_thumbnail_url(); ?>
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
        <div class="grid-x ">
            <!-- BEGIN of page content -->
            <div class="large-8 medium-12 small-12 cell">
                <?php if (have_rows('table_of_contents')): ?>
                    <div class="table-of-contents">
                        <?php if ($table_of_contents_title = get_field('table_of_contents_title')) : ?>
                            <h3 class="table-of-contents__title"><?php echo $table_of_contents_title; ?> <i
                                    class="fa-sharp fa-solid fa-angle-down"></i></h3>
                        <?php endif; ?>
                        <ol class="table-of-contents__list">
                            <?php while (have_rows('table_of_contents')) : the_row();

                                // Load sub field value.
                                $title = get_sub_field('title');
                                $anchor_link = get_sub_field('anchor_link');
                                ?>
                                <li class="table-of-contents__item"><a
                                        href="#<?php echo $anchor_link; ?>"><?php echo $title; ?></a></li>
                            <?php endwhile; ?>
                        </ol>

                    </div>
                <?php endif; ?>

                <article <?php post_class('entry'); ?>>
                    <div class="entry__content">
                        <?php the_content('', true); ?>
                        <?php $guide_form = get_field('guide_form'); ?>
                        <?php if ($guide_form) : ?>
                            <?php if ($guides_sub_title = get_field('guides_sub_title')): ?>
                                <h2 class="form-title">
                                    <?php echo $guides_sub_title; ?>
                                </h2>
                            <?php endif; ?>
                            <?php echo do_shortcode("$guide_form"); ?>
                        <?php endif; ?>
                    </div>
                </article>

            </div>
            <!-- END of page content -->

            <!-- BEGIN of sidebar -->
            <div class="large-4 medium-12 small-12 cell sidebar <?php echo $page_thumbnail ? false : 'page-no-bg' ?>">
                <?php get_sidebar('right'); ?>
            </div>
            <!-- END of sidebar -->
        </div>
    </div>
</main>

<?php get_footer(); ?>
