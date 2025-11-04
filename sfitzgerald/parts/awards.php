<?php
$awards = get_field('awards');

if ($awards) :?>

    <section class="awards">
        <div class="grid-container fluid">
            <div class="grid-x awards__list awards__slider">
                <?php
                if (have_rows('awards')):
                    while (have_rows('awards')) : the_row(); ?>
                        <?php if ($award = get_sub_field('award')):
                            $award_link = get_sub_field('award_link'); ?>
                            <div class="awards__item">
                                <a href="<?php echo $award_link; ?>">
                                    <?php echo wp_get_attachment_image($award['ID'], 'large'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endwhile;

                endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
