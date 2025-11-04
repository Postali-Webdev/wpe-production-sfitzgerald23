<section class="resources">
    <div class="resources__container grid-container">
        <?php if ($section_title = get_field('resources_title')): ?>
            <h2 class="resources__title">
                <?php echo $section_title; ?>
            </h2>
        <?php endif; ?>
        <?php if ($section_subtitle = get_field('resources_subtitle')): ?>
            <h5 class="resources__subtitle">
                <?php echo $section_subtitle; ?>
            </h5>
        <?php endif; ?>
        <?php if (have_rows('resources_buttons')): ?>
            <div class="resources__buttons">
                <?php while (have_rows('resources_buttons')): the_row(); ?>
                    <?php if ($link = get_sub_field('link')): ?>
                        <a href="<?php echo $link['url']; ?>"
                           target="<?php echo $link['target'] ?: '_self'; ?>"
                           class="resources__btn">
                            <?php echo $link['title']; ?>
                        </a>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
