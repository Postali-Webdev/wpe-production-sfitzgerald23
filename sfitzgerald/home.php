<?php
/**
 * Home
 *
 * Standard loop for the blog-page
 */
get_header(); ?>

<main class="main-content">
    <?php
    if ( get_option('page_for_posts') ) {
        $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_option('page_for_posts')),'full');
        $featured_image = $img[0];
        $title = get_the_title(get_option('page_for_posts'));
    }

    if ($featured_image) :?>

        <section class="page-hero" <?php bg($featured_image); ?>>
            <div class="page-hero__overlay">
                <div class="grid-container">
                    <div class="grid-x grid-margin-x">
                        <div class="cell medium-10">
                            <h1 class="page-title entry__title"><?php echo  $title; ?></h1>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    <?php else: ?>
        <section class="page-hero-no-bg">
            <div class="grid-container">
                <div class="grid-x grid-margin-x">
                    <div class="cell"><h1 class="page-title page-title-no-bg entry__title"><?php the_title(); ?></h1></div>
                </div>
            </div>

        </section>

    <?php endif; ?>

    <div class="grid-container">
        <div class="grid-x ">
            <div class="cell">
                <?php
                if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                }
                ?>
            </div>
        </div>
        <div class="grid-x grid-margin-x posts-list" >
            <!-- BEGIN of Blog posts -->
            <div class="large-8 medium-8 small-12 cell posts-list-wrap custom-template-content">
				
				<div class="category-dropdown">
                        <?php

                        $categories = get_terms( array(
							'taxonomy' => 'category',
                            'exclude'       => array('12', '18', '24', '28', '21', '20', '16', '19', '26', '23', '25', '17', '27', '22'),
                            'hide_empty' => true,
                        ) );

                        $select = "<select name='cat-custom' id='cat-custom' class='postform category-form'>";
                        $text = 'Select category';
                        $select .= '<option value="" disabled selected>' . $text . '</option>';
                        foreach($categories as $category){
                            /*if($category->count > 0){*/
                            $select.= "<option value='".$category->slug."'>".$category->name."</option>";
                            /*}*/
                        }

                        $select.= "</select>";

                        echo $select;
                        ?>
                    </div>
				
				
				<?php
                    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
                    // arguments, adjust as needed
                    $args = array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'posts_per_page' => 5,
                        'paged'          => $paged,
                    );

                    $id = get_the_ID();

                    global $wp_query;
                    $wp_query = new WP_Query($args);

                    if ($wp_query->have_posts()) : ?>
                    <div class="faqs-list-js">
                        <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                            <div class="template-faq__item ">
                                <?php get_template_part('parts/loop', 'post'); // Post item?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <?php endif; ?>
					<div class="pagination">
						<?php echo foundation_pagination(); ?>
					</div>
                </div>
            <!-- END of Blog posts -->

				<!-- BEGIN of sidebar -->
				<div class="large-4 medium-4 small-12 cell sidebar">
					<?php get_sidebar('right'); ?>
				</div>
				<!-- END of sidebar -->
			</div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
