<?php
$guide_text = get_field('guide_text');
$guide_button = get_field('guide_button');
$our_newsletter = get_field('our_newsletter');
$got_questions = get_field('got_questions');
if ($guide_text) :?>
    <section class="guides-section">
        <div class="grid-container">
            <div class="grid-x">
                <div class="cell medium-12">
                    <div class="guides-section__forms">

                        <?php if (class_exists('GFAPI') && !empty($got_questions) && is_array($got_questions)) : ?>
                            <div class="guides-section__forms-questions">
                                <?php echo do_shortcode("[gravityform id='{$got_questions['id']}' title='true' description='true' ajax='true']"); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="cell medium-12 guides-section__content-wrap">
                    <div class="guides-section__content">
                        <picture>
                            <?php if ($guide_mobile_image = get_field('guide_mobile_image')): ?>
                                <source media="(max-width:640px)" srcset="<?php echo $guide_mobile_image; ?>">
                            <?php endif; ?>
                            <?php if ($guide_image = get_field('guide_image')): ?>
                                <?php echo wp_get_attachment_image($guide_image['ID'], 'large', false, ['class' => 'practice-areas__img']); ?>
                            <?php endif; ?>
                        </picture>
                        <div class="guide-text">
                            <?php if ($guide_text): ?>
                                <?php echo $guide_text; ?>
                            <?php endif; ?>
                            <?php
                            if ($guide_button):?>
                                <a class="button" href="<?php echo esc_url($guide_button['url']); ?>"
                                   target="<?php echo esc_attr($guide_button['target'] ?: '_self'); ?>"><?php echo esc_html($guide_button['title']); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if (class_exists('GFAPI') && !empty($our_newsletter) && is_array($our_newsletter)) : ?>
                        <div class="guides-section__forms-newsletter">
                            <?php echo do_shortcode("[gravityform id='{$our_newsletter['id']}' title='true' description='true' ajax='true']"); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
