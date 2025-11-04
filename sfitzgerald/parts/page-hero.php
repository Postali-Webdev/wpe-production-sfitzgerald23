<?php
$page_thumbnail = get_the_post_thumbnail_url();

if ($page_thumbnail) :?>

    <section class="page-hero" <?php bg($page_thumbnail); ?>>
        <div class="page-hero__overlay">
            <div class="grid-container">
                <div class="grid-x grid-margin-x">
                    <div class="cell medium-8">
                        <h1 class="page-title entry__title"><?php the_title(); ?></h1>
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

    <section class="mobile-form">
        <div class="grid-container">
            <div class="grid-x grid-margin-x">
                <div class="cell">
                    <?php $sidebar_form = get_field('sidebar_form', 'options'); ?>
                    <?php if (class_exists('GFAPI') && !empty($sidebar_form) && is_array($sidebar_form)) : ?>
                        <div class="custom-sidebar__form">
                            <?php echo do_shortcode("[gravityform id='{$sidebar_form['id']}' title='true' description='false' ajax='true']"); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
