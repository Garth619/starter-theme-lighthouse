/* Custom JS */

(function(){


  /* ------------------- JS to run after all content (html + images) is completely loaded ------------------- */

  jQuery(window).on('load', function($) {

    new WOW().init();

  });












  /* ------------------- JS to run after all html is completely loaded ------------------- */

  jQuery(document).ready(function($) {


    /* Modernizr - check if browser supports webp. if it does add class webp to html tag
     --------------------------------------------------------------------------------------- */

    Modernizr.on('webp', function(result) {});




    /* Waypoints
     --------------------------------------------------------------------------------------- */

    function createWaypoint(triggerElementId, animatedElement, className, offsetVal, functionName, reverse) {
      if(jQuery('#' + triggerElementId).length) {
        var waypoint = new Waypoint({
          element: document.getElementById(triggerElementId),
          handler: function (direction) {
            if (direction === 'down') {
              jQuery(animatedElement).addClass(className);

              if (typeof functionName === 'function') {
                functionName();
                this.destroy();
              }

            } else if (direction === 'up') {
              if (reverse) {
                jQuery(animatedElement).removeClass(className);
              }

            }
          },
          offset: offsetVal
          // Integer or percent
          // 500 means when element is 500px from the top of the page, the event triggers
          // 50% means when element is 50% from the top of the page, the event triggers
        });
      }
    }

    //Waypoint Instance - Add Class To Element
    //Template -> createWaypoint('id-name', '.class-name', 'class-to-be-added', offset-value, null, true);
    //Example -> createWaypoint('section-2', '.section-2-orange-dot', 'section-2-orange-dot-active', 500, null, true);

    //Waypoint Instance - Call Function
    //Template -> createWaypoint('id-name', null, null, 0, function-name, true);
    //Example -> createWaypoint('section-2', null, null, 0, test, true);




    /* Smooth Scroll down to section on click (<a href="#id_of_section_to_be_scrolled_to">)
      --------------------------------------------------------------------------------------- */

    jQuery(function() {
      jQuery('a[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
          var target = jQuery(this.hash);
          target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
          if (target.length) {
            jQuery('html, body').animate({
              scrollTop: target.offset().top
            }, 1000);
            return false;
          }
        }
      });
    });





    /* Long Page Title - If the page/blog title (h1) is very long, add a class so we can make the font size smaller.
      --------------------------------------------------------------------------------------- */

    if ( jQuery(".single .default-main h1").text().length > 28 ) {
      jQuery(".single .default-main h1").addClass("page-title-long");
    }

    if ( jQuery(".page-template-default .default-main h1").text().length > 28 ) {
      jQuery(".page-template-default .default-main h1").addClass("page-title-long");
    }





    /* Wistia - Call function when script needs to be loaded either by hover or waypoints
     --------------------------------------------------------------------------------------- */

    function wistiaLoad() {
      jQuery.getScript('https://fast.wistia.com/assets/external/E-v1.js', function(data, textStatus, jqxhr) {
        console.log('wistia load:', textStatus); // Success
      });
    }

    // examples:

    // jQuery(".banner-box-1").one("mouseenter", function(e){
    //   wistiaLoad();
    // });

    // createWaypoint('section-1', null, null, '100%', wistiaLoad, false)







    /* Load Images - Call function when you reach the a section with images using waypoints
       BG image - <div data-src=""></div>   ,   Image - <img data-src="">
      --------------------------------------------------------------------------------------- */

    function loadImages() {
      // images
      jQuery('img').each(function () {
        if (jQuery(this).attr('data-src')) {
          var img = jQuery(this).data('src');
          jQuery(this).attr('src', img);
        }
      });

      // background images
      jQuery('div, section').each(function () {
        if (jQuery(this).attr('data-src')) {
          var backgroundImg = jQuery(this).data('src');
          jQuery(this).css('background-image', 'url(' + backgroundImg + ')');
        }
      });

      console.log('images loaded');
    }

    // createWaypoint('section-1', null, null, '100%', loadImages, false)




    /* Slick Carousel ( http://kenwheeler.github.io/slick/ )
     --------------------------------------------------------------------------------------- */

    jQuery('.class-name').slick({
      autoplay: true,
      dots: true,
      slidesToShow: 4,
      sidesToScroll: 1,
      arrows: true,
      prevArrow: '#slick-arrow-left',
      nextArrow: '#slick-arrow-right',
      responsive: [{
        breakpoint: 700,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1
        }
      }, {
        breakpoint: 550,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      }]
    });



    /* Run Functions on Resize if needed
      --------------------------------------------------------------------------------------- */

    // var resizeTimerInternal;
    // jQuery(window).on('resize', function() {
    //
    //   clearTimeout(resizeTimerInternal)
    //
    //   resizeTimerInternal = setTimeout(function() {
    //     //add functions here to fire on resize
    //   }, 100)
    //
    // });






    /* Accordion Dropdown Menu Template if needed. (for mobile menu and sidebar menu)
      --------------------------------------------------------------------------------------- */

    // jQuery('#menu-sidebar-menu > .menu-item-has-children > .sub-menu').addClass('first-sub');
    // jQuery('#menu-sidebar-menu .menu-item-has-children .sub-menu .menu-item-has-children .sub-menu').addClass('last-sub');
    //
    // jQuery('#menu-sidebar-menu > .menu-item-has-children a').click(function() {
    //   jQuery(this).siblings('.first-sub').slideToggle();
    // });
    //
    // jQuery('#menu-sidebar-menu > .menu-item-has-children > .first-sub > .menu-item-has-children a').click(function() {
    //   jQuery(this).siblings('.last-sub').slideToggle();
    // });






    /* End Document Ready
     --------------------------------------------------------------------------------------- */

  });



}());
