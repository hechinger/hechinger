var HE_navbar = (function($){
  "use strict";

  var $body = $('body');

  var $searchButton = $('.js-nav-search-button');
  var searchIsOpen = $searchButton.hasClass('is-open');
  var $searchForm = $('.search-form-wrap');
  var $navSearchInput = $('.search-form-wrap .search-text-input');
  var searchIsFocused = $body.hasClass('search-is-focused');

  var $menuButton = $('.js-nav-menu-button');
  var navIsOpen = $menuButton.hasClass('is-open');

  var $topicsButton = $('.js-topics-trigger');
  var topicsIsOpen = $body.hasClass('topics-is-open');

  function openMenu(event) {
    event.preventDefault();
    if (navIsOpen) {
      $menuButton.removeClass('is-open');
      $body.removeClass('nav-is-open');
      navIsOpen = false;
    } else {
      $menuButton.addClass('is-open');
      $body.addClass('nav-is-open');
      navIsOpen = true;
    }
  }

  function openSearch(event) {
    event.preventDefault();
    if (searchIsOpen) {
      $searchButton.removeClass('is-open');
      $searchForm.removeClass('is-open');
      $body.removeClass('search-is-open')
      searchIsOpen = false;
    } else {
      $searchButton.addClass('is-open');
      $searchForm.addClass('is-open');
      $body.addClass('search-is-open')
      searchIsOpen = true;
    }
  }

  function focusSearch(event) {
    event.preventDefault();
    if (searchIsFocused) {
      $body.removeClass('search-is-focused')
      searchIsFocused = false;
    } else {
      $body.addClass('search-is-focused')
      searchIsFocused = true;
    }
  }

  function openTopics(event) {
    event.preventDefault();
    if (!topicsIsOpen) {
      $body.addClass('topics-is-open');
      topicsIsOpen = true;
    }
  }

  function closeTopics(event) {
    event.preventDefault();
    if (topicsIsOpen)  {
      $body.removeClass('topics-is-open');
      topicsIsOpen = false;
    }
  }

  function init() {
    $menuButton.on('click', openMenu);
    $searchButton.on('click', openSearch);
    $topicsButton.hover(openTopics, closeTopics);
    $navSearchInput.focus(focusSearch);
    $navSearchInput.blur(focusSearch);
    //$topicsButton.on('mouseleave', closeTopics);
  }

  return {
    init: init
  };

}(jQuery));
