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

//ideathon popup
$(document).ready(function() {	

  var id = '#dialog';
    
  //Get the screen height and width
  var maskHeight = $(document).height();
  var maskWidth = $(window).width();
    
  //Set heigth and width to mask to fill up the whole screen
  $('#mask').css({'width':maskWidth,'height':maskHeight});
  
  //transition effect
  $('#mask').fadeIn(500);	
  $('#mask').fadeTo("slow",0.9);	
    
  //Get the window height and width
  var winH = $(window).height();
  var winW = $(window).width();
                
  //Set the popup window to center
  $(id).css('top', '60%');
  $(id).css('left', '50%');
  $(id).css('transform', 'translate(-50%,-50%);');
    
  //transition effect
  $(id).fadeIn(2000); 	
    
  //if close button is clicked
  $('.window .close').click(function (e) {
  //Cancel the link behavior
  e.preventDefault();
  
  $('#mask').hide();
  $('.window').hide();
  });
  
  //if mask is clicked
  $('#mask').click(function () {
  $(this).hide();
  $('.window').hide();
  });
    
  });







