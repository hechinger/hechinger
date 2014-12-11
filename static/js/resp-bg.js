//TODO: refoctor with modular pattern
;(function($){

  var $resp = $('[data-resp]');
  var $window = $(window);
  var width = $window.width()
  var timeout;
  var dbChangeBackgrounds = debounce(changeBackgrounds, 300);

  function backgroundImageSwap(){
    console.log('hey');
    var $this = $(this);
    var bgImg = $this.attr('data-resp');
    var imgWidth = $this.attr('data-resp-width');
    if (typeof imgWidth !== 'string' || typeof imgWidth !== 'number') {
      imgWidth = 700;
    }

    if (width > imgWidth) {
      $this.css('background-image', 'url(' + bgImg + ')');
    }
  }

  function changeBackgrounds(){
    $.each($resp, backgroundImageSwap);
  }

  function debounce(func, wait, immediate) {
    return function() {
      var context = this, args = arguments;
      var later = function() {
        timeout = null;
        if (!immediate) func.apply(context, args);
      };
      var callNow = immediate && !timeout;
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
      if (callNow) func.apply(context, args);
    };
  };

  if (typeof $resp !== 'undefined' && $resp.length) {
    changeBackgrounds();
  }

  $window.on('resize', dbChangeBackgrounds);

}(jQuery));
