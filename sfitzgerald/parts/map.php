<?php
if (!is_page_template('templates/template-landing.php')) {
    if (have_rows('footer_locations', 'options')):
    $locations_title = get_field('locations_title', 'options');
    ?>

    <section class="map" id="locations">
        <div class="grid-container">
            <div class="grid-x text-center">
                <div class="cell ">
                    <?php if ($locations_title) :
                        echo '<h2 class="map__title">' . $locations_title . '</h2>';
                    endif; ?>
                </div>
            </div>
            <div class="grid-x grid-margin-x map-slider">

                    <?php
                    while (have_rows('footer_locations', 'options')) : the_row();

                        $title = get_sub_field('title');
                        $address = get_sub_field('address');
                        $map = get_sub_field('map'); ?>
                        <div class="cell medium-12 map__item text-center">
                            <?php echo $map; ?>
                            <h3 class="map__item-title"><?php echo $title; ?></h3>
                            <?php echo $address; ?>
                        </div>
                    <?php endwhile;
                    ?>
            </div>
        </div>
    </section>
<?php endif;
}
?>


