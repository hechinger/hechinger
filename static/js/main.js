window.onload = (function($, FastClick, HE_navbar, HE_responsiveBg, quickshare, undefined){
  "use strict";

  var navbar, responsiveBg;

  // enable fastclick
  if (typeof FastClick !== undefined && typeof FastClick.attach !== undefined) {
    FastClick.attach(document.body);
  }

  if (typeof HE_navbar !== undefined && typeof HE_navbar.init !== undefined) {
    navbar = HE_navbar.init();
  }

  if (typeof HE_responsiveBg !== undefined && typeof HE_responsiveBg.init !== undefined) {
    responsiveBg = HE_responsiveBg.init();
  }

  if (typeof quickShare == 'function') {
    quickShare();
  }

}(window.jQuery, window.FastClick, window.HE_navbar, window.HE_responsiveBg, window.quickshare));
