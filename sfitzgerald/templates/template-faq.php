<?php
/**
 * Template Name: FAQ
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
                <div class="template-faq custom-template-content">
                    <!-- BEGIN of Blog posts -->
                    <div class="category-dropdown">
                        <?php if ($categories_heading = get_field('categories_heading')): ?>
                            <div class="category-dropdown__title">
                                <?php echo $categories_heading; ?>
                            </div>
                        <?php endif; ?>
                        <?php

                        $categories = get_terms(array(
                            'taxonomy' => 'faq_category',
                            'hide_empty' => false,
                        ));

                        $select = "<select name='cat' id='cat' class='postform category-form'>";
                        $text = 'Select category';
                        $select .= '<option value="" disabled selected>' . $text . '</option>';
                        foreach ($categories as $category) {
                            /*if($category->count > 0){*/
                            $select .= "<option value='" . $category->slug . "'>" . $category->name . "</option>";
                            /*}*/
                        }

                        $select .= "</select>";

                        echo $select;
                        ?>
                    </div>

                    <?php if ($video = get_field('faq_video')):; ?>
                        <div class="embed-container">
                            <?php echo $video; ?>
                        </div>
                    <?php endif; ?>
                    <?php
                    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
                    // arguments, adjust as needed
                    $args = array(
                        'post_type' => 'faq',
                        'post_status' => 'publish',
                        'posts_per_page' => 5,
                        'paged' => $paged,
                    );

                    $id = get_the_ID();

                    global $wp_query;
                    $wp_query = new WP_Query($args);

                    if ($wp_query->have_posts()) : ?>
                        <div class="faqs-list-js">
                            <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                                <div class="template-faq__item ">
                                    <?php if ($thumbnail = get_the_post_thumbnail()) : ?>
                                        <div class="template-faq__thumbnail">
                                            <?php the_post_thumbnail('large', array('class' => 'template-faq__image preview__thumb skip-lazy')); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div
                                        class="template-faq__content <?php echo $thumbnail ? false : 'template-faq__content-full-width'; ?>">
                                        <h2><?php the_title(); ?></h2>
                                        <?php $content = get_extended(get_post_field('post_content')); ?>
                                        <p class="template-faq__text "><?php echo $content['extended'] ? $content['main'] : wp_trim_words(get_the_content(), 30) ?></p>
                                        <a href="<?php the_permalink(); ?>" class="button"><?php _e('learn more') ?></a>
                                    </div>

                                </div>
                            <?php endwhile;
                            $paginateArgs = array(
                                'base' => '%#%',
                                'format' => '%#%',
                                'current' => $paged,
                                'prev_text' => __('«'),
                                'next_text' => __('»'),
                                'total' => $wp_query->max_num_pages
                            ); ?>

                            <div class="archive-pagination js-faq-pagination pagination">
                                <?php echo str_replace(array('http:', '//'), array('', ''), paginate_links($paginateArgs)); ?>
                            </div>

                        </div>
                    <?php endif; ?>
                    <?php wp_reset_query(); ?>

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
