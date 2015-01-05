window.onload = (function($, fitText){
  "use strict";

  var $window = $(window);
  var windowWidth = $window.width();
  var $topHeadline = $(".js-tz-hp-lead");

  function headlineResizer() {
    if (windowWidth > 400  && windowWidth < 499) {
      $topHeadline.fitText(
        0.9, {
          minFontSize: '36px',
          maxFontSize: '52px'
        });
    }
    if (windowWidth > 500  && windowWidth < 649) {
      $topHeadline.fitText(
        0.93, {
          minFontSize: '46px',
          maxFontSize: '76px'
        });
    }
    if (windowWidth > 650 && windowWidth < 749) {
      $topHeadline.fitText(
        0.95, {
          minFontSize: '64px',
          maxFontSize: '82px'
        });
    }
    if (windowWidth > 750 && windowWidth < 899) {
      $topHeadline.fitText(
        0.9, {
          minFontSize: '60px',
          maxFontSize: '96px'
        });
    }
    if (windowWidth > 900 && windowWidth < 920 ) {
      $topHeadline.fitText(
        0.8, {
          minFontSize: '92px',
          maxFontSize: '110px'
        });
    }
    if (windowWidth > 920) {
      // destroy fittext
      $(window).off('resize.fittext orientationchange.fittext');
      $topHeadline.css('font-size', '');
    }
  }

  function init() {
    // Run resizer on window resize
    $window.resize(function() {
      windowWidth = $window.width();
      headlineResizer();
    });

    // Run resizer on page load
    headlineResizer();
  }

  if (typeof fitText !== undefined && $topHeadline !== undefined && $topHeadline.length ) {
    init();
  }

}(jQuery, window.fitText));
