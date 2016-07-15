  WebFont.load({ google: {families: ['Muli:300,400,300italic,400italic:latin']}}); 
  var myfonts;
  myfonts = SiteParameters.theme_fonts.split(",");
  var i;
  for (i = 0; i < myfonts.length; i++) {
  WebFont.load({ google: {families: [myfonts[i]+':400,300,500,600,700,800,900:'+SiteParameters.font_char]}}); 
  }
  WebFont.load({ google: {families: ['Lora:400,700,400italic,700italic:latin,latin-ext']}}); 
(function($) {
    "use strict";
 
  // Header Fixed
  // ---------------

  function fixedhead() {
    if ( $('.enable_fixhead').length ) {
    if ( !$('.header-fixed').length && !$('.header-bottom').length ) {
      $('.bliccaThemes-waypoint').css('marginTop', $('.bliccaThemes-header').outerHeight(true) );
    }  
    var head = $( '#bliccaThemes_header' );
    var wayoffset = '-1px';
    if ( $('.header-bottom').length ) {
    wayoffset =  $('.bliccaThemes-header').outerHeight(true)+'px'; 
    }
    $( '.bliccaThemes-waypoint' ).each( function(i) {"use strict";
        var el = jQuery( this ),
            animClassDown = el.data( 'animateDown' ),
            animClassUp = el.data( 'animateUp' );
     
        el.waypoint( function( direction ) {
            if( direction === 'down' && animClassDown ) {
                head.removeClass('off-sticky');
                head.addClass('on-sticky');
            }
            else if( direction === 'up' && animClassUp ){
                head.removeClass('on-sticky');
                head.addClass('off-sticky');
            }
        }, { offset: wayoffset } );
    } );

    }
  }



  // Dropdown
  //----------
  function bliccaThemes_themes_dropdown() {
        // Mobile Menu
          var browser_width = $( window ).width();
          if ( browser_width < 992 ) {
             $( ".navbar-collapse li:not(.menu-item-has-children) a" ).click(function() {
               $( ".bliccaThemes-scroll" ).removeClass( "in", 200 );
             });
          }
      
      $( '.menu-item-has-children' ).each( function() {
          $(this).addClass('dropdown');
      });
      if ( browser_width > 992 ) {
        $('ul.nav li.dropdown').hover(function() {
          $(this).find('>.dropdown-menu').stop(true, true).delay(50).fadeIn(400);
        }, function() {
          $(this).find('>.dropdown-menu').stop(true, true).delay(300).fadeOut(400);
        });
      }
    
      else {
        $('ul.nav li.dropdown>a').click(function( event ) {
          event.preventDefault();          
          var clickedmenu = $(this).parent();
          clickedmenu.find('>.dropdown-menu').toggle();
  
        });

      }
  }
  // Mega Menu
  //----------
  function bliccaThemes_megamenu() {
    $( ".multi .dropdown-menu .dropdown-menu" ).removeClass( "dropdown-menu" );
  }
  // Post Slider
  // ======================
  function bliccaThemes_themes_postslider() {
    $('.post-slider').flexslider({
        controlNav: false,             
        directionNav: true,
        smoothHeight: true, 
        animation: "fade",
        animationLoop: true,
        itemWidth: 573,
        itemMargin: 0,
        minItems: 1,
        maxItems: 1,
        prevText: "",
        nextText: ""
    });
  }
  function bliccaThemes_themes_featuredlider() {
    $('.featured-slider').flexslider({
        selector: ".featured-posts > .featured-item", 
        controlNav: false,             
        directionNav: true,
        smoothHeight: true, 
        animation: "slide",
        animationLoop: true,
        itemWidth: 1920,
        itemMargin: 0,
        minItems: 1,
        maxItems: 1,
        move: 1,
        prevText: "",
        nextText: ""
    });
  }   

  // Instagram
  
  function bliccaThemes_themes_instagram() {
    $('.instagram-slider').flexslider({
        selector: ".instagram-pics > .instagram-pic", 
        controlNav: false,             
        directionNav: true,
        smoothHeight: true, 
        animation: "fade",
        animationLoop: true,
        itemWidth: 250,
        itemMargin: 0,
        minItems: 1,
        maxItems: 1,
        move: 1,
        prevText: "",
        nextText: ""
    });    
    
  }
  function bliccaThemes_themes_dribble() {
    $('.dribbbles').flexslider({
        selector: ".dribbbles-slides > .group", 
        controlNav: false,             
        directionNav: true,
        smoothHeight: true, 
        animation: "fade",
        animationLoop: true,
        itemWidth: 250,
        itemMargin: 0,
        minItems: 1,
        maxItems: 1,
        move: 1,
        prevText: "",
        nextText: ""
    });    
    
  }
  function bliccaThemes_themes_event_slider() {
    $('.bt-events-slider').flexslider({
        selector: ".bt-events-container > .bt-event", 
        controlNav: false,             
        directionNav: true,
        smoothHeight: false, 
        animation: "slide",
        animationLoop: true,
        itemWidth: 1140,
        itemMargin: 0,
        minItems: 1,
        maxItems: 1,
        move: 1,
        prevText: "",
        nextText: "",
        start: function(slider){
        $('.bt-events-slider').resize();
        }
    });
  }
  function bliccaThemes_themes_testimonial() {  
  $('.happyclientslider').flexslider({
    directionNav: false,
    animation: "fade",
    animationLoop: true,
    itemWidth: 684,
    itemMargin: 0,
    minItems: 1,
    maxItems: 1
  });
  }  
  function bliccaThemes_countdown() {
  if ( $(".count-down").length ) {
  
    $(".bt-event .count-down").each( function() {
        
        // set the date we're counting down to
        var target_date = new Date($(this).data('countdown')).getTime();
         
        // variables for time units
        var days, hours, minutes, seconds, counttext;
        
        
        // get tag element
        var countdown = $(this);
         
        // update the tag with id "countdown" every 1 second
        setInterval(function () {
         
            // find the amount of "seconds" between now and target
            var current_date = new Date().getTime();
            var seconds_left = (target_date - current_date) / 1000;
         
            // do some time calculations
            days = parseInt(seconds_left / 86400);
            seconds_left = seconds_left % 86400;
             
            hours = parseInt(seconds_left / 3600);
            seconds_left = seconds_left % 3600;
             
            minutes = parseInt(seconds_left / 60);
            seconds = parseInt(seconds_left % 60);
             
            // format countdown string + set tag value
            countdown.html('<div class="count-box"><p>' + days + ' <span>days</span> ' + hours + ' <span>hours</span> '
            + minutes + ' <span>minutes</span> ' + seconds + '</p></div>');
         
        }, 1000);     
    });
    
  }
  }  
  // Masonry Blog
  // ======================
  function blog_masonry() {
    
    var blogGutter = 0;
    if ( $( window ).width() > 1200 ) { 
        blogGutter = 60;
    }
    
    else {
        blogGutter = 25; 
    }
    
    if ( $(".masonry_3").length &&  $( window ).width() > 1200 ) {
        blogGutter = 43;      
    }
    
    if ( $(".masonry_3").length &&  $( window ).width() < 1200 ) {
        blogGutter = 25;      
    }
  
    var container = $ ( ".masonry-blog" );
  
    container.imagesLoaded( function(){ 
          container.isotope({
            // main isotope options
            itemSelector: '.post-item',
                    
            // options for masonry layout mode
            masonry: {
                columnWidth: '.post-item',
                transitionDuration: '0.8s',
                gutter: blogGutter
                }
            });
          });
  
  }  
  // SOCIAL SHARE
  // ======================
  function bliccaThemes_themes_share() {
 
  $('.share-button').click(function() {
  var socialsdiv = $(this).next(".socials");
        
  socialsdiv.toggle("slow");
  });
    
  $( document ).on("click", ".facebook-share", function(){
      var url = $(this).attr('data-url');
      window.open( 'https://www.facebook.com/sharer/sharer.php?u='+url, "Facebook", "height=400,width=680,scrollbars=0,resizable=0,menubar=0,toolbar=0,status=0,location=0" );
      return false;
  });
  
  $( document ).on("click", ".twitter-share", function(){
      var url = $(this).attr('data-url'),
      title = $(this).attr('data-title');
      window.open( 'http://twitter.com/home?status='+title+' '+url, "Twitter", "height=400,width=680,scrollbars=0,resizable=0,menubar=0,toolbar=0,status=0,location=0" );
      return false;
  });
  
  $( document ).on("click", ".google-share", function(){
      var url = $(this).attr('data-url');
      window.open( 'https://plus.google.com/share?url='+url, "GooglePlus", "height=600,width=680,scrollbars=0,resizable=0,menubar=0,toolbar=0,status=0,location=0" );
      return false;
  });
    
  $( document ).on("click", ".pinterest-share", function(){
      var url = $(this).attr('data-url'),
      image = $(this).attr('data-img'),
      title = $(this).attr('data-title');
      window.open( 'http://pinterest.com/pin/create/button/?url=' + url + '&media=' + image + '&description=' + title, "Pinterest", "height=320,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" );
      return false;
  });
    
  $( document ).on("click", ".tumblr-share", function(){
      var url = $(this).attr('data-url'),
          title = $(this).attr('data-title');
      var newurl = url.split("http://");
      window.open( 'http://tumblr.com/share?s=&v=3&t=' + title + '&u=' + newurl[1] );
      return false;
  });

  $( document ).on("click", ".stumbleupon-share", function(){
      var url = $(this).attr('data-url'),
          title = $(this).attr('data-title');

      window.open( 'http://www.stumbleupon.com/submit?url=' + url + '&title=' + title );
      return false;
  });

  $( document ).on("click", ".linkedin-share", function(){
      var url = $(this).attr('data-url'),
          title = $(this).attr('data-title');

      window.open( 'http://www.linkedin.com/shareArticle?url=' + url + '&title=' + title );
      return false;
  });     
    
  } 
  
  // Parallax
  // ======================
  function bliccaThemes_parallax() {
    $.stellar({
        horizontalScrolling: false,
        scrollProperty: 'scroll',
        positionProperty: 'position',
      });
  }
  
  //SCROLL TO TOP
  // ====================== 
  $(window).scroll(function(){
    if ($(this).scrollTop() > 1000) {
      $('.scrollToTop').fadeIn();
    } else {
      $('.scrollToTop').fadeOut();
    }
  });

  // ANIMATION
  // ======================
  function bliccaThemes_animation() {
     var myclasses;
     var myclass;
     var ekclass;
     $('.blind').waypoint(function() {
     myclasses = this.className;
     myclass = myclasses.split(" ");
     ekclass = myclass[0].split("-");
      if ( ekclass[0] !== "no_animation" && myclass[1] === "blind") {
                  $(this).addClass('v '+ekclass[0]);
                                                     }
  }, { offset: '70%' });
  }

  // Accordion Menu
  // ==============
  $('.bt-accordion-itemTitle').click(function() {
    $(this).toggleClass("closeit");  
    $(this).next('.bt-accordion-itemContent').slideToggle("slow");
    setTimeout(function(){
                 $(this).next('.bt-accordion-itemContent').toggleClass("openit");
                  
                  }, 400);
    
  });  
  // Counter
  // =======
  
  function bliccaThemes_counter() {

       $('.bliccaThemes-count>.timer').waypoint(function() {
       $('.timer').countTo();
       }, { offset: '90%', triggerOnce: true });
      
  }
 // Restaurant Menu 
 // --------------- 
  function blicca_themes_menu_filter() {
    if( $('.bliccaThemes-menu-grid').length ) { 
        $( ".bt-menu-items" ).each(function() {       
             var foodgutter = 30;
             if ( $( window ).width() > 1200 ) { 
                foodgutter = 22;
             }
             else {
                foodgutter = 22; 
             }
         
            
          var container = $(this);
         

            // Start
            container.imagesLoaded( function(){ 
                container.isotope({
                // main isotope options
                itemSelector: '.bt-menu-item-s1',
                
                // options for masonry layout mode
                masonry: {
                columnWidth: '.bt-menu-item-s1',
                transitionDuration: '0.8s',
                gutter: foodgutter
                }
              });
             });

             $('.bt-menu-filter').on( 'click', 'a', function() {
                    var nav=$('.bt-menu-filter');
                    var menuactive = $(this).attr('href');
                    var category = $(this).attr('href').replace('#','');
                    
                    nav.find('li').removeClass('active'); /* Portfolio menu remove active */
                    nav.find('li.slug-'+category).addClass('active');
                var filterValue = $(this).attr('data-filter');
                container.isotope({ filter: filterValue, transitionDuration: '0.8s' });
              });    
            // Finish
        });
    }
  }
  // Load Function
  // ====================== 
  $(window).load(function() {
      bliccaThemes_themes_postslider();
      bliccaThemes_themes_featuredlider();
      bliccaThemes_themes_instagram();
      bliccaThemes_themes_dribble();
      bliccaThemes_themes_event_slider();
      bliccaThemes_themes_testimonial();
      /* bliccaThemes Loader */
      $('#bliccaThemes-loader').fadeOut('slow',function(){$(this).remove();});
  });
  

  
  // READY FUNCTION
  // ====================== 
  $(document).ready(function(){
    blicca_themes_menu_filter();
    if ( jQuery( window ).width() > 1023 ) { 
    bliccaThemes_animation();
    }
    fixedhead();
    bliccaThemes_megamenu()
    bliccaThemes_counter();
    $( ".bliccaThemes-header-search i" ).click(function() {
      $( ".bliccaThemes-header-search" ).toggleClass( "acik" );
    });
    blog_masonry();
    bliccaThemes_themes_dropdown();
    bliccaThemes_themes_share();
    // Comment Class
    $('#commentrespond  input#submit').addClass('buton buton_rounded_corners buton-3 buton-small');
    if ( jQuery( window ).width() > 1024 ) { 
    bliccaThemes_parallax();
    }
    $("a[data-rel^='prettyPhoto']").prettyPhoto({
    social_tools: ''
    });
    if ( jQuery( window ).width() > 992 ) {     
    bliccaThemes_countdown();
    }
  });
  
})(jQuery);