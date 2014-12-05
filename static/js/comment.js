(function($){
  var $commentTrigger = $('#comment-trigger');
  var $commentMod = $('#comment-mod');
  var commentClass = 'comment-mod--is-active';
  var commentIsActive = $commentMod.hasClass(commentClass);

  function showComments() {
    event.preventDefault();
    if (commentIsActive) {
      $commentMod.removeClass(commentClass);
      commentIsActive = false;
    } else {
      $commentMod.addClass(commentClass);
      commentIsActive = true;
    }
  }

  // add the listener
  $commentTrigger.on('click', showComments);

}(jQuery));
