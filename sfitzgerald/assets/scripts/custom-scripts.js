$ = jQuery;

$(document).on('ready', function () {
  // Hero Map Hover

  // $('[data-popover="map-popover--0"]').hover(function (){
  // 	$('.hero-map .map-overlay').toggleClass('active');
  // 	$('.hero-map .map-overlay').toggleClass('shreveport-highlight');
  // });
  //
  // $('[data-popover="map-popover--1"]').hover(function (){
  // 	$('.hero-map .map-overlay').toggleClass('active');
  // 	$('.hero-map .map-overlay').toggleClass('alexandria-highlight');
  // });
  //
  // $('[data-popover="map-popover--2"]').hover(function (){
  // 	$('.hero-map .map-overlay').toggleClass('active');
  // 	$('.hero-map .map-overlay').toggleClass('lakecharles-highlight');
  // });

  $('.st4').mouseenter(function () {
    $('.map-popup-content').removeClass('showContent');
    $('.current-pointer-2 + .map-popup-content').toggleClass('showContent');
  });
  $('.st5').mouseenter(function () {
    $('.map-popup-content').removeClass('showContent');
    $('.current-pointer-0 + .map-popup-content').toggleClass('showContent');
  });
  $('.st6').mouseenter(function () {
    $('.map-popup-content').removeClass('showContent');
    $('.current-pointer-1 + .map-popup-content').toggleClass('showContent');
  });

  // Header Height

  $(window).on('resize', function () {
    var HeaderHeight = $('.header').height();
    $('.hero-home').css('margin-top', HeaderHeight);
    $('.main-content').css('margin-top', HeaderHeight);
    $('.header-search__wrap').css('margin-top', HeaderHeight);
  });

  // Blog Post Ajax Filter
  $('#cat-custom').change(function () {
    let dropdown = document.getElementById('cat-custom');
    if (dropdown.options[dropdown.selectedIndex].value) {
      let category = dropdown.options[dropdown.selectedIndex].value;
      filterBlogPosts(category);
    }
  });

  $('.js-blog-pagination .page-numbers').click(function (e) {
    $('html, body').animate(
      {
        scrollTop: $('html').offset().top + 100,
      },
      500
    );
    e.preventDefault();
    filterBlogPosts('-1', $(this).attr('href'));
  });

  function filterBlogPosts(category = '', paged = 1) {
    let data = {
      action: 'filter_blog_posts',
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
          filterBlogPosts(category, $(this).attr('href'));
        });
        $('.faqs-list-js').fadeIn();
      }
    });
  }
});
