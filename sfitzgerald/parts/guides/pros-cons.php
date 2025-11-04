<section class="pros-cons">
    <div class="pros-cons__container grid-container">
        <?php if ($section_title = get_field('pros_cons_title')): ?>
            <h2 class="pros-cons__title">
                <?php echo $section_title; ?>
            </h2>
        <?php endif; ?>
        <div class="pros-cons__row">
            <?php if (have_rows('pros')): ?>
                <div class="pros-cons__col col-pros">
                    <?php if ($pros_heading = get_field('pros_heading')): ?>
                        <h3 class="col-pros__heading">
                            <?php echo $pros_heading; ?>
                        </h3>
                    <?php endif; ?>
                    <div class="col-pros__items">
                        <?php while (have_rows('pros')): the_row(); ?>
                            <div class="col-pros__item">
                                <?php if ($title = get_sub_field('title')): ?>
                                    <div class="col-pros__title">
                                        <?php echo $title; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($description = get_sub_field('description')): ?>
                                    <div class="col-pros__description">
                                        <?php echo $description; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (have_rows('cons')): ?>
                <div class="pros-cons__col col-cons">
                    <?php if ($pros_heading = get_field('pros_heading')): ?>
                        <h3 class="col-cons__heading">
                            <?php echo $pros_heading; ?>
                        </h3>
                    <?php endif; ?>
                    <div class="col-cons__items">
                        <?php while (have_rows('cons')): the_row(); ?>
                            <div class="col-cons__item">
                                <?php if ($title = get_sub_field('title')): ?>
                                    <div class="col-cons__title">
                                        <?php echo $title; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($description = get_sub_field('description')): ?>
                                    <div class="col-cons__description">
                                        <?php echo $description; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
