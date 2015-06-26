var HE_ad = (function($){
  "use strict";

  var $adAside;
  var $targetParagraph;
  var $adAside2;
  var $targetParagraph2;

  function init() {
    // get the partner aside
    $adAside = $('.js-ad-aside');
    $targetParagraph = findParagraph(4);
    $adAside2 = $('.js-ad-aside2');
    $targetParagraph2 = findParagraph(30);

    function setAdSpot(ad, paragraph){
        if (typeof ad === 'undefined' || !ad.length) {
          return;
        }
        // find the fifth paragraph or the last paragraph if article less than 5 paragraphs 

        if (typeof paragraph !== 'undefined' || !paragraph || !paragraph.length) {
          ad.insertAfter(paragraph);
          ad.css('opacity','1');
        }
    }

    setAdSpot($adAside, $targetParagraph)
    setAdSpot($adAside2, $targetParagraph2)   

  }

  // find a paragraph by index, if article is shorter than index, find the last paragraph recursively
  function findParagraph(index) {
    var graph, $graph;

    if (index > 0) {
      // eliminate paragraphs in asides or captions
      graph = $('.js-article-text').find('p').not('.article-aside p').not('.img-caption-text').not('.js-partner-aside p')[index];
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
