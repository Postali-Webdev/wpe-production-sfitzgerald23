<?php
$bg = get_field('background_image');
$mobile_bg = get_field('mobile_background_image');
$map = get_field('hero_map');
$locations = get_field('locations');
$hero_home_title = get_field('hero_home_title');
$hero_home_subtitle = get_field('hero_home_subtitle');
$hero_home_text = get_field('hero_home_text');
$hero_home_button = get_field('hero_home_button');
$hero_home_button_text = get_field('hero_home_button_text');
$hero_home_form = get_field('hero_home_form');
$mobile_form_button = get_field('mobile_form_button');
$mobile_locations_button = get_field('mobile_locations_button');
$mobile_locations_button_url = $mobile_locations_button['url'];
$mobile_locations_button_title = $mobile_locations_button['title'];
$mobile_locations_button_target = $mobile_locations_button['target'] ?: '_self';?>
<section class="hero-home" <?php bg($bg); ?>>
    <div class="hero-home__overlay">
        <div class="grid-container">
            <div class="grid-x grid-margin-x">
                <div class="medium-6 small-12 cell">
                    <div class="hero-map">
						<div class="map-overlay">
						</div>
                        <?php //echo wp_get_attachment_image($map['ID'], 'large'); ?>
                        <?php display_svg($map); ?>
                        <?php foreach ($locations as $num => $marker) : ?>
                            <?php if ($marker) : ?>
                                <?php $coordinates = explode(',', $marker['location']); ?>
                                <div class="map-pointer current-pointer-<?php echo $num; ?>" data-popover="map-popover--<?php echo $num; ?>"
                                     style="left: <?php echo $coordinates[0]; ?>; top: <?php echo $coordinates[1]; ?>; ">
                                    <a href="<?php echo $marker['location_link']; ?>" class="pin-container">
                                        <div class="pin">

                                        </div>
                                    </a>
                                </div>
                                <div class="map-popup-content">
                                    <div class="map-popover hide-element map-popover--<?php echo $num; ?>">
                                        <?php if ($marker['location_title'] || $marker['info']) : ?>
                                            <h4><?php echo $marker['location_title']; ?></h4>
                                            <?php echo $marker['info']; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                </div>
                <div class="medium-6 small-12 cell text-center">
                    <div class="hero-home__content">
                        <h3 class="hero-home__sub-title"><?php echo $hero_home_subtitle; ?></h3>
                        <h1 class="hero-home__title"><?php echo $hero_home_title; ?></h1>
                        <?php echo $hero_home_text; ?>
                        <?php
                        if ($mobile_locations_button): ?>
                            <a class="hero-home__locations-button hide-for-large hide-for-medium" href="<?php echo esc_url( $mobile_locations_button_url ); ?>" target="<?php echo esc_attr( $mobile_locations_button_target ); ?>"><?php echo esc_html( $mobile_locations_button_title ); ?></a>
                        <?php endif; ?>
                        <?php
                        if ($hero_home_button): ?>
                            <a class="button buttton-border"
                               href="<?php echo esc_url($hero_home_button); ?>"><?php echo $hero_home_button_text; ?></a>
                        <?php endif; ?>
                        <?php
                        if ($mobile_form_button): ?>
                            <a class="button button-green buttton-border hero-home__form-button hide-for-large"
                               href="<?php echo esc_url($mobile_form_button['url']); ?>"><?php echo $mobile_form_button['title']; ?></a>
                        <?php endif; ?>
                    </div>
                    <div class="hero-home__form">
                        <?php if (class_exists('GFAPI') && !empty($hero_home_form) && is_array($hero_home_form)) : ?>
                            <?php echo do_shortcode("[gravityform id='{$hero_home_form['id']}' title='true' description='false' ajax='true']"); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
