<section class="media">
    <div class="grid-container fluid">
        <div class="grid-x">
            <div class="media__wrap">
                <?php
                $video_background = get_field('video_background');
                $video_url = get_field('video_url');
                if ($video_url):?>
                    <div class="media__video" <?php bg($video_background); ?>>
                        <div class="media__video-overlay">
                            <?php if ($video_title = get_field('video_title')): ?>
                                <h2 class="media__video-title">
                                    <?php echo $video_title;
                                    ?></h2>
                            <?php endif; ?>
                            <?php if ($video_gallery = get_field('video_gallery')): ?>
                                <div class="media__video-gallery">
                                    <?php echo $video_gallery; ?>
                                </div>
                            <?php endif; ?>
                            <!--                            <a href="--><?php //echo $video_url;
                            ?><!--" class="vp-a ">-->
                            <!--                                <div class="video-play"></div>-->
                            <!--                            </a>-->
                            <!--                            --><?php
                            //                            if ($video_button = get_field('video_button')):
                            ?>
                            <!--                                <a class="read-more button" href="-->
                            <?php //echo esc_url($video_button['url']);
                            ?><!--"-->
                            <!--                                   target="-->
                            <?php //echo esc_attr($video_button['target'] ?: '_self');
                            ?><!--">-->
                            <?php //echo esc_html($video_button['title']);
                            ?><!--</a>-->
                            <!--                            --><?php //endif;
                            ?>
                            <a href="https://www.youtube.com/@simonfitzgeraldllc-bankrup4842" target="blank" class="read-more button" style="margin-top:40px;">More Videos </a>

                        </div>

                    </div>
                <?php endif; ?>


                <?php $book_background_image = get_field('book_background_image'); ?>
                <div class="media__book" <?php bg($book_background_image); ?>>
                    <div class="media__book-overlay">
                        <?php if ($book_image = get_field('book_image')): ?>
                            <div class="media__book-image">
                                <picture>
                                    <?php if ($book_mobile_image = get_field('book_mobile_image')): ?>
                                        <source media="(max-width:640px)" srcset="<?php echo $book_mobile_image; ?>">
                                    <?php endif; ?>
                                    <?php echo wp_get_attachment_image($book_image['ID'], 'full', false); ?>
                                </picture>
                            </div>
                        <?php endif; ?>
                        <div class="media__book-content">
                            <?php
                            if ($book_text = get_field('book_text')):
                                echo $book_text;
                            endif;
                            if ($book_button = get_field('book_button')):?>
                                <a class="read-more button media__book-download"
                                   href="<?php echo esc_url($book_button['url']); ?>"
                                   target="<?php echo esc_attr($book_button['target'] ?: '_self'); ?>"><?php echo esc_html($book_button['title']); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
