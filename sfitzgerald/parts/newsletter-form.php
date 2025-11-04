<?php if ($our_newsletter = get_field('our_newsletter')) : ?>
    <section class="newsletter-form">
        <div class="newsletter-form__container grid-container">
            <div class="newsletter-form__form">
                <?php echo do_shortcode("[gravityform id='{$our_newsletter['id']}' title='true' description='true' ajax='true']"); ?>
            </div>
        </div>
    </section>
<?php endif; ?>
