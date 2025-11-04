<?php
$footer_title = get_field('footer_title', 'options');
$footer_subtitle = get_field('footer_subtitle', 'options');
?>
<section class="footer-contact">
    <div class="grid-container fluid">
        <div class="grid-x footer-contact__wrap">
            <div class="cell small-12 medium-6 text-center">
                <div class="footer-contact__socials">
                    <h2 class="footer-contact__title"><?php echo $footer_title; ?></h2>
                    <p><?php echo $footer_subtitle; ?></p>
                    <?php get_template_part('parts/socials'); // Social profiles?>
                </div>
            </div>
            <div class="cell medium-6">
                <?php $contact_form = get_field('footer_form', 'options'); ?>
                <?php if (class_exists('GFAPI') && !empty($contact_form) && is_array($contact_form)) : ?>

                        <div id="footer-form" class="footer-contact__form">
                            <?php echo do_shortcode("[gravityform id='{$contact_form['id']}' title='true' description='false' ajax='true']"); ?>
                        </div>

                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
