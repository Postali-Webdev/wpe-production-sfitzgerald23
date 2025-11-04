<?php

/**
 * Example shortcode
 * [example_shortcode foo=bar]
 *
 * @param $atts array Shortcode attributes
 *
 * @return string
 */
add_shortcode('example_shortcode', function ($atts) {
    // Set white list of attributes and specify its default values
    $atts = shortcode_atts(
        ['foo' => 'no foo'],
        $atts,
        'example_shortcode'
    );

    $html = 'foo:' . $atts['foo'];

    return $html;
});
function cta_shortcode($atts)
{
    $a = shortcode_atts(array(
        'id' => ''
    ), $atts);
    $shortcode_with_background_color = get_field('shortcode_with_background_color', 'options');
    ob_start(); ?>
    <?php if ($shortcode_with_background_color) : ?>


    <section class="shortcode-bg">
        <div class="shortcode-bg__list">
            <?php foreach ($shortcode_with_background_color as $row) :
                $icon = $row['icon'];
                $link = $row['link'];
                ?>
                <div class="shortcode-bg__item">
                    <div class="shortcode-bg__icon">
                        <a href="<?php echo $link['url']; ?>">
                            <?php display_svg($icon); ?>
                        </a>

                    </div>
                    <?php
                    if ($link):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <h3 class="shortcode-bg__link"><a href="<?php echo esc_url($link_url); ?>"
                                                          target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                        </h3>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>

        </div>

    </section>


<?php endif; ?>
    <?php return ob_get_clean();
}

add_shortcode('usp', 'cta_shortcode');

function cta_second_shortcode($atts)
{
    $a = shortcode_atts(array(
        'id' => ''
    ), $atts);
    $transparent_shortcode = get_field('transparent_shortcode', 'options');
    ob_start(); ?>
    <?php if ($transparent_shortcode) : ?>


    <section class="shortcode-no-bg">
        <div class="shortcode-no-bg__list">
            <?php $counter = 1; ?>
            <?php foreach ($transparent_shortcode as $row) :
                $icon = $row['icon'];
                $link = $row['link'];
                ?>
                <div class="shortcode-no-bg__item item-count-<?php echo $counter; ?>">
                    <div class="shortcode-no-bg__icon">
                        <a href="<?php echo $link['url']; ?>">
                            <?php display_svg($icon); ?>
                        </a>
                    </div>
                    <?php
                    if ($link):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <h3 class="shortcode-no-bg__link"><a href="<?php echo esc_url($link_url); ?>"
                                                             target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                        </h3>
                    <?php endif; ?>

                </div>
                <?php $counter++; ?>
            <?php endforeach; ?>

        </div>

    </section>


<?php endif; ?>
    <?php return ob_get_clean();
}


add_shortcode('usp-2', 'cta_second_shortcode');

function banner_shortcode($atts)
{
    $a = shortcode_atts(array(
        'id' => ''
    ), $atts);
    $banner_shortcode = get_field('banner_shortcode', 'options');
    ob_start(); ?>
    <?php if ($banner_shortcode) : ?>


    <section class="banner-shortcode">
        <span class="banner-shortcode__title"><?php echo $banner_shortcode; ?></span>
    </section>


<?php endif; ?>
    <?php return ob_get_clean();
}

add_shortcode('banner', 'banner_shortcode');


add_shortcode('gngf-logo', 'gngf_logo_function');
function gngf_logo_function()
{
    return '<a href="http://gngf.com" target="_blank" rel="noopener"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19px" x="0px" y="0px" viewBox="0 0 19 19" enable-background="new 0 0 19 19" xml:space="preserve"><g><polygon fill="#FFFFFF" points="7.7,4.3 0,4.3 0,19 14.8,19 14.8,11.3 7.7,11.3"/><polygon fill="#FFFFFF" points="19,0 7.7,0 7.7,4.3 14.8,4.3 14.8,11.3 19,11.3"/></g></svg></a>';
}


add_shortcode('calculator_cta', 'calculator_cta_output');
function calculator_cta_output()
{
    ob_start();
    ?>
    <section class="calc-cta">
        <div class="calc-cta__container">
            <div class="calc-cta__row">
                <?php if ($calc_cta_image = get_field('calc_cta_image', 'options')) : ?>
                    <div class="calc-cta__image">
                        <?php echo wp_get_attachment_image($calc_cta_image['id'], 'large'); ?>
                    </div>
                <?php endif; ?>
                <div class="calc-cta__content">
                    <?php if ($calc_cta_title = get_field('calc_cta_title', 'options')) : ?>
                        <h3 class="calc-cta__title">
                            <?php echo esc_html($calc_cta_title); ?>
                        </h3>
                    <?php endif; ?>
                    <?php if ($calc_cta_button = get_field('calc_cta_button', 'options')) : ?>
                        <a href="<?php echo esc_url($calc_cta_button['url']) ?>"
                           target="<?php echo esc_attr($calc_cta_button['target']) ?: '_self'; ?>"
                           class="calc-cta__button button">
                            <?php echo esc_html($calc_cta_button['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

add_shortcode('consultation_cta', 'consultation_cta_output');
function consultation_cta_output()
{
    ob_start();
    ?>
    <section class="consult-cta">
        <div class="consult-cta__container">
            <div class="consult-cta__row">
                <?php if ($consult_cta_image = get_field('consult_cta_image', 'options')) : ?>
                    <div class="consult-cta__image">
                        <?php echo wp_get_attachment_image($consult_cta_image['id'], 'large'); ?>
                    </div>
                <?php endif; ?>
                <div class="consult-cta__content">
                    <?php if ($consult_cta_title = get_field('consult_cta_title', 'options')) : ?>
                        <h3 class="consult-cta__title">
                            <?php echo esc_html($consult_cta_title); ?>
                        </h3>
                    <?php endif; ?>
                    <?php if ($consult_cta_button = get_field('consult_cta_button', 'options')) : ?>
                        <a href="<?php echo esc_url($consult_cta_button['url']) ?>"
                           target="<?php echo esc_attr($consult_cta_button['target']) ?: '_self'; ?>"
                           class="consult-cta__button button">
                            <?php echo esc_html($consult_cta_button['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
