(function ($) {
    "use strict";
   
     // STICKY ACTIVE
     var activeSticky = $('#active-sticky'),
         winD = $(window);
       winD.on('scroll',function() {
         var scroll = $(window).scrollTop(),
                 isSticky = activeSticky;
         if (scroll < 1) {
                  isSticky.removeClass("is-sticky");
         }
         else{
              isSticky.addClass("is-sticky");
         }
      });
   
      // MENU A ACTIVE JQUERY
     var pageUrl = window.location.href.substr(window.location.href.lastIndexOf("/")+1),
         aActive = $('nav ul li a');
     if (aActive.length) {
       aActive.each(function(){
         if($(this).attr("href") === pageUrl || $(this).attr("href") === '' )
         $(this).addClass("active");
       });
     }
   
     // Scroll UP
     $.scrollUp({
         scrollText: '<i class="ti-angle-up"></i>', // Text for element, can contain HTML
         scrollSpeed: 800
     });
   
     // Counter Up
     var $countUp = $('.counter');
     $countUp.counterUp({
         delay: 30,
         time: 2000
     });
   
     // AOS ACTIVATION
     AOS.init({
       disable: function ($) {
               var maxWidth = 1024;
               return window.innerWidth < maxWidth;
           },
       offset: 120, // offset (in px) from the original trigger point
       delay: 200, // values from 0 to 3000, with step 50ms
       duration: 800, // values from 0 to 3000, with step 50ms
       once: true, // whether animation should happen only once - while scrolling down
     });
   
     // VenoBox
     $('.venobox').venobox();
   
     // MAIL CHIMP AJAX ACTIVE
       var mCForm = $('#mc-form');
       mCForm.ajaxChimp({
           callback: mailchimpCallback,
           //Replace this with your own mailchimp post URL. Don't remove the "". Just paste the url inside "".
           url: "http://regaltheme.us16.list-manage.com/subscribe/post?u=9779a0e5298ed51ec0ff0a92b&amp;id=5466926a9f"
       });
       function mailchimpCallback(resp) {
           if (resp.result === 'success') {
               alert(resp.msg);
   
           } else if(resp.result === 'error') {
               alert(resp.msg);
           }
           return false;
       }
   
       // CONTACT FORM VALIDATIONS SETTINGS
       var contactForm = $('#contact_form');
       if ($('#contact_form').length) {
           contactForm.validate({
               onfocusout: false,
               onkeyup: false,
               rules: {
                   name: "required",
                   email: {
                       required: true,
                       email: true
                   }
               },
               errorPlacement: function(error, element) {
                   error.insertBefore(element);
               },
               messages: {
                   name: "What's your name?",
                   email: {
                       required: "What's your email?",
                       email: "Please, enter a valid email"
                   }
               },
   
               highlight: function(element) {
                   $(element)
                   .text('').addClass('error')
               },
   
               success: function(element) {
                   element
                   .text('').addClass('valid')
               }
           });
       }

    //    about slider
    if ($(".statistics-slider").length) {
        $(".statistics-slider").slick({
          dots: true,
          arrows: false,
          slidesToShow: 1,
          autoplay: true,
          infinite: true,
          autoplaySpeed: 3000,
          slidesToScroll: 1,
        });
      }
 
//    load more
$( document ).ready(function () {
    $(".moreBox").slice(0, 3).show();
      if ($(".blogBox:hidden").length != 0) {
        $("#loadMore").show();
      }   
      $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $(".moreBox:hidden").slice(0, 6).slideDown();
        if ($(".moreBox:hidden").length == 0) {
          $("#loadMore").fadeOut('slow');
        }
      });
    });

// load more Mobile
$( document ).ready(function () {
    $(".moreTextMobile").slice(0, 3).show();
        if ($(".awardTextMobile:hidden").length != 0) {
            $("#loadAllmobile").show();
        }   
        $("#loadAllMobile").on('click', function (e) {
            e.preventDefault();
            $(".moreTextMobile:hidden").slice(0, 6).slideDown();
            if ($(".moreTextMobile:hidden").length == 0) {
            $("#loadAllMobile").fadeOut('slow');
            }
        });
      });
    
//    load more Desktop
// $( document ).ready(function () {
    $(".moreText").slice(0, 3).show();
      if ($(".awardText:hidden").length != 0) {
        $("#loadAll").show();
      }   
      $("#loadAll").on('click', function (e) {
        e.preventDefault();
        $(".moreText:hidden").slice(0, 6).slideDown();
        if ($(".moreText:hidden").length == 0) {
          $("#loadAll").fadeOut('slow');
        }
      });
    // });
   
    let currentScroll = 0;
    let isScrollingDown = true;
    
    let tween = gsap.to(".marquee__part", {xPercent: -100, repeat: -1, duration: 10, ease: "linear"}).totalProgress(0.5);
    
    gsap.set(".marquee__inner", {xPercent: -50});
    
    window.addEventListener("scroll", function(){
      
      if ( window.pageYOffset > currentScroll ) {
        isScrollingDown = true;
      } else {
        isScrollingDown = false;
      }
       
      gsap.to(tween, {
        timeScale: isScrollingDown ? 1 : -1
      });
      
      currentScroll = window.pageYOffset
    });
    
    
    
    // gsap.set(".inpuGsap, .inpuGsa", {transformOrigin: "50% 50%"});
    // gsap.to(".inpuGsap, .inpuGsa", {duration: 1, rotation: 360}); 



        //Slider
       $('.anni-slider').owlCarousel({
           loop: true,
           nav: true,
           dots: false,
           smartSpeed: 500,
           margin: 30,
           autoplayHoverPause: true,
           autoplay: true,
           navText: [
               "<i class='flaticon-left-arrow'></i>",
               "<i class='flaticon-right-arrow'></i>"
           ],
           responsive: {
               0: {
                   items: 1
               },
               768: {
                   items: 3
               },
               1200: {
                   items: 4
               }
           }
           
       });
   
   // Odometer JS
   $('.odometer').appear(function(e) {
       var odo = $(".odometer");
       odo.each(function() {
           var countNumber = $(this).attr("data-count");
           $(this).html(countNumber);
       });
   });


//    new counter
const counters = document.querySelectorAll('.value');
const speed = 200;

counters.forEach( counter => {
   const animate = () => {
      const value = +counter.getAttribute('akhi');
      const data = +counter.innerText;
     
      const time = value / speed;
     if(data < value) {
          counter.innerText = Math.ceil(data + time);
          setTimeout(animate, 1);
        }else{
          counter.innerText = value;
        }
     
   }
   
   animate();
});



   
   
   // youtube-popup
   $('.popup-youtube').magnificPopup({
       disableOn: 320,
       type: 'iframe',
       mainClass: 'mfp-fade',
       removalDelay: 160,
       preloader: false,
       fixedContentPos: false
   });
   //  calling bootstrap carousel
   $('.carousel').carousel()
   
       // CONTACT FORM SCRIPT
       if ($('#contact_submit').length) {
         var contactSubmit = $('#contact_submit');
         contactForm.submit(function() {
             // submit the form
             if($(this).valid()){
                contactSubmit.button('loading');
                 var action = $(this).attr('action');
                 $.ajax({
                     url: action,
                     type: 'POST',
                     data: {
                         contactname: $('#contact_name').val(),
                         contactemail: $('#contact_email').val(),
                         contactsubject: $('#contact_subject').val(),
                         contactmessage: $('#contact_message').val()
                     },
                     success: function() {
                        contactSubmit.button('reset');
                        contactSubmit.button('complete');
                     },
                     error: function() {
                         contactSubmit.button('reset');
                         contactSubmit.button('error');
                     }
                 });
             // return false to prevent normal browser submit and page navigation
             } else {
                 contactSubmit.button('reset')
             }
             return false;
         });
     }
   
     // Window Load function
     jQuery(window).on('load', function(){
       // Preloader
       var preeLoad = $('#fadeout');
               preeLoad.fadeOut(1000);
     });
   
   })(jQuery);
   