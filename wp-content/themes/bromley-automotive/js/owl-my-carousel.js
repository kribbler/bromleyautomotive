jQuery(document).ready(function($) {
      $("#owl-home_slider").owlCarousel({

      navigation : true,
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem : true,
      transitionStyle: "fadeUp",
      navigationText: ['<','>']
      // "singleItem:true" is a shortcut for:
      // items : 1, 
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false

      });

      $("#owl-home_slider").data("owlCarousel").transitionTypes("fadeUp");

      $("#owl-home_testimonials").owlCarousel({

      navigation : true,
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem : true,
      navigationText: ['<','>'],
      loop: true
      // "singleItem:true" is a shortcut for:
      // items : 1, 
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false

      });

      $(".testimonial-container").owlCarousel({
            navigation: true,
            singleItem: true,
            navigationText: ['<','>'],
            loop: true
      });

      $('.back_to_top').click(function(){
            $('html, body').animate({scrollTop : 0},800);
            return false;
      });

      
});