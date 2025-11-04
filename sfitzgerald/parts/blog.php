<?php
$blog_background_image = get_field('blog_background_image');
$blog_title = get_field('blog_title');
$blog_posts = get_field('blog_posts');
if ($blog_posts) : ?>
    <section class="home-blog" <?php bg($blog_background_image); ?>>
        <div class="home-blog__overlay">
            <div class="grid-container fluid">
                <div class="grid-x text-center">
                    <div class="cell ">
                        <?php if ($blog_title) :
                            echo '<h2 class="home-blog__title">' . $blog_title . '</h2>';
                        endif; ?>
                    </div>
                </div>
                <div class="grid-x home-blog__list home-blog__slider">
                    <div class="category-dropdown">
                        <?php $categories = get_terms(array(
                            'hide_empty' => false,
                        ));

                        $select = "<select name='cat' id='cat' class='postform category-form'>";
                        $text = 'Select category';
                        $select .= '<option value="" disabled selected>' . $text . '</option>';
                        foreach ($categories as $category) {
                            $select .= "<option value='" . $category->slug . "'>" . $category->name . "</option>";
                        }
                        $select .= "</select>";
                        echo $select;
                        ?>
                    </div>
                    <?php foreach ($blog_posts as $featured_post):
                        $permalink = get_permalink($featured_post->ID);
                        $title = get_the_title($featured_post->ID);
                        $content = get_the_content($featured_post->ID);
                        setup_postdata($featured_post); ?>
                        <div class="home-blog__item">
                            <div class="home-blog__date">
                                <span
                                    class="home-blog__month"><?php echo get_the_date('M', $featured_post->ID); ?></span>
                                <span class="home-blog__day"><?php echo get_the_date('d', $featured_post->ID); ?></span>
                            </div>
                            <div class="home-blog__content">
                                <a class="home-blog__item-title"
                                   href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($title); ?></a>
                                <?php $content = get_extended(get_post_field('post_content', $featured_post->ID)); ?>
                                <p class="home-blog__text "><?php echo $content['extended'] ? $content['main'] : wp_trim_words(get_the_content(), 20) ?></p>
                                <a class="button home-blog__button"
                                   href="<?php echo esc_url($permalink); ?>"><?php echo esc_html('read more'); ?></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    // Reset the global post object so that the rest of the page works correctly.
    wp_reset_postdata(); ?>
<?php endif; ?>
