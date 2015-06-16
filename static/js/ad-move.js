var HE_ad = (function($){
  "use strict";

  var $adAside;
  var $targetParagraph;

  function init() {
    // get the partner aside
    $adAside = $('.js-ad-aside');
    if (typeof $adAside === 'undefined' || !$adAside.length) {
      return;
    }
    // find the fifth paragraph or the last paragraph if article less than 5 paragraphs
    $targetParagraph = findParagraph(4);

    if (typeof $targetParagraph !== 'undefined' || !$targetParagraph || !$targetParagraph.length) {
      $adAside.insertAfter($targetParagraph);
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
