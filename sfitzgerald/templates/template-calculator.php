<?php
/**
 * Template Name: Calculator Page
 */
get_header(); ?>

<main class="main-content">
    <?php $page_thumbnail = get_the_post_thumbnail_url(); ?>
    <?php get_template_part('parts/page-hero'); ?>
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
        <div class="grid-x ">
            <!-- BEGIN of page content -->
            <div class="large-9 medium-12 small-12 cell">
                <?php if (have_rows('table_of_contents')): ?>
                    <div class="table-of-contents">
                        <?php if ($table_of_contents_title = get_field('table_of_contents_title')) : ?>
                            <h3 class="table-of-contents__title"><?php echo $table_of_contents_title; ?> <i
                                    class="fa-sharp fa-solid fa-angle-down"></i></h3>
                        <?php endif; ?>
                        <ol class="table-of-contents__list">
                            <?php while (have_rows('table_of_contents')) : the_row();

                                // Load sub field value.
                                $title = get_sub_field('title');
                                $anchor_link = get_sub_field('anchor_link');
                                ?>
                                <li class="table-of-contents__item"><a
                                        href="#<?php echo $anchor_link; ?>"><?php echo $title; ?></a></li>
                            <?php endwhile; ?>
                        </ol>

                    </div>
                <?php endif; ?>

                <article <?php post_class('entry'); ?>>
                    <div class="entry__content">
                        <?php the_content('', true); ?>
                        <?php if ($calculator = get_field('calculator')):
                            echo $calculator; ?>
                            <div class="calc-arrows">
                                <div class="form-arrow-left"></div>
                                <div class="form-arrow-right"></div>
                            </div>
                        <?php endif; ?>
                        <?php if ($final_cta = get_field('final_cta')) { ?>
                            <div class="final-cta">
                                <a href="<?php echo esc_url($final_cta['url']) ?>"
                                   target="<?php echo esc_attr($final_cta['target']) ?: '_self'; ?>" class="button">
                                    <?php echo esc_html($final_cta['title']); ?>
                                </a>
                            </div>
                        <?php } ?>
                        <?php if (have_rows('content_accordion')): ?>
                            <div class="content-accordion">
                                <ul class="accordion" data-accordion data-allow-all-closed="true">
                                    <?php while (have_rows('content_accordion')): the_row();
                                        $heading = get_sub_field('heading');
                                        $content = get_sub_field('content');
                                        if ($heading && $content):?>
                                            <li class="accordion-item"
                                                data-accordion-item>
                                                <a href="#" class="accordion-title">
                                                    <h2>
                                                        <?php echo esc_html($heading); ?>
                                                    </h2>
                                                </a>
                                                <div class="accordion-content" data-tab-content>
                                                    <?php echo $content; ?>
                                                </div>
                                            </li>
                                        <?php
                                        endif;
                                    endwhile; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </article>

            </div>
            <!-- END of page content -->

            <!-- BEGIN of sidebar -->
            <div
                class="large-3 medium-12 small-12 cell calc-sidebar <?php echo $page_thumbnail ? false : 'page-no-bg' ?>">
                <div class="calc-sidebar__container">
                    <div class="calc-sidebar__heading">
                        <?php echo _e('Final Credit Score', 'sfitzgerald'); ?>
                    </div>
                    <div class="calc-sidebar__result" id='calc-result'>

                    </div>
                    <div class="calc-sidebar__hint">
                        <?php echo _e('Read "Understanding Credit Scores" below to learn more.', 'sfitzgerald'); ?>
                    </div>
                </div>
            </div>
            <!-- END of sidebar -->
        </div>
    </div>
</main>

<script>
    jQuery(document).ready(function ($) {
        var currentQuestionIndex = 0;
        var questions = $('.cff-radiobutton-field');
        var totalQuestions = questions.length;
        var sectionBreaks = $('.section_breaks');
        questions.hide();
        questions.eq(currentQuestionIndex).show();
        sectionBreaks.hide();
        sectionBreaks.eq(currentQuestionIndex).show();

        function checkStartEnd() {
            if (currentQuestionIndex == 0) {
                $('.form-arrow-left').hide();
            } else {
                $('.form-arrow-left').show();
            }
            if (currentQuestionIndex == totalQuestions - 1) {
                $('.form-arrow-right').hide();
                $('.final-cta').css('display', 'block');
            } else {
                $('.form-arrow-right').show();
                $('.final-cta').css('display', 'none');
            }
        }

        function showNextQuestion() {
            if (currentQuestionIndex < totalQuestions - 1) {
                questions.eq(currentQuestionIndex).hide();
                sectionBreaks.hide();
                currentQuestionIndex++;
                questions
                    .eq(currentQuestionIndex)
                    .prevAll('.section_breaks:first')
                    .show();
                questions.eq(currentQuestionIndex).show();
            }
        }

        function showPreviousQuestion() {
            if (currentQuestionIndex > 0) {
                questions.eq(currentQuestionIndex).hide();
                sectionBreaks.hide();
                currentQuestionIndex--;
                questions
                    .eq(currentQuestionIndex)
                    .prevAll('.section_breaks:first')
                    .show();
                questions.eq(currentQuestionIndex).show();
            }
        }

        checkStartEnd();
        $('.form-arrow-left').click(function () {
            showPreviousQuestion();
            checkStartEnd();
        });

        $('.form-arrow-right').click(function () {
            showNextQuestion();
            checkStartEnd();
        });

        $('#fieldname1_1').appendTo('#calc-result');
    });
</script>

<?php get_footer(); ?>
