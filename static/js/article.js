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

    var string1 = "\“";
    var string2 = "\‘";

    $('.article-quote').each(function(i) {
      var quoteContainer = $('.article-quote');
      var theQuote = $(this).text();
      var testQuote = $('.article-quote-h').text();
      var theTest = theQuote.substring(2,4);

      // console.log(theQuote.substring(2,4) );
      console.log(theQuote, i);
      console.log(theTest, i);
      console.log("i am" + string1);
      console.log("i am" + string2);

      if ( typeof theTest=="string" && theTest.match(string1) ) {
        $(this).addClass('is-double-quote');
        console.log('i added a is-double-quoteclass');
      } else if( typeof theTest=="string" && theTest.match(string2)  ) {
          $(this).addClass('is-single-quote');
          console.log('i added a is-single-quoteclass');
      }
    });

  } // article quote test

}(jQuery));


