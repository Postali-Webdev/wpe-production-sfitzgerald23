<section class="guide-list">
    <div class="guide-list__container grid-container">
        <?php if ($section_title = get_field('list_title')): ?>
            <h2 class="guide-list__title">
                <?php echo $section_title; ?>
            </h2>
        <?php endif; ?>
        <?php if (have_rows('list')): ?>
            <ul class="guide-list__list">
                <?php while (have_rows('list')) : the_row(); ?>
                    <?php if ($list_item_text = get_sub_field('list_item_text')): ?>
                        <li class="guide-list__item">
                            <?php if ($item_icon = get_sub_field('list_item_icon')): ?>
                                <div class="guide-list__item-icon">
                                    <?php echo wp_get_attachment_image($item_icon['id'], 'large'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="guide-list__item-text">
                                <?php echo $list_item_text; ?>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    </div>
</section>
