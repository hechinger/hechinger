var HE_navbar = (function($){
  "use strict";

  var $searchButton = $('.js-nav-search-button');
  var searchIsOpen = $searchButton.hasClass('is-open');
  var $searchForm = $('.search-form-wrap');

  var $menuButton = $('.js-nav-menu-button');
  var navIsOpen = $menuButton.hasClass('is-open');
  var $navbar = $('.js-nav-mod');

  function openMenu(event) {
    event.preventDefault();
    if (navIsOpen) {
      $menuButton.removeClass('nav-is-open');
      $navbar.removeClass('nav-is-open');
      navIsOpen = false;
    } else {
      $menuButton.addClass('nav-is-open');
      $navbar.addClass('nav-is-open');
      navIsOpen = true;
    }
  }

  function openSearch(event) {
    event.preventDefault();
    if (searchIsOpen) {
      $searchButton.removeClass('is-open');
      $searchForm.removeClass('is-open');
      searchIsOpen = false;
    } else {
      $searchButton.addClass('is-open');
      $searchForm.addClass('is-open');
      searchIsOpen = true;
    }
  }

  function init() {
    $menuButton.on('click', openMenu);
    $searchButton.on('click', openSearch);
  }

  return {
    init: init
  };

}(jQuery));
