<?php
$t_image = get_field('t_image');
$t_text = get_field('t_text');
$t_m_mobile_image = get_field('t_m_mobile_image');
if ($t_image || $t_text) : ?>

    <section class="text-image">
        <div class="grid-container">
            <div class="grid-x grid-margin-x">
                <?php if ($t_image): ?>
                    <div class="cell medium-6 large-4">
                        <div class="text-image__img-wrap">
                            <picture>
                                <source media="(max-width:640px)" srcset="<?php echo $t_m_mobile_image; ?>">
                                <?php echo wp_get_attachment_image($t_image['ID'], 'large', false, ['class' => 'text-image__img']); ?>
                            </picture>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($t_text): ?>
                    <div class="cell medium-6 large-8">
                        <?php echo $t_text; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
