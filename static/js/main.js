window.onload = (function($, FastClick){
  "use strict";

  var navbar, responsiveBg;

  // enable fastclick
  if (typeof FastClick !== undefined && typeof FastClick.attach !== undefined) {
    FastClick.attach(document.body);
  }

  if (typeof HE_navbar !== undefined && typeof HE_navbar.init !== undefined) {
    navbar = HE_navbar.init();
  }

  if (typeof HE_navbar !== undefined && typeof HE_responsiveBg.init !== undefined) {
    responsiveBg = HE_responsiveBg.init();
  }

}(jQuery, FastClick));
