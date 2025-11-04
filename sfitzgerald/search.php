<?php
/**
 * Index
 *
 * Standard loop for the search result page
 */
get_header(); ?>
<main class="main-content">
<?php
$search_thumbnail = get_field('search_results_hero_background', 'options');

if ($search_thumbnail) :?>

    <section class="page-hero" <?php bg($search_thumbnail); ?>>
        <div class="page-hero__overlay">
            <div class="grid-container">
                <div class="grid-x grid-margin-x">
                    <div class="cell medium-10">
                        <h1 class="page-title entry__title"><?php printf(__('Search Results for: %s', 'fxy'), '<span>' . esc_html(get_search_query()) . '</span>'); ?></h1>
                    </div>
                </div>
            </div>
        </div>

    </section>

<?php else: ?>
    <section class="page-hero-no-bg">
        <div class="grid-container">
            <div class="grid-x grid-margin-x">
                <div class="cell"><h1 class="page-title page-title-no-bg entry__title"><?php printf(__('Search Results For: %s', 'fxy'), '<span>' . esc_html(get_search_query()) . '</span>'); ?></h1></div>
            </div>
        </div>

    </section>

<?php endif; ?>
<div class="grid-container">
    <div class="grid-x ">
        <div class="cell medium-8">
            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
            }
            ?>
        </div>
    </div>
    <div class="grid-x grid-margin-x posts-list">
        <div class="cell small-12 medium-8">
            <!-- BEGIN of search results -->
            <div class="search-content">
                <?php get_search_form(); ?>
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) :
                        the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('preview preview--' . get_post_type()); ?>>
                            <div class="grid-x grid-margin-x post-item">
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
                    <?php endwhile; ?>
                <?php else : ?>
                    <p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'fxy'); ?></p>
                <?php endif; ?>
                <!-- BEGIN of pagination -->
                <?php foundation_pagination(); ?>
                <!-- END of pagination -->
            </div>
        </div>
        <div class="large-4 medium-4 small-12 cell sidebar">
            <?php get_sidebar('right'); ?>
        </div>
        <!-- END of search results -->
    </div>
</div>

<?php get_footer(); ?>
</main>
