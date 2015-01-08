window.onload = (function($){

  var quickshare, comments;

  if (typeof HE_quickShare !== undefined && typeof HE_quickShare.init !== undefined) {
    quickshare = HE_quickShare.init();
  }
  if (typeof HE_comments !== undefined && typeof HE_comments.init !== undefined) {
    comments = HE_comments.init();
  }


  // Testing whether quote begins with a quote mark
  if( $('.article-quote') ) {

    var string1 = '"';
    var string2 = "'";

    $('.article-quote').each(function(i) {
      var quoteContainer = $('.article-quote');
      var theQuote = $(this).text();
      var testQuote = $('.article-quote-h').text();

      console.log(theQuote.substring(2,4) );
      console.log(testQuote);

      if ( theQuote.substring(2,4) === string2 ) {
        $(this).addClass('is-quote');
        console.log('i added a class');
      }

    });

  }

}(jQuery));
