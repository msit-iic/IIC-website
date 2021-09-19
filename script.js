// store the element in a variable
var element = $('.header-sticky'),
    visible = false;

// on scroll
$(window).scroll(function() {

  /**
   * store the scroll distance in px
   * from the top of the viewport
   */
  var scroll = $(window).scrollTop();

  /**
   * if the scroll is greater than or equal
   * to 10px add a class of .is-sticky to the element
   * otherwise we're less than 10px from the top
   * of the document and therefore don't want
   * the element to have the .is-sticky class
   */
  if(scroll >= 200) {
    if(!visible) {
      element.addClass('is-sticky');
      visible = true;
    }
  } else {
    if(visible) {
      element.removeClass('is-sticky');
      visible = false;
    }
  }
});


function myFunction() {
    var x = document.querySelector('.slicknav_nav');
    if (x.style.display === "block") {
      x.style.display = "none";
    } else {
      x.style.display = "block";
    }
  }