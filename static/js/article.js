window.onload = (function($){

  var quickshare, comments;

  if (typeof HE_quickShare !== undefined && typeof HE_quickShare.init !== undefined) {
    quickshare = HE_quickShare.init();
  }
  if (typeof HE_comments !== undefined && typeof HE_comments.init !== undefined) {
    comments = HE_comments.init();
  }
  if (typeof HE_blockquote !== undefined && typeof HE_blockquote.init !== undefined) {
    blockquote = HE_blockquote.init();
  }

}(jQuery));
