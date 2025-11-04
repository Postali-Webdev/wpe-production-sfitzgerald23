<?php
/**
 * Header
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Set up Meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta charset="<?php bloginfo('charset'); ?>">

    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <!-- Remove Microsoft Edge's & Safari phone-email styling -->
    <meta name="format-detection" content="telephone=no,email=no,url=no">

    <!-- Add external fonts below (GoogleFonts / Typekit) -->
    <link rel="stylesheet" href="https://use.typekit.net/ffm8ytn.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap">

    <?php wp_head(); ?>
</head>

<body <?php body_class('no-outline fxy'); ?>>
<?php wp_body_open(); ?>

<!-- <div class="preloader hide-for-medium">
    <div class="preloader__icon"></div>
</div> -->

<!-- BEGIN of header -->
<header class="header">
    <div class="grid-container fluid">
        <div class="grid-x header-first-row">
            <div class="medium-2 small-6 large-2 cell">
                <div class="logo text-center medium-text-left">

                    <?php show_custom_logo(); ?><span class="show-for-sr"><?php echo get_bloginfo('name'); ?></span>
                </div>
            </div>
            <div class="medium-9 small-6 large-9 cell google-review-wrap">
                <div class="google-review">
                    <?php
                    $g_link = get_field('google_review', 'options');
                    if ($g_link):
                        $link_url = $g_link['url'];
                        $link_title = $g_link['title'];
                        $link_target = $g_link['target'] ? $g_link['target'] : '_self';
                        ?>
                        <a class="google-review__link" href="<?php echo esc_url($link_url); ?>"
                           target="<?php echo esc_attr($link_target); ?>"><?php display_svg(asset_path('images/g-review.svg')); ?></a>
                    <?php endif; ?>
                </div>
                <?php if(is_page(55874) || is_page(55881)) : ?>
                    <div class="header-locations">
                        <?php $header_contact_title = get_field('header_contact_title', 'options') ?>
                        <?php if ($header_contact_title) : ?>
                            <p class="header-locations__title"><?php echo $header_contact_title; ?></p>
                        <?php endif; ?>
                        <?php
                        // Load sub field value.
                        $shreveportmonroe_location = get_field('shreveportmonroe_location','options');
                        $shreveportmonroe_phone = get_field('shreveportmonroe_phone', 'options'); ?>

                        <div class="header-locations__list">
                            <div class="header-locations__item">
                                <p class="header-locations__item-title"><?php echo $shreveportmonroe_location; ?></p>
                                <?php
                                if ($shreveportmonroe_phone):
                                    ?>
                                    <a class="header-locations__item-link" href="tel:<?php echo sanitize_number($shreveportmonroe_phone); ?>"
                                       target=""><?php echo esc_html($shreveportmonroe_phone); ?></a>


                                <?php endif; ?>
                            </div>

                        </div>

                    </div>
                <?php elseif(is_page(55878) || is_page(55884)): ?>
                    <div class="header-locations">
                        <?php $header_contact_title = get_field('header_contact_title', 'options') ?>
                        <?php if ($header_contact_title) : ?>
                            <p class="header-locations__title"><?php echo $header_contact_title; ?></p>
                        <?php endif; ?>
                        <?php
                        // Load sub field value.
                        $lafayettelake_charles_location = get_field('lafayettelake_charles_location','options');
                        $lafayettelake_charles_phone = get_field('lafayettelake_charles_phone', 'options'); ?>

                        <div class="header-locations__list">
                            <div class="header-locations__item">
                                <p class="header-locations__item-title"><?php echo $lafayettelake_charles_location; ?></p>
                                <?php
                                if ($lafayettelake_charles_phone):
                                    ?>
                                    <a class="header-locations__item-link" href="tel:<?php echo sanitize_number($lafayettelake_charles_phone); ?>"
                                       target=""><?php echo esc_html($lafayettelake_charles_phone); ?></a>
                                <?php endif; ?>
                            </div>

                        </div>

                    </div>
                <?php else: ?>
                <div class="header-locations">
                    <?php $header_contact_title = get_field('header_contact_title', 'options') ?>
                    <?php if ($header_contact_title) : ?>
                        <p class="header-locations__title"><?php echo $header_contact_title; ?></p>
                    <?php endif; ?>
                    <?php
                    // Load sub field value.
                    $landing_page_location_name = get_field('landing_page_location_name','options');
                    $landing_page_location_phone = get_field('landing_page_location_phone', 'options'); ?>

                        <div class="header-locations__list">
                                <div class="header-locations__item">
                                <p class="header-locations__item-title"><?php echo $landing_page_location_name; ?></p>
                                <?php
                                if ($landing_page_location_phone):
                                    ?>
                                    <a class="header-locations__item-link" href="tel:<?php echo sanitize_number($landing_page_location_phone); ?>"
                                       target=""><?php echo esc_html($landing_page_location_phone); ?></a>


                                <?php endif; ?>
                                </div>

                        </div>

                </div>
                <?php endif; ?>
                <div class="mobile-contact-info hide-for-large">
                    <div class="mobile-contact-info__wrap">
                        <a href="#" class="mobile-contact-info__phone"></a>
                        <a href="#" class="mobile-contact-info__location"></a>
                    </div>

                        <div class="mobile-contact-info__list" style="transform: translate(-50%,-600%);">


                                <div class="mobile-contact-info__item">
                                <p class="mobile-contact-info__item-title"><?php echo $landing_page_location_name; ?></p>
                                <?php
                                if ($landing_page_location_phone):
                                    ?>
                                    <a class="mobile-contact-info__item-link" href="tel:<?php echo sanitize_number($landing_page_location_phone); ?>"
                                       target=""><?php echo esc_html($landing_page_location_phone); ?></a>

                                <?php elseif( $lafayettelake_charles_phone ) :  ?>
                                    <a class="mobile-contact-info__item-link" href="tel:<?php echo sanitize_number($lafayettelake_charles_phone); ?>"
                                    target=""><?php echo esc_html($lafayettelake_charles_phone); ?></a>

                                <?php elseif( $shreveportmonroe_phone ) :  ?>
                                    <a class="mobile-contact-info__item-link" href="tel:<?php echo sanitize_number($shreveportmonroe_phone); ?>"
                                    target=""><?php echo esc_html($shreveportmonroe_phone); ?></a>
                                <?php endif; ?>
                                </div>
                        </div>
                </div>
            </div>

        </div>
        <div class="grid-x second-header-row">
            <div class="small-12 cell">
                <div class="header-button">
                    <?php
                    // Check rows existexists.
                    if (have_rows('header_buttons', 'options')):

                        // Loop through rows.
                        while (have_rows('header_buttons', 'options')) : the_row();

                            // Load sub field value.
                            $link = get_sub_field('link');
                            $index = get_row_index();
                            // Do something...
                            if ($link):
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                <a class="button button-green <?php echo $index == 2 ? 'second-button' : false; ?>"
                                   href="<?php echo esc_url($link_url); ?>"
                                   target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                            <?php endif;
                            // End loop.
                        endwhile;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</header>

<div style="display:none;" class="header-search__wrap" data-closable>
    <div class="header-search__overlay">
        <?php echo get_search_form(); ?>
    </div>
</div>
<div class="header-socials">
    <div class="header-socials__button"><?php _e('socials'); ?></div>
    <?php if (have_rows('socials', 'options')) : ?>
        <ul class="stay-tuned">
            <?php while (have_rows('socials', 'options')) :
                the_row(); ?>
                <?php $social_network = get_sub_field('social_network'); ?>
                <li class="stay-tuned__item">
                    <a class="stay-tuned__link "
                       href="<?php the_sub_field('social_profile'); ?>"
                       target="_blank"
                       aria-label="<?php echo $social_network['label']; ?>"
                       rel="noopener">
                        <span aria-hidden="true" class="fab fa-<?php echo $social_network['value']; ?>"></span>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>
</div>
<!-- END of header -->
