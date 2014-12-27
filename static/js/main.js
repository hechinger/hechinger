window.onload = (function($){
  "use strict";

  // enable fastclick
  $(function() {
      FastClick.attach(document.body);
  });

  var navbar, responsiveBg;

  if (typeof HE_navbar !== undefined && typeof HE_navbar.init !== undefined) {
    navbar = HE_navbar.init();
  }

  if (typeof HE_navbar !== undefined && typeof HE_responsiveBg.init !== undefined) {
    responsiveBg = HE_responsiveBg.init();
  }

}(jQuery));
