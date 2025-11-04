<?php $position = get_field('position');

?>
<article id="post-<?php the_ID(); ?>">
    <div class="attorney-item text-center">
        <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink(); ?>" title="View Full Profile"><?php the_post_thumbnail('large', array('class' => 'attorney-item__image preview__thumb skip-lazy')); ?></a>
        <?php else : ?>
            <a href="<?php the_permalink(); ?>"
               class="attorney-item__placeholder  attorney-item__image preview__thumb skip-lazy"></a>
        <?php endif; ?>
        <a href="<?php the_permalink(); ?>" title="View Full Profile"><h4 class="attorney-item__title"><?php the_title(); ?></h4></a>
        <?php if (!empty($position)): ?>
			<h3 class="attorney-item__position"><a href="<?php the_permalink(); ?>" title="View Full Profile"><?php echo $position; ?></a></h3>
        <?php endif; ?>
		<div class="attorney-item__button">
			<a href="https://calendly.com/d/2nn-3ny-hfz" class="button" target="_blank">Schedule a Consultation</a>
		</div>
    </div>
</article>
<!-- END of Post -->
