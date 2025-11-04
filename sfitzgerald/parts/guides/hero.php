<section class="guide-hero">
    <div class="guide-hero__container grid-container">
        <h1 class="guide-hero__title">
            <?php echo get_the_title(); ?>
        </h1>
        <?php if ($hero_subtitle = get_field('hero_subtitle')): ?>
            <h5 class="guide-hero__subtitle">
                <?php echo $hero_subtitle; ?>
            </h5>
        <?php endif; ?>
        <?php if (has_post_thumbnail()): ?>
            <div class="guide-hero__image">
                <picture>
                    <?php if ($hero_mob_img = get_field('mobile_image')): ?>
                        <source media="(max-width:640px)" srcset="<?php echo $hero_mob_img['url'] ?>">
                    <?php endif; ?>
                    <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'large'); ?>
                </picture>
            </div>
        <?php endif; ?>
    </div>
</section>
