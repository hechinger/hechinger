window.onload = (function($){

  var quickshare, comments;

  if (typeof HE_quickShare !== undefined && typeof HE_quickShare.init !== undefined) {
    quickshare = HE_quickShare.init();
  }
  if (typeof HE_comments !== undefined && typeof HE_comments.init !== undefined) {
    comments = HE_comments.init();
  }


  // Testing whether quote begins with a double or single quote mark
  if( $('.article-quote') ) {

    var string1 = "\“";
    var string2 = "\‘";

    $('.article-quote').each(function(i) {
      var quoteContainer = $('.article-quote');
      var theQuote = $(this).text();
      var testQuote = $('.article-quote-h').text();
      var theTest = theQuote.substring(2,4);

      if ( typeof theTest=="string" && theTest.match(string1) ) {
        $(this).addClass('is-double-quote');
      } else if( typeof theTest=="string" && theTest.match(string2)  ) {
          $(this).addClass('is-single-quote');
      }
    });

  } // article quote test

}(jQuery));
