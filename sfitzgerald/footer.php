<?php
/**
 * Footer
 */
?>

<!-- BEGIN of footer -->
<?php get_template_part('parts/map'); ?>
<?php get_template_part('parts/footer-contact'); ?>
<section class="footer-menu-section">
<?php if ( is_active_sidebar( 'footer-menu-sidebar' ) ) : ?>
	<div class="grid-container">
		<div class="footer-menu-sidebar" role="complementary">
    		<?php dynamic_sidebar( 'footer-menu-sidebar' ); ?>
    	</div>
	</div>
<?php endif; ?>
</section>
<footer class="footer">
    <?php if ($copyright = get_field('copyright', 'options')) : ?>
        <div class="footer__copy">
            <div class="grid-container">
                <div class="grid-x grid-margin-x">
                    <div class="cell ">
                        <?php echo $copyright; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</footer>
<!-- END of footer -->

<?php wp_footer(); ?>
</body>
</html>
