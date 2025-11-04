// Import everything from autoload folder
import './autoload/**/*'; // eslint-disable-line

// Import local dependencies
import './plugins/lazyload';
import './plugins/modernizr.min';
import 'slick-carousel';
import 'jquery-match-height';
import objectFitImages from 'object-fit-images';
// import '@fancyapps/fancybox/dist/jquery.fancybox.min';
// import { jarallax, jarallaxElement } from 'jarallax';
// import ScrollOut from 'scroll-out';

/**
 * Import scripts from Custom Divi blocks
 */
// eslint-disable-next-line import/no-unresolved
// import '../blocks/divi/**/index.js';

/**
 * Import scripts from Custom Elementor widgets
 */
// eslint-disable-next-line import/no-unresolved
// import '../blocks/elementor/**/index.js';

/**
 * Import scripts from Custom ACF Gutenberg blocks
 */
// eslint-disable-next-line import/no-unresolved
// import '../blocks/gutenberg/**/index.js';

/**
 * Init foundation
 */
$(document).foundation();

/**
 * Fit slide video background to video holder
 */
function resizeVideo() {
  let $holder = $('.videoHolder');
  $holder.each(function () {
    let $that = $(this);
    let ratio = $that.data('ratio') ? $that.data('ratio') : '16:9';
    let width = parseFloat(ratio.split(':')[0]);
    let height = parseFloat(ratio.split(':')[1]);
    $that.find('.video').each(function () {
      if ($that.width() / width > $that.height() / height) {
        $(this).css({
          width: '100%',
          height: 'auto',
        });
      } else {
        $(this).css({
          width: ($that.height() * width) / height,
          height: '100%',
        });
      }
    });
  });
}

/**
 * Scripts which runs after DOM load
 */
$(document).on('ready', function () {
  /**
   * Make elements equal height
   */
  $('.matchHeight').matchHeight();
  $('.cta__item').matchHeight();

  /**
   * IE Object-fit cover polyfill
   */
  if ($('.of-cover').length) {
    objectFitImages('.of-cover');
  }

  /**
   * Add fancybox to images
   */
  // $('.gallery-item')
  //   .find('a[href$="jpg"], a[href$="png"], a[href$="gif"]')
  //   .attr('rel', 'gallery')
  //   .attr('data-fancybox', 'gallery');
  // $(
  //   '.fancybox, a[rel*="album"], a[href$="jpg"], a[href$="png"], a[href$="gif"]'
  // ).fancybox({
  //   minHeight: 0,
  //   helpers: {
  //     overlay: {
  //       locked: false,
  //     },
  //   },
  // });

  /**
   * Init parallax
   */
  // jarallaxElement();
  // jarallax(document.querySelectorAll('.jarallax'), {
  //   speed: 0.5,
  // });

  /**
   * Detect element appearance in viewport
   */
  // ScrollOut({
  //   offset: function() {
  //     return window.innerHeight - 200;
  //   },
  //   once: true,
  //   onShown: function(element) {
  //     if ($(element).is('.ease-order')) {
  //       $(element)
  //         .find('.ease-order__item')
  //         .each(function(i) {
  //           let $this = $(this);
  //           $(this).attr('data-scroll', '');
  //           window.setTimeout(function() {
  //             $this.attr('data-scroll', 'in');
  //           }, 300 * i);
  //         });
  //     }
  //   },
  // });

  /**
   * Remove placeholder on click
   */
  const removeFieldPlaceholder = () => {
    $('input, textarea').each((i, el) => {
      $(el)
        .data('holder', $(el).attr('placeholder'))
        .on('focusin', () => {
          $(el).attr('placeholder', '');
        })
        .on('focusout', () => {
          $(el).attr('placeholder', $(el).data('holder'));
        });
    });
  };

  removeFieldPlaceholder();

  $(document).on('gform_post_render', () => {
    removeFieldPlaceholder();
  });

  /**
   * Scroll to Gravity Form confirmation message after form submit
   */
  $(document).on('gform_confirmation_loaded', function (event, formId) {
    let $target = $('#gform_confirmation_wrapper_' + formId);
    if ($target.length) {
      $('html, body').animate({ scrollTop: $target.offset().top - 50 }, 500);
      return false;
    }
  });

  /**
   * Hide gravity forms required field message on data input
   */
  $('body').on(
    'change keyup',
    '.gfield input, .gfield textarea, .gfield select',
    function () {
      let $field = $(this).closest('.gfield');
      if ($field.hasClass('gfield_error') && $(this).val().length) {
        $field.find('.validation_message').hide();
      } else if ($field.hasClass('gfield_error') && !$(this).val().length) {
        $field.find('.validation_message').show();
      }
    }
  );

  /**
   * Add `is-active` class to menu-icon button on Responsive menu toggle
   * And remove it on breakpoint change
   */
  $(window)
    .on('toggled.zf.responsiveToggle', function () {
      $('.menu-icon').toggleClass('is-active');
    })
    .on('changed.zf.mediaquery', function () {
      $('.menu-icon').removeClass('is-active');
    });

  /**
   * Close responsive menu on orientation change
   */
  $(window).on('orientationchange', function () {
    setTimeout(function () {
      if ($('.menu-icon').hasClass('is-active') && window.innerWidth < 641) {
        $('[data-responsive-toggle="main-menu"]').foundation('toggleMenu');
      }
    }, 200);
  });

  resizeVideo();

  // Mobile Menu

  $('.menu-icon').on('click', function (e) {
    $('.top-bar').toggleClass('menu-show');
    $('body').toggleClass('menu-overlay');
    e.stopPropagation();
  });

  // Mobile Location

  $('body').click(function () {
    $('.mobile-contact-info__list').removeClass('locations-show');
    $(this).removeClass('main-overlay');
  });
  $('.mobile-contact-info__phone, .mobile-contact-info__location').on(
    'click',
    function (e) {
      $('.mobile-contact-info__list').toggleClass('locations-show');
      $('body').toggleClass('main-overlay');
      e.stopPropagation();
    }
  );

  // Header Search
  $('.header-search-icon').click(function () {
    $('.header-search__wrap').fadeToggle();
  });

  // Awards Slider
  $('.awards__slider').slick({
    infinite: true,
    slidesToShow: 6,
    slidesToScroll: 1,
    arrows: false,
    autoplay: true,
    responsive: [
      {
        breakpoint: 1390,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 971,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 650,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });

  // Testimonial slider
  $('.testimonials__slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    centerMode: true,
    variableWidth: true,
    autoplay: true,
    prevArrow: $('.testimonials__prev-arrow'),
    nextArrow: $('.testimonials__next-arrow'),
  });

  // Attorneys slider
  $('.attorney__slide').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.nav-slider__nav-slider',
    responsive: [
      {
        breakpoint: 961,
        settings: {
          adaptiveHeight: true,
        },
      },
    ],
  });
  $('.nav-slider__nav-slider').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    asNavFor: '.attorney__slide',
    dots: true,
    infinite: true,
    lazyLoad: 'ondemand',
    focusOnSelect: true,
    responsive: [
      {
        breakpoint: 971,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          centerMode: true,
        },
      },
      {
        breakpoint: 651,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          centerMode: true,
        },
      },
    ],
  });

  // FAQ slider
  $('.faq__slider').slick({
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    arrows: true,
    dots: true,
    autoplay: true,
    variableWidth: true,
    prevArrow: $('.faq__slider-nav-prev'),
    nextArrow: $('.faq__slider-nav-next'),
    responsive: [
      {
        breakpoint: 651,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          centerMode: false,
        },
      },
    ],
  });

  // Blog Slider
  $('.home-blog__slider').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: false,
    autoplay: true,
    responsive: [
      {
        breakpoint: 769,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });

  // Map Slider
  $('.map-slider').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: false,
    responsive: [
      {
        breakpoint: 769,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });

  // Attorney Tabs
  $('.tabs-title').on('click', function () {
    let block = $(this).parents('.attorney-tabs');
    let item = block.find('.tabs-content');
    let id = $('#test').attr('id');
    item.each(function () {
      if (id == $(item).attr('id')) {
        $(this).toggleClass('is-active');
      }
    });
  });

  // Table Contents
  $('.table-of-contents__title').on('click', function () {
    $('.table-of-contents__list').slideToggle();
    $(this).toggleClass('content-active');
  });

  // Social Menu
  $('.header-socials__button').on('click', function () {
    $('.header-socials').toggleClass('sticky-active');
  });

  // Sidebar Height
  let content = $('.attorney-tabs').height();
  let sidebar = $('.custom-sidebar').height() - 300;
  let pageContent = $('.entry__content').height();
  let customePageContent = $('.custom-template-content').height();
  if (content < sidebar) {
    let mainSidebar = $('.sidebar');
    let button = $('.more-arrow');
    mainSidebar.height(content);
    mainSidebar.addClass('sidebar-more');
    button.addClass('more-arrow-active');
    button.on('click', function () {
      $('.sidebar').toggleClass('sidebar-more');
      $('.more-arrow').toggleClass('arrow-up');
      if ($(this).hasClass('arrow-up')) {
        let h = '100%';
        $('.sidebar').height(h);
      } else {
        $('.sidebar').height(content);
      }
    });
  }
  if (pageContent < sidebar) {
    let mainSidebar = $('.sidebar');
    let button = $('.more-arrow');
    mainSidebar.height(pageContent + 200);
    mainSidebar.addClass('sidebar-more');
    button.addClass('more-arrow-active');
    button.on('click', function () {
      $('.sidebar').toggleClass('sidebar-more');
      $('.more-arrow').toggleClass('arrow-up');
      if ($(this).hasClass('arrow-up')) {
        let h = '100%';
        $('.sidebar').height(h);
      } else {
        $('.sidebar').height(pageContent + 200);
      }
    });
  }
  if (customePageContent < sidebar) {
    let mainSidebar = $('.sidebar');
    let button = $('.more-arrow');
    mainSidebar.height(customePageContent + 400);
    mainSidebar.addClass('sidebar-more');
    button.addClass('more-arrow-active');
    button.on('click', function () {
      $('.sidebar').toggleClass('sidebar-more');
      $('.more-arrow').toggleClass('arrow-up');
      if ($(this).hasClass('arrow-up')) {
        let h = '100%';
        $('.sidebar').height(h);
      } else {
        $('.sidebar').height(customePageContent + 400);
      }
    });
  }

  // Category Ajax Filter
  $('#cat').change(function () {
    let dropdown = document.getElementById('cat');
    if (dropdown.options[dropdown.selectedIndex].value) {
      let category = dropdown.options[dropdown.selectedIndex].value;
      filterPosts(category);
    }
  });

  $('.js-faq-pagination .page-numbers').click(function (e) {
    $('html, body').animate(
      {
        scrollTop: $('html').offset().top + 100,
      },
      500
    );
    e.preventDefault();
    filterPosts('-1', $(this).attr('href'));
  });

  function filterPosts(category = '', paged = 1) {
    let data = {
      action: 'filter_posts',
      category: category,
      paged: paged,
    };
    $('.faqs-list-js').fadeOut();
    // eslint-disable-next-line no-undef
    $.post(ajax_object.ajax_url, data, function (response) {
      if (response) {
        $('.faqs-list-js').html(response);
        $('.faqs-list-js').addClass('ajax-js');
        $('.ajax-js .archive-pagination .page-numbers').click(function (e) {
          $('html, body').animate(
            {
              scrollTop: $('html').offset().top + 100,
            },
            500
          );
          e.preventDefault();
          filterPosts(category, $(this).attr('href'));
        });
        $('.faqs-list-js').fadeIn();
      }
    });
  }
});

/**
 * Scripts which runs after all elements load
 */
$(window).on('load', function () {
  // jQuery code goes here
  let $preloader = $('.preloader');
  if ($preloader.length) {
    $preloader.addClass('preloader--hidden');
  }
});

/**
 * Scripts which runs at window resize
 */
$(window).on('resize', function () {
  // jQuery code goes here

  resizeVideo();
});

/**
 * Scripts which runs on scrolling
 */
$(window).on('scroll', function () {
  // jQuery code goes here
});
