<?php
/**
 * Template Name: Landing Page
 */
get_header('landing'); ?>
<?php
$landing_hero_bg = get_the_post_thumbnail_url();;
$landing_hero_title = get_field('landing_hero_title');
$landing_hero_subtitle = get_field('landing_hero_subtitle');
$landing_hero_button_url = get_field('landing_hero_button_url');
$landing_hero_button_text = get_field('landing_hero_button_text');
$landing_hero_form = get_field('landing_hero_form');
$landing_hero_mobile_form_button = get_field('landing_hero_mobile_form_button');
?>
<main class="main-content">
    <section class="landing-hero" <?php bg($landing_hero_bg); ?>>
        <div class="landing-hero__overlay">
            <div class="grid-container">
                <div class="grid-x text-center">
                    <div class="cell medium-12">
                        <div class="landing-hero__content">
                            <?php if ($landing_hero_subtitle) : ?>
                                <h3 class="landing-hero__subtitle"><?php echo $landing_hero_subtitle; ?></h3>
                            <?php endif; ?>
                            <?php if ($landing_hero_title) : ?>
                                <h1 class="landing-hero__title"><?php echo $landing_hero_title; ?></h1>
                            <?php endif; ?>
                            <?php if ($landing_hero_button_url) : ?>
                                <a href="<?php echo $landing_hero_button_url; ?>"
                                   class="button buttton-border landing-hero__button"><?php echo $landing_hero_button_text; ?></a>
                            <?php endif; ?>
                            <?php
                            if ($landing_hero_mobile_form_button): ?>
                                <a class="button button-green buttton-border hero-home__form-button hide-for-large hide-for-medium"
                                   href="<?php echo esc_url($landing_hero_mobile_form_button['url']); ?>"><?php echo $landing_hero_mobile_form_button['title']; ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!--                    <div class="cell medium-6">-->
                    <!--                        <div class="landing-hero__form">-->
                    <!--                            --><?php //if (class_exists('GFAPI') && !empty($landing_hero_form) && is_array($landing_hero_form)) : ?>
                    <!--                                --><?php //echo do_shortcode("[gravityform id='{$landing_hero_form['id']}' title='true' description='false' ajax='true']"); ?>
                    <!--                            --><?php //endif; ?>
                    <!--                        </div>-->
                    <!--                    </div>-->
                </div>
            </div>
        </div>
    </section>

    <?php if(get_field('landing_table_contents_title')) { ?>

    <div class="grid-container">
        <div class="grid-x text-center">
            <div class="cell medium-12">
                <?php if (have_rows('landing_table_contents')): ?>
                    <div class="table-of-contents landing-table-of-contents">
                        <?php if ($table_of_contents_title = get_field('landing_table_contents_title')) : ?>
                            <h3 class="table-of-contents__title"><?php echo $table_of_contents_title; ?> <i
                                    class="fa-sharp fa-solid fa-angle-down"></i></h3>
                        <?php endif; ?>
                        <ol class="table-of-contents__list">
                            <?php while (have_rows('landing_table_contents')) : the_row();

                                // Load sub field value.
                                $title = get_sub_field('title');
                                $anchor_link = get_sub_field('anchor_link');
                                ?>
                                <li class="table-of-contents__item"><a
                                        href="#<?php echo $anchor_link; ?>"><?php echo $title; ?></a>
                                </li>
                            <?php endwhile; ?>
                        </ol>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php } ?>

    <?php
    $full_width_text = get_field('full_width_text');
    if ($full_width_text) :
        ?>
        <section class="full-width-text">
            <div class="grid-container">
                <div class="grid-x text-center">
                    <div class="cell medium-7" style="margin: 0 auto;">
                        <?php if(get_field("form_shortcode")): ?>
                            <h2>Contact Simon Fitzgerald Today</h2>
                            <?php echo do_shortcode(get_field("form_shortcode")); ?>
                        <?php endif; ?>
                        <p>&nbsp;</p>
                        <?php echo $full_width_text; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php $badges = get_field('badges');

    if ($badges) :?>

        <section class="awards">
            <div class="grid-container fluid">
                <div class="grid-x awards__list awards__slider">
                    <?php
                    // Check rows existexists.
                    if (have_rows('badges')):

                        // Loop through rows.
                        while (have_rows('badges')) : the_row();

                            // Load sub field value.
                            $image = get_sub_field('image');
                            $link = get_sub_field('link');
                            if ($image):?>
                                <div class="awards__item" style="padding:0 10px;">
                                    <a href="<?php echo $link; ?>"><?php echo wp_get_attachment_image($image['ID'], 'large'); ?></a>
                                </div>
                            <?php endif; ?>

                        <?php endwhile;

                    endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    $l_t_image = get_field('l_t_image');
    $l_i_text = get_field('l_i_text');
    if ($l_t_image || $l_i_text) : ?>

        <section class="text-image">
            <div class="grid-container">
                <div class="grid-x grid-margin-x">
                    <div class="cell large-12">
                        <?php echo $l_i_text; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    

    <?php
    $b_full_width_text = get_field('b_full_width_text');
    if ($b_full_width_text) :
        ?>
        <section class="full-width-text full-width-text-bottom">
            <div class="grid-container">
                <div class="grid-x text-center">
                    <div class="cell medium-12">
                        <?php echo $b_full_width_text; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if (have_rows('landing_cta')): ?>
        <section class="cta">
            <div class="grid-container">
                <div class="grid-x grid-margin-x cta__list">
                    <?php
                    while (have_rows('landing_cta')) : the_row();
                        $title = get_sub_field('title');
                        $link = get_sub_field('link');
                        $index = get_row_index(); ?>
                        <div class="cta__item cell small-12 medium-12 large-4">
                            <?php if ($title):
                                echo '<h3 class="cta__item-title">' . $title . '</h3>';
                            endif;
                            if ($link):
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                <a class="button <?php echo $index == 2 ? 'button-green' : false; ?>"
                                   href="<?php echo esc_url($link_url); ?>"
                                   target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>

    <?php endif; ?>

    <?php
    $left_content = get_field('left_content');
    $right_content = get_field('right_content');
    $right_content_button = get_field('right_content_button');
    $left_content_button = get_field('left_content_button');
    $right_content_background_image = get_field('right_content_background_image');
    ?>

    <div class="landing-testimonial">
        <div class="grid-container fluid">
            <div class="grid-x">
                <div class="cell medium-6">
                    <div class="landing-testimonial__left-col">
                        <?php echo $left_content;
                        if ($left_content_button):
                            $link_url = $left_content_button['url'];
                            $link_title = $left_content_button['title'];
                            $link_target = $left_content_button['target'] ? $left_content_button['target'] : '_self';
                            ?>
                            <a class="read-more button landing-testimonial__book-download"
                               href="<?php echo esc_url($link_url); ?>"
                               target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                        <?php endif; ?>
                    </div>

                </div>
                <div class="cell medium-6">
                    <div class="landing-testimonial__book" <?php bg($right_content_background_image); ?>>
                        <div class="landing-testimonial__book-overlay">
                            <div class="landing-testimonial__book-content">
                                <?php
                                echo $right_content;
                                if ($right_content_button):
                                    $link_url = $right_content_button['url'];
                                    $link_title = $right_content_button['title'];
                                    $link_target = $right_content_button['target'] ? $right_content_button['target'] : '_self';
                                    ?>
                                    <a class="read-more button landing-testimonial__book-download"
                                       href="<?php echo esc_url($link_url); ?>"
                                       target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <section class="map">
        <?php
        $landing_map_title = get_field('landing_map_title');
        $landing_map = get_field('landing_map');
        $landing_map_text = get_field('landing_map_text');
        $locations_title = get_field('locations_title', 'options');
        ?>
        <div class="grid-container">
            <?php if ($locations_title): ?>
                <div class="grid-x text-center">
                    <div class="cell ">
                        <?php
                        echo '<h2 class="map__title">' . $locations_title . '</h2>';
                        ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="grid-x grid-margin-x map-slider">
                <div class="cell medium-12 map__item text-center">
                    <?php if ($landing_map): ?>
                        <?php echo $landing_map; ?>
                    <?php endif; ?>
                    <?php if ($landing_map_title): ?>
                        <h3 class="map__item-title"><?php echo $landing_map_title; ?></h3>
                    <?php endif; ?>
                    <?php if ($landing_map_text): ?>
                        <?php echo $landing_map_text; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>


<?php get_footer(); ?>

