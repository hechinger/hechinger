//TODO: refoctor with modular pattern
;(function($){

  var $resp = $('[data-resp]');
  var width = $(window).width()

  if (typeof $resp !== 'undefined' && $resp.length) {
    $.each($resp, function(){
      var $this = $(this);
      var bgImg = $this.attr('data-resp');
      var imgWidth = $this.attr('data-resp-width');
      if (typeof imgWidth !== 'string' || typeof imgWidth !== 'number') {
        imgWidth = 700;
      }

      if (width > imgWidth) {
        $this.css('background-image', 'url(' + bgImg + ')');
      }
    });
  }

}(jQuery));
