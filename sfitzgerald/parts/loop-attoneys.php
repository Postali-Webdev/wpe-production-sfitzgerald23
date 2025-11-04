<?php  $position = get_field('position');

?>
<article  id="post-<?php the_ID(); ?>" >
    <div class="attorney-container ">
        <a href="<?php the_permalink();?>"><?php the_post_thumbnail('large', array('class' => 'preview__thumb skip-lazy'));?></a>
        <a href="<?php the_permalink();?>"><h2 class="attorney__title"><?php the_title(); ?></h2></a>
        <?php if(!empty($position)):?>
            <span class="attorney__position"><?php echo $position ; ?></span>
        <?php else: ?>
            <?php $terms = get_the_terms( $id,'practice_areas' ); ?>
            <span class="attorney__position attorney__position-title"><?php echo __('Practice Areas', 'fxy'); ?><button class="attorney__position-list-button"></button></span>
            <ul class="attorney__position-list">
                <?php foreach( $terms as $cur_term ){ ?>
                    <li><span class="attorney__position"><?php echo $cur_term->name; ?></span></li>
                <?php } ?>
            </ul>

        <?php endif; ?>
    </div>
</article>
<!-- END of Post -->
