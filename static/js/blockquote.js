var HE_blockquote = (function($){
  "use strict";

  var $quoteH = $('.js-article-quote-h');
  var string1 = "“";
  var string2 = "‘";

  // Testing whether quote begins with a double or single quote mark
  function init() {
    if( $($quoteH).length ) {
      $quoteH.each(function(i) {
        fixPadding.call(this);
      });
    }
  } // article quote test

  function fixPadding() {
    var $this = $(this);
    var $parent = $this.parent();
    var theQuote = $this.text();
    var theTest = theQuote.substring(0,2);

    if ( typeof theTest === "string" && theTest.match(string1) ) {
      $parent.addClass('is-double-quote');
    } else if( typeof theTest === "string" && theTest.match(string2)  ) {
      $parent.addClass('is-single-quote');
    }
  }

  return {
    init: init,
  };

}(jQuery));
