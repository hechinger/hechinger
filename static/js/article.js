window.onload = (function($){

  var quickshare, comments;

  if (typeof HE_quickShare !== undefined && typeof HE_quickShare.init !== undefined) {
    quickshare = HE_quickShare.init();
  }
  if (typeof HE_comments !== undefined && typeof HE_comments.init !== undefined) {
    comments = HE_comments.init();
  }


  // Testing whether quote begins with a double or single quote mark
  if( $('.js-article-quote-h').length ) {

    var $quoteH = $('.js-article-quote-h');
    var string1 = "\“";
    var string2 = "\‘";

    $quoteH.each(function(i) {
      var $this = $(this);
      var $parent = $this.parent();
      var theQuote = $this.text();
      var theTest = theQuote.substring(0,2);

      if ( typeof theTest=="string" && theTest.match(string1) ) {
        $parent.addClass('is-double-quote');
      } else if( typeof theTest=="string" && theTest.match(string2)  ) {
          $parent.addClass('is-single-quote');
      }
    });

  } // article quote test

}(jQuery));

