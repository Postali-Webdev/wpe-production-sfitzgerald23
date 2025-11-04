<section class="graphic">
    <div class="graphic__container grid-container">
        <?php if ($section_title = get_field('graphic_title')): ?>
            <h2 class="graphic__title">
                <?php echo $section_title; ?>
            </h2>
        <?php endif; ?>
        <?php if ($section_subtitle = get_field('graphic_subtitle')): ?>
            <h5 class="graphic__subtitle">
                <?php echo $section_subtitle; ?>
            </h5>
        <?php endif; ?>
        <?php if ($graphic_image = get_field('graphic_image')): ?>
            <div class="graphic__image">
                <?php echo wp_get_attachment_image($graphic_image['id'], 'large'); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
