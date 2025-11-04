<?php
/**
 * Functions
 */

// Declaring the assets manifest
$manifest_json = get_theme_file_path() . '/dist/assets.json';
$assets = [
    'manifest' => file_exists($manifest_json) ? json_decode(file_get_contents($manifest_json), true) : [],
    'dist' => get_theme_file_uri() . '/dist',
    'dist_path' => get_theme_file_path() . '/dist',
];
unset($manifest_json);

/**
 * Retrieve the path to the asset, use hashed version if exists
 *
 * @param $asset
 * @param boolean $path Defines if returned result is a path or a url
 *
 * @return string
 */
function asset_path($asset, $path = false)
{
    global $assets;
    $asset = isset($assets['manifest'][$asset]) ? $assets['manifest'][$asset] : $asset;
    return "{$assets[$path ? 'dist_path' : 'dist']}/{$asset}";
}

/******************************************************************************
 * Constants
 *****************************************************************************/
define('IMAGE_PLACEHOLDER', asset_path('images/placeholder.jpg'));

/******************************************************************************
 * Included Functions
 *****************************************************************************/
if (file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    require_once $composer;
}

array_map(function ($file) {
    $file = "/inc/{$file}.php";
    if (!locate_template($file, true, true)) {
        echo sprintf(__('Error locating <code>%s</code> for inclusion.', 'fxy'), $file);
    }
}, [
    'helpers',
    'recommended-plugins',
    'class-foundation-navigation',
    'class-dynamic-admin',
    'class-lazyload',
    'theme-customizations',
    'home-slider',
    'svg-support',
    'gravity-form-customizations',
    'custom-fields-search',
    'google-maps',
    'tiny-mce-customizations',
    'posttypes',
    'rest',
//    'gutenberg-support', // !!!IMPORTANT  Comment line 159 for enable Gutenberg
//    'woo-customizations',
//    'divi-support',
//    'elementor-support',
    'shortcodes',
]);

// Register ACF Gravity Forms field
add_action('init', function () {
    if (class_exists('ACF')) {
        require_once 'inc/class-fxy-acf-field-gf-field-v5.php';
    }
});

// Prevent Fatal error on site if ACF not installed/activated
add_action('wp', function () {
    include_once 'inc/acf-placeholder.php';
}, PHP_INT_MAX);

/******************************************************************************
 * Enqueue Scripts and Styles for Front-End
 *****************************************************************************/
add_action('init', function () {
    wp_register_script('runtime.js', asset_path('scripts/runtime.js'), [], null, true);
    wp_register_script('vendor.js', asset_path('scripts/vendor.js'), [], null, true);
    if (file_exists(asset_path('styles/vendor.css', true))) {
        wp_register_style('vendor.css', asset_path('styles/vendor.css'), [], null);
    }
});

add_action('wp_enqueue_scripts', function () {
    if (!is_admin()) {
        // Disable gutenberg built-in styles
        // wp_dequeue_style('wp-block-library');

        wp_enqueue_script('jquery');

        wp_enqueue_style('vendor.css');
        wp_enqueue_style('main.css', asset_path('styles/main.css'), [], null);
        wp_enqueue_style('custom-styling', get_stylesheet_directory_uri() . '/style.css', null, null);
        wp_enqueue_script('custom-scripts', get_stylesheet_directory_uri() . '/assets/scripts/custom-scripts.js', ['jquery'], false, true);

        // temporary solution for postali fixes
        wp_enqueue_style('postali.css', get_stylesheet_directory_uri() . '/assets/styles/postali.css', [], null);

        wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap', false);
        wp_enqueue_script(
            'main.js',
            asset_path('scripts/main.js'),
            ['jquery', 'runtime.js', 'vendor.js'],
            null,
            true
        );

        wp_localize_script(
            'main.js',
            'ajax_object',
            [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('project_nonce'),
            ]
        );
    }

    if (is_page_template('templates/template-ebook.php')) {
        wp_enqueue_script('custom-script-file-download', get_stylesheet_directory_uri() . '/assets/scripts/custom-script-file-download.js', ['jquery'], false, true);
    }
});


/******************************************************************************
 * Additional Functions
 *****************************************************************************/

// Dynamic Admin
if (class_exists('theme\DynamicAdmin') && is_admin()) {
    $dynamic_admin = new theme\DynamicAdmin();
//    $dynamic_admin->addField('page', 'template', __('Page Template', 'fxy'), 'template_detail_field_for_page');
    $dynamic_admin->run();
}

// Apply lazyload to whole page content
if (class_exists('theme\CreateLazyImg')) {
    add_action(
        'template_redirect',
        function () {
            ob_start(function ($html) {
                $lazy = new theme\CreateLazyImg;
                $buffer = $lazy->ignoreScripts($html);
                $buffer = $lazy->ignoreNoscripts($buffer);

                $html = $lazy->lazyloadImages($html, $buffer);
                $html = $lazy->lazyloadPictures($html, $buffer);
                $html = $lazy->lazyloadBackgroundImages($html, $buffer);

                return $html;
            });
        }
    );
}

/*********************** PUT YOU FUNCTIONS BELOW *****************************/

// Custom media library's image sizes
add_image_size('full_hd', 1920, 0, ['center', 'center']);
add_image_size('large_high', 1024, 0, false);
// add_image_size( 'name', width, height, ['center','center']);

// Disable gutenberg
// add_filter('use_block_editor_for_post_type', '__return_false');

/*****************************************************************************/


// Search in Menu

add_filter('wp_nav_menu_items', 'add_search_form', 10, 2);

// Display search icon in menus and toggle search form
function add_search_form($items, $args)
{
    if ($args->theme_location == 'header-menu')
        $items .= '<li class="search-item menu-item"><a class="header-search"><span class="header-search-icon"></span></a></li>';
    return $items;
}

//Custom Search
add_filter('get_search_form', 'my_search_form');
function my_search_form($form)
{

    $form = '
	<form class="search" role="search" method="get" id="searchform" action="' . home_url('/') . '" >
		<label class="screen-reader-text" for="s">Search:</label>
		<input placeholder="Search..." type="text" value="' . get_search_query() . '" name="s" id="s" />
		<button class="close-button" aria-label="Close alert" type="button" data-close>
    <span aria-hidden="true">X</span>
  </button>
	</form>';

    return $form;
}

/* Admin CSS styles */
function adminStylesCss()
{
    ?>
    <style>
        .image_mapping-image {
            background-color: #8a8a8a;
        }
    </style>
    <?php
}

add_action('admin_head', 'adminStylesCss');


//Breadcrumbs
add_filter('wpseo_breadcrumb_links', 'wpseo_breadcrumb_remove_limited');

function wpseo_breadcrumb_remove_limited($links)
{
    if (is_singular('testimonial')) {
        $breadcrumb[] = array(
            'url' => site_url('/testimonials/'),
            'text' => 'Testimonials',
        );
        array_splice($links, 1, -1, $breadcrumb);
    }
    if (is_singular('attorneys')) {
        $breadcrumb[] = array(
            'url' => site_url('/attorneys/'),
            'text' => 'Attorneys',
        );
        array_splice($links, 1, -1, $breadcrumb);
    }
    if (is_singular('faq')) {
        $breadcrumb[] = array(
            'url' => site_url('/faqs/'),
            'text' => 'FAQs',
        );
        array_splice($links, 1, -1, $breadcrumb);
    }
    if (is_singular('guides')) {
        $breadcrumb[] = array(
            'url' => site_url('/guides/'),
            'text' => 'Guides',
        );
        array_splice($links, 1, -1, $breadcrumb);
    }
    if (is_singular('staff')) {
        $breadcrumb[] = array(
            'url' => site_url('/staff/'),
            'text' => 'Staff',
        );
        array_splice($links, 1, -1, $breadcrumb);
    }
    return $links;
}

// FAQ Category filter

function gngf_filter_get_posts($taxonomy)
{

    $category = $_POST['category'];
    $paged = $_POST['paged'];
    $paged = !empty($paged) ? (int)$paged : 1;
    $category = !empty($category) && $category != '-1' ? array(
        'taxonomy' => 'faq_category',                //(string) - Taxonomy.
        'field' => 'slug',                    //(string) - Select taxonomy term by ('id' or 'slug')
        'terms' => $category,    //(int/string/array) - Taxonomy term(s).
    ) : '';

    $args = array(
        'post_type' => 'faq',
        'post_status' => 'publish',
        'tax_query' => array(
            $category,
        ),
        'posts_per_page' => get_option('posts_per_page'),
        'paged' => $paged,
    );
    if (!$taxonomy) {
        unset($args['tag']);
    }
    $wp_query = new WP_Query($args);
    if ($wp_query->have_posts()) : ?>
        <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
            <div class="template-faq__item grid-margin-x ">
                <?php if ($thumbnail = get_the_post_thumbnail()) : ?>
                    <div class="template-faq__thumbnail">
                        <?php the_post_thumbnail('large', array('class' => 'template-faq__image preview__thumb skip-lazy')); ?>
                    </div>
                <?php endif; ?>
                <div
                    class="template-faq__content <?php echo $thumbnail ? false : 'template-faq__content-full-width'; ?>">
                    <h2><?php the_title(); ?></h2>
                    <?php $content = get_extended(get_post_field('post_content')); ?>
                    <p class="template-faq__text "><?php echo $content['extended'] ? $content['main'] : wp_trim_words(get_the_content(), 30) ?></p>
                    <a href="<?php the_permalink(); ?>" class="button"><?php _e('learn more') ?></a>
                </div>

            </div>

        <?php endwhile;
        $paginateArgs = array(
            'base' => '%#%',
            'format' => '%#%',
            'current' => $paged,
            'prev_text' => __('«'),
            'next_text' => __('»'),
            'total' => $wp_query->max_num_pages
        ); ?>

        <div class="archive-pagination js-faq-pagination pagination">
            <?php echo str_replace(array('http:', '//'), array('', ''), paginate_links($paginateArgs)); ?>
        </div>
    <?php else: ?>
        <h2><?php _e('No posts found', 'default'); ?></h2>
    <?php endif;

    wp_die();
}

add_action('wp_ajax_filter_posts', 'gngf_filter_get_posts');
add_action('wp_ajax_nopriv_filter_posts', 'gngf_filter_get_posts');

// Blog Post Category Filter

function gngf_filter_get_blog_posts($taxonomy)
{

    $category = $_POST['category'];
    $paged = $_POST['paged'];
    $paged = !empty($paged) ? (int)$paged : 1;
    $category = !empty($category) && $category != '-1' ? array(
        'taxonomy' => 'category',
        'field' => 'slug',                    //(string) - Select taxonomy term by ('id' or 'slug')
        'exclude' => array('12', '18', '24', '28', '21', '20', '16', '19', '26', '23', '25', '17', '27', '22'),
        'terms' => $category,    //(int/string/array) - Taxonomy term(s).
    ) : '';

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'tax_query' => array(
            $category,
        ),
        'posts_per_page' => get_option('posts_per_page'),
        'paged' => $paged,
    );
    if (!$taxonomy) {
        unset($args['tag']);
    }
    $wp_query = new WP_Query($args);
    if ($wp_query->have_posts()) : ?>
        <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
            <div class="template-faq__item grid-margin-x ">
                <?php get_template_part('parts/loop', 'post'); // Post item?>
            </div>

        <?php endwhile; ?>
        <div class="pagination">
            <?php echo foundation_pagination(); ?>
        </div>
    <?php else: ?>
        <h2><?php _e('No posts found', 'default'); ?></h2>
    <?php endif;

    wp_die();
}

add_action('wp_ajax_filter_blog_posts', 'gngf_filter_get_blog_posts');
add_action('wp_ajax_nopriv_filter_blog_posts', 'gngf_filter_get_blog_posts');


add_action('plugins_loaded', 'ao_defer_inline_init');
function ao_defer_inline_init()
{
    if (get_option('autoptimize_js_include_inline') != 'on') {
        add_filter('autoptimize_html_after_minify', 'ao_defer_inline_jquery', 10, 1);
    }
}

function ao_defer_inline_jquery($in)
{
    if (preg_match_all('#<script.*>(.*)</script>#Usmi', $in, $matches, PREG_SET_ORDER)) {
        foreach ($matches as $match) {
            if ($match[1] !== '' && (strpos($match[1], 'jQuery') !== false || strpos($match[1], '$') !== false)) {
                // inline js that requires jquery, wrap deferring JS around it to defer it.
                $new_match = 'var aoDeferInlineJQuery=function(){' . $match[1] . '}; if (document.readyState === "loading") {document.addEventListener("DOMContentLoaded", aoDeferInlineJQuery);} else {aoDeferInlineJQuery();}';
                $in = str_replace($match[1], $new_match, $in);
            } else if ($match[1] === '' && strpos($match[0], 'src=') !== false && strpos($match[0], 'defer') === false) {
                // linked non-aggregated JS, defer it.
                $new_match = str_replace('<script ', '<script defer ', $match[0]);
                $in = str_replace($match[0], $new_match, $in);
            }
        }
    }
    return $in;
}

function sf_widgets_init() {

    register_sidebar( array(
        'name' =>__( 'Footer Menu sidebar', 'fwp'),
        'id' => 'footer-menu-sidebar',
        'description' => __( 'Add Menu for Footer', 'fwp' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}

add_action( 'widgets_init', 'sf_widgets_init' );
