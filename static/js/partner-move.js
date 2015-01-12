var HE_partner = (function($){
  "use strict";

  var $partnerAside;
  var $paragraph;

  function init() {
    $partnerAside = $('.partner-aside');
    if (typeof $partnerAside === 'undefined' || !$partnerAside.length) {
      return;
    }

    $paragraph = findParagraph(3);

    if (typeof $paragraph !== 'undefined' || !$paragraph || !$paragraph.length) {
      return;
    }
  }

  function findParagraph(index) {
    var graph;

    if (index > 0) {
      graph = $('.article-txt p:nth-child(' + index + ')');
      return graph !== 'undefined' && graph.length ? graph : findParagraph(index - 1);
    } else {
      return false;
    }
  }

  function insertPartners() {
    $partnerAside.insertAfter($paragraph);
  }

  return {
    init: init
  };

}(jQuery));
