<?php
/**
 * Sidebar
 *
 * Content for our sidebar, provides prompt for logged in users to create widgets
 */

//dynamic_sidebar('Sidebar Right'); ?>
<div class="custom-sidebar">
    <?php if(is_page('46141')) { ?>
    <style>
    .page .sidebar { margin-top: 0 !important; }
    #gform_wrapper_4  { background-color: #EDEDED !important; border: 2px solid #174585; }
    #gform_wrapper_4 .gform_heading .gform_title { font-size: 28px; }
    #gform_wrapper_4 .gfield_label { display: inline-block !important; font-weight: bold !important; font-size: 18px; letter-spacing: 1px; }
    #gform_wrapper_4 fieldset { margin-top: 15px !important; }
    #gform_wrapper_4 fieldset::before { content: ""; position: absolute; bottom: -25px; width: 100%; left: 0; border-bottom: 1px solid black; }
    </style>
    <?php } ?>

    <?php if(!is_page('46141')) { ?>
    <?php $sidebar_form = get_field('sidebar_form', 'options'); ?>
    <?php if (class_exists('GFAPI') && !empty($sidebar_form) && is_array($sidebar_form)) : ?>
        <div class="custom-sidebar__form">
            <?php echo do_shortcode("[gravityform id='{$sidebar_form['id']}' title='true' description='false' ajax='true']"); ?>
        </div>
    <?php endif; ?>
    <?php } ?>
    <div class="custom-sidebar__content">
        <?php

        // Check rows existexists.
        if (have_rows('sidebar_content', 'options')):

            $n = 1;
            // Loop through rows.
            while (have_rows('sidebar_content', 'options')) : the_row();

                // Load sub field value.
                $title = get_sub_field('title');
                $content = get_sub_field('content');
                $button = get_sub_field('button');
                $download_button = get_sub_field('download_button');
                ?>
                <?php if ($title) : ?>
                    <h3 class="custom-sidebar__content-title sidebar-mobile block_<?php echo $n; ?>"><?php echo $title; ?></h3>
                <?php endif; ?>
                <?php if ($content) : ?>
                    <div class="sidebar-mobile block_<?php echo $n; ?>">
                        <?php echo $content; ?>
                    </div>
                <?php endif; ?>
                <?php
                if ($button):
                    $link_url = $button['url'];
                    $link_title = $button['title'];
                    $link_target = $button['target'] ?: '_self';
                    ?>
                    <a class="button custom-sidebar__button block_<?php echo $n; ?>" <?php echo $download_button ? 'download' : false ?>
                       href="<?php echo esc_url($link_url); ?>"
                       target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                <?php endif; ?>
                <?php $n++; ?>
            <?php endwhile;
        endif;
        ?>
    </div>

	<?php if ( get_field('select_menu') ) { ?>
        <div class="custom-sidebar__content sidebar-link-wrap">
			<h3 class="custom-sidebar__content-title">Helpful Information</h3>
            <?php echo get_field('select_menu'); ?>
        </div>
    <?php } ?>

    <span class="more-arrow "><i class="fa-regular fa-angle-down"></i></span>
</div>
