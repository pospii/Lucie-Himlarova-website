/* ========================================
* Sticky Header JS
* Search JS
* Mobile Menu JS
* Hero Slider JS
* Testimonial Slider JS
* Portfolio Slider JS
* Clients Slider JS
* Single Portfolio Slider JS
* Accordion JS
* Nice Select JS
* Date Picker JS
* Counter Up JS
* Checkbox JS
* Right Bar JS
* Video Popup JS
* Scroll Up JS
* Animate Scroll JS
* Stellar JS
* Google Maps JS
* Preloader JS
=========================================*/
(function ($) {
  "use strict";
  $(document).on("ready", function () {
    jQuery(window).on("scroll", function () {
      if ($(this).scrollTop() > 200) {
        $("#header .header-inner").addClass("sticky");
      } else {
        $("#header .header-inner").removeClass("sticky");
      }
    });

    /*====================================
			Sticky Header JS
		======================================*/
    jQuery(window).on("scroll", function () {
      if ($(this).scrollTop() > 100) {
        $(".header").addClass("sticky");
      } else {
        $(".header").removeClass("sticky");
      }
    });

    /*====================================
			Mobile Menu
		======================================*/
    $(".menu").slicknav({
      prependTo: ".mobile-nav",
      duration: 300,
      closeOnClick: true,
    });

    /*=====================================
			Counter Up JS
		======================================*/
    $(".counter").counterUp({
      delay: 20,
      time: 2000,
    });

    /*===================
			Accordion JS
		=====================*/
    $(".accordion > li:eq(0) a").addClass("active").next().slideDown();
    $(".accordion a").on("click", function (j) {
      var dropDown = $(this).closest("li").find("p");
      $(this).closest(".accordion").find("p").not(dropDown).slideUp(300);
      if ($(this).hasClass("active")) {
        $(this).removeClass("active");
      } else {
        $(this).closest(".accordion").find("a.active").removeClass("active");
        $(this).addClass("active");
      }
      dropDown.stop(false, true).slideToggle(300);
      j.preventDefault();
    });

    /*====================================
			Nice Select JS
		======================================*/
    $("select").niceSelect();

    /*===============================
			Checkbox JS
		=================================*/
    $('input[type="checkbox"]').change(function () {
      if ($(this).is(":checked")) {
        $(this).parent("label").addClass("checked");
      } else {
        $(this).parent("label").removeClass("checked");
      }
    });

    /*===============================
			Right Bar JS
		=================================*/
    $(".sidebar-menu .cross").on("click", function () {
      $(".sidebar-menu").removeClass("active");
    });


    /*=======================
			Stellar JS
		=========================*/
    $.stellar({
      horizontalOffset: 0,
      verticalOffset: 0,
    });
  });

  /*====================
		Preloader JS
	======================*/
  $(window).on("load", function () {
    $(".preloader").addClass("preloader-deactivate");
  });
})(jQuery);

function scrollToElementWithOffset(selector) {
  var element = document.querySelector(selector);
  if (element) {
    // Plynulý posun na prvek
    element.scrollIntoView({ behavior: "smooth" });

    // Odsazení o 50px nahoru po plynulém posunu
    setTimeout(function () {
      window.scrollBy(0, -150);
    }, 500); // Počkej 500ms, aby se dokončil plynulý posun
  }
}
