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


    <?php 
    // Global Schema
    $global_schema = get_field('global_schema', 'options');
    if ( !empty($global_schema) ) :
        echo '<script type="application/ld+json">' . strip_tags($global_schema) . '</script>';
    endif; ?>

    <!-- scripts installed without plugin -->
    <script type="text/javascript" src="//script.crazyegg.com/pages/scripts/0129/3257.js" async="async" ></script>
    <script>(function (w,d,s,v,odl){(w[v]=w[v]||{})['odl']=odl;;
    var f=d.getElementsByTagName(s)[0],j=d.createElement(s);j.async=true;
    j.src='https://intaker.azureedge.net/widget/chat.min.js';
    f.parentNode.insertBefore(j,f);
    })(window, document, 'script','Intaker', 'simonfitzgerald');
    </script>

    <script >(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NT2MDX3');</script>

</head>

<body <?php body_class('no-outline fxy'); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NT2MDX3" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

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

                    <?php show_custom_logo('full'); ?><span class="show-for-sr"><?php echo get_bloginfo('name'); ?></span>
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
                <div class="header-locations">
                    <?php $header_contact_title = get_field('header_contact_title', 'options') ?>
                    <?php if ($header_contact_title) : ?>
                        <p class="header-locations__title"><?php echo $header_contact_title; ?></p>
                    <?php endif; ?>
                    <?php
                    // Check rows existexists.
                    if (have_rows('header_contacts', 'options')): ?>
                        <div class="header-locations__list">

                            <?php // Loop through rows.
                            while (have_rows('header_contacts', 'options')) : the_row();

                                // Load sub field value.
                                $title = get_sub_field('title');
                                $link = get_sub_field('link'); ?>
                                <div class="header-locations__item">
                                <p class="header-locations__item-title"><?php echo $title; ?></p>
                                <?php
                                if ($link):
                                    ?>
                                    <a class="header-locations__item-link" href="tel:<?php echo sanitize_number($link); ?>"
                                       target=""><?php echo esc_html($link); ?></a>
                                    </div>

                                <?php endif; ?>

                            <?php endwhile; ?>
                        </div>
                    <?php endif;
                    ?>
                </div>
                <div class="mobile-contact-info hide-for-large">
                    <div class="mobile-contact-info__wrap">
                        <a href="#" class="mobile-contact-info__phone"></a>
                        <a href="#" class="mobile-contact-info__location"></a>
						<div class="title-bar hide-for-large" data-responsive-toggle="main-menu" data-hide-for="large">
                        	<button class="menu-icon" type="button" data-toggle aria-label="Menu" aria-controls="main-menu">
                            <span></span></button>
                    	</div>
                    </div>

                    <?php
                    // Check rows existexists.
                    if (have_rows('header_contacts', 'options')): ?>
                        <div class="mobile-contact-info__list">

                            <?php // Loop through rows.
                            while (have_rows('header_contacts', 'options')) : the_row();

                                // Load sub field value.
                                $title = get_sub_field('title');
                                $link = get_sub_field('link'); ?>
                                <a class="mobile-contact-info__item-link" href="tel:<?php echo sanitize_number($link); ?>"
                                       target=""><div class="mobile-contact-info__item">
                                <p class="mobile-contact-info__item-title"><?php echo $title; ?></p>
                                    <?php echo esc_html($link); ?>
                                </div></a>

                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
        <div class="grid-x second-header-row">
            <div class="large-9 medium-12 small-6 cell">
                <?php if (has_nav_menu('header-menu')) : ?>
                    <?php /*<div class="title-bar hide-for-large" data-responsive-toggle="main-menu" data-hide-for="large">
                        <button class="menu-icon" type="button" data-toggle aria-label="Menu" aria-controls="main-menu">
                            <span></span></button>
                    </div>*/?>

                    <nav class="top-bar" id="main-menu">
                        <div class="mobile-menu-logo hide-for-large">
                            <?php
							$image = get_field('mobile_menu_logo', 'options');
							$size = 'full'; // (thumbnail, medium, large, full or custom size)
							if( $image ) {
								echo wp_get_attachment_image( $image, $size );
							}?>
							<span class="show-for-sr"><?php echo get_bloginfo('name'); ?></span>
                        </div>
						
						<?php wp_nav_menu(array(
							'menu' => 2,
                            'menu_id' => 2,
                            'menu_class' => 'menu header-menu',
                            'items_wrap' => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion large-dropdown" data-submenu-toggle="true" data-multi-open="false" data-close-on-click-inside="false">%3$s</ul>',
                            'walker' => new theme\FoundationNavigation()
                        )); ?>

                        <?php wp_nav_menu(array(
                            'theme_location' => 'header-menu',
                        )); ?>


                        <div class="mobile-search hide-for-large">
                            <?php echo get_search_form(); ?>
                        </div>

                    </nav>
                <?php endif; ?>

            </div>
            <div class="large-3 medium-12 small-12 cell">
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

<!-- Single Page Schema -->
<?php
$single_page_schema = get_field('single_page_schema');
if ( !empty($single_page_schema) ) :
    echo '<script type="application/ld+json">' . strip_tags($single_page_schema) . '</script>';
endif; ?>

