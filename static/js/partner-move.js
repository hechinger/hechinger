var HE_partner = (function($){
  "use strict";

  var $partnerAside;
  var $targetParagraph;

  function init() {
    // get the partner aside
    $partnerAside = $('.js-partner-aside');
    if (typeof $partnerAside === 'undefined' || !$partnerAside.length) {
      return;
    }
    // find the third paragraph or the last paragraph if article less than 3 paragraphs
    $targetParagraph = findParagraph(2);

    if (typeof $targetParagraph !== 'undefined' || !$targetParagraph || !$targetParagraph.length) {
      $partnerAside.insertAfter($targetParagraph);
    }
  }

  // find a paragraph by index, if article is shorter than index, find the last paragraph recursively
  function findParagraph(index) {
    var graph, $graph;

    if (index > 0) {
      // eliminate paragraphs in asides or captions
      graph = $('.js-article-text').find('p').not('.article-aside p').not('.img-caption-text')[index];
      $graph = $(graph);
      return $graph !== 'undefined' && $graph.length ? $graph : findParagraph(index - 1);
    } else {
      return false;
    }
  }

  return {
    init: init
  };

}(jQuery));
