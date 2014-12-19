var HE_comments = (function($){

  var $commentTrigger = $('#comment-trigger');
  var $commentMod = $('#comment-mod');
  var commentClass = 'comment-mod--is-active';
  var commentIsActive = $commentMod.hasClass(commentClass);

  function init() {
    $commentTrigger.on('click', showComments);
  }

  function showComments(event) {
    event.preventDefault();
    if (commentIsActive) {
      $commentMod.removeClass(commentClass);
      commentIsActive = false;
    } else {
      $commentMod.addClass(commentClass);
      commentIsActive = true;
    }
  }

  return {
    init: init,
    showComments: showComments
  }

}(jQuery));
