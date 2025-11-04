<?php
/**
 * Single
 *
 * Loop container for single post content
 */
get_header(); ?>
<main class="main-content">
    <?php get_template_part('parts/single-hero'); ?>

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
        <div class="grid-x single-attorney-wrap">
            <!-- BEGIN of post content -->
            <div class="large-8 medium-8 small-12 cell attorney-tabs__wrap">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) :
                        the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
                            <?php if (have_rows('tabs')): ?>
                                <div class="attorney-tabs">
                                    <ul class="tabs" data-tabs id="attorney-tabs">
                                        <?php while (have_rows('tabs')) : the_row();
                                            $tab_name = get_sub_field('tab_name');
                                            $index = get_row_index();
                                            ?>
                                            <li class="tabs-title <?php echo $index == 1 ? 'is-active': false; ?>"><a href="#panel<?php echo $index; ?>" aria-selected="true"><?php echo $tab_name; ?></a></li>
                                        <?php endwhile; ?>
                                    </ul>
                                    <div class="tabs-content" data-tabs-content="attorney-tabs">

                                            <?php while (have_rows('tabs')) : the_row();
                                                $content = get_sub_field('content');
                                                $index = get_row_index(); ?>
                                        <div class="tabs-panel <?php echo $index == 1 ? 'is-active': false; ?>" id="panel<?php echo $index; ?>">
                                              <?php echo $content; ?>
                                        </div>
                                           <?php endwhile; ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                        </article>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <!-- END of post content -->

            <!-- BEGIN of sidebar -->
            <div class="large-4 medium-4 small-12 cell sidebar">
                <?php get_sidebar('right'); ?>
            </div>
            <!-- END of sidebar -->
        </div>
    </div>
</main>

<?php get_footer(); ?>
