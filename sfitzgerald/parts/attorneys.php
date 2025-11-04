<?php $attorneys_title = get_field('attorneys_title');
?>
<section class="home-attorneys">
    <div class="grid-container">
        <div class="grid-x">
            <div class="cell text-center">
                <h2 class="home-attorneys__title"><?php echo $attorneys_title; ?> </h2>
            </div>
        </div>
        <?php
        $featured_posts = get_field('attorneys_list');
        if ($featured_posts): ?>
        <div class="grid-x ">
            <div class="cell">
                <div class="attorney__slide">
                    <?php foreach ($featured_posts as $post):

                        // Setup this post for WP functions (variable must be named $post).
                        setup_postdata($post); ?>
                        <div class="home-attorneys__item">
                            <div class="home-attorneys__item-content">
                                <h4><?php the_title(); ?></h4>
                                <?php if ($position = get_field('position')): ?>
                                    <h3><?php echo $position; ?></h3>
                                <?php endif; ?>
                                <?php the_content(); ?>
                                <a class="button" href="<?php the_permalink(); ?>"><?php _e('learn more') ?></a>
                            </div>
                            <div class="home-attorneys__item-image">
                                <?php the_post_thumbnail(); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php
                    wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="nav-slider">
    <?php endif; ?>
    <?php $featured_nav_posts = get_field('attorneys_list'); ?>
    <div class="grid-container">
        <div class="grid-x">
            <div class="cell">
                <div class="nav-slider__nav-slider">
                    <?php foreach ($featured_nav_posts as $post2):
                        $position = get_field('position', $post2);
                        $nav_image = get_post_thumbnail_id($post2->ID);
                        // Setup this post for WP functions (variable must be named $post).
                        ?>
                        <?php if ($nav_image): ?>
                        <div class="nav-slider__nav-item">
                            <div class="nav-slider__nav-item-image">
                                <?php echo wp_get_attachment_image($nav_image, 'medium', '', ['data-no-lazy' => '1']); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</div>

