<!-- BEGIN of Post -->
<article id="post-<?php the_ID(); ?>" <?php post_class('preview preview--' . get_post_type()); ?>>
    <div class="grid-x grid-margin-x post-item">
        <?php if (has_post_thumbnail()) : ?>
            <div class="medium-6 small-12 cell text-center medium-text-left blog-thumbnail">
                <div class="blog-thumbnail-wrap">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php the_post_thumbnail('medium', array('class' => 'preview__thumb')); ?>
                    </a>
                    <div class="blog-date">
                        <span class="blog-date-month"><?php echo get_the_time('F'); ?></span>
                        <span class="blog-date-day"><?php echo get_the_time('d'); ?></span>
                        <span class="blog-date-month"><?php echo get_the_time('Y'); ?></span>
                    </div>
                </div>
            </div>
        <?php endif; ?>

            <?php if (!has_post_thumbnail()) : ?>
        <div class="cell small-2">
                <div class="blog-date">
                    <span class="blog-date-month"><?php echo get_the_time('F'); ?></span>
                    <span class="blog-date-day"><?php echo get_the_time('d'); ?></span>
                    <span class="blog-date-month"><?php echo get_the_time('Y'); ?></span>
                </div>
        </div>
            <?php endif; ?>

        <div class="cell auto">

            <h2 class="preview__title">
                <a href="<?php the_permalink(); ?>"
                   title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'fxy'), the_title_attribute('echo=0'))); ?>"
                   rel="bookmark"><?php echo get_the_title() ?: __('No title', 'fxy'); ?>
                </a>
            </h2>
            <?php if (is_sticky()) : ?>
                <span class="secondary label preview__sticky"><?php _e('Sticky', 'fxy'); ?></span>
            <?php endif; ?>
            <?php $content = get_extended(get_post_field('post_content')); ?>
            <p class="template-faq__text "><?php echo $content['extended'] ? $content['main'] : wp_trim_words(get_the_content(), 20) ?></p>
            <a href="<?php the_permalink(); ?>" class="button"><?php _e('learn more') ?></a>
        </div>
    </div>
</article>
<!-- END of Post -->
