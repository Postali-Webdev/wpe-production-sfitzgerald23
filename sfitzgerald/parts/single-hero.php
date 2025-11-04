<?php
$thumbnail = get_the_post_thumbnail_url();
$position = get_field('position');
$attorney_phone = get_field('attorney_phone');
$attorney_email = get_field('attorney_email');
$attorney_qr_code = get_field('attorney_qr_code');
$attorney_contact_button = get_field('attorney_contact_button');
$staff_attorneys = get_field('staff_attorneys');
$staff_location = get_field('staff_location');
?>
<section class="single-hero">
    <div class="grid-container fluid">
        <div class="grid-x">
            <div class="cell small-12 medium-6 single-hero__content-wrap">

                <div class="single-hero__heading">
                    <h1 class="single-hero__title "><?php the_title(); ?></h1>
                    <?php if ($position) : ?>
                        <h3 class="single-hero__position"><?php echo $position; ?></h3>
                        <hr>
                    <?php endif; ?>
                </div>

                <?php if ($staff_attorneys) : ?>
                    <div class="single-hero__staff-attorneys">
                        <h3>Attorneys They Work For:</h3>
                        <?php foreach ($staff_attorneys as $staff_attorney):
                            $permalink = get_permalink($staff_attorney->ID);
                            $title = get_the_title($staff_attorney->ID); ?>
                            <a href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($title); ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="single-hero__contact">
                    <?php if ($attorney_phone) : ?>
                        <a class="single-hero__phone"
                           href="tel:<?php echo sanitize_number($attorney_phone); ?>"><?php echo $attorney_phone; ?></a>
                    <?php endif; ?>
                    <?php if ($attorney_email) : ?>
                        <a class="single-hero__email"
                           href="mailto:<?php echo $attorney_email; ?>"><?php echo $attorney_email; ?></a>
                    <?php endif; ?>
                </div>

                <?php if ($staff_location) : ?>
                    <div class="single-hero__location">
                        <span class="staff-location"><?php echo $staff_location; ?></span>
                    </div>
                <?php endif; ?>

                <?php
                if ($attorney_contact_button): ?>
                    <div class="single-hero__contact-button">
                        <?php $link_url = $attorney_contact_button['url'];
                        $link_title = $attorney_contact_button['title'];
                        $link_target = $attorney_contact_button['target'] ?: '_self';
                        ?>
                        <a class="button button-green" href="<?php echo esc_url($link_url); ?>"
                           target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                    </div>
                <?php endif; ?>
                <?php if (have_rows('attorney_badges')): ?>
                    <div class="single-hero__badges">
                        <?php while (have_rows('attorney_badges')): the_row();
                            $link = get_sub_field('link');
                            $badge = get_sub_field('badge'); ?>
                            <div class="single-hero__badges-item">
                                <?php if ($badge): ?>
                                    <?php echo wp_get_attachment_image($badge['id'], 'large'); ?>
                                <?php endif; ?>
                                <?php if ($link): ?>
                                    <a href="<?php echo esc_url($link['url']); ?>"
                                       target="<?php echo esc_attr($link['target']) ?: '_self'; ?>"
                                       class="single-hero__link">
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>

                    </div>
                <?php endif; ?>
            </div>
            <div class="cell small-12 medium-6">
                <div class="single-hero__thumbnail">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('full', ['class' => 'single-hero__thumbnail-image']); ?>
                    <?php endif; ?>
                    <?php echo wp_get_attachment_image($attorney_qr_code['ID'], 'thumbnail', '', ['class' => 'qr-code']); ?>
                </div>
            </div>
        </div>
    </div>
</section>
