$(function () {

  // Menu fix
  var menu = $('.nav_bar').offset().top;

  $(window).scroll(function () {
    var scroll = $(this).scrollTop();

    if (scroll > 100) {
      $('.nav_bar').addClass('menu_fix');
    } else {
      $('.nav_bar').removeClass('menu_fix');
    }
  });


  // menu bar
  $('.menu_bar').click(function () {
    $('.short_head').css('right', '0');
  });
  $('.menu_close').click(function () {
    $('.short_head').css('right', '-320px');
  });

  // side bar
  $('.cart_bar').click(function () {
    $('.right_cart').css('right', '0');
  });
  $('.cart_close').click(function () {
    $('.right_cart').css('right', '-100%');
  });

  var swiper = new Swiper(".mySwiper", {
    spaceBetween: 10,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesProgress: true,
  });
  var swiper2 = new Swiper(".mySwiper2", {
    spaceBetween: 10,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    thumbs: {
      swiper: swiper,
    },
  });



  // input number
  jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
  jQuery('.quantity').each(function () {
    var spinner = jQuery(this),
      input = spinner.find('input[type="number"]'),
      btnUp = spinner.find('.quantity-up'),
      btnDown = spinner.find('.quantity-down'),
      min = input.attr('min'),
      max = input.attr('max');

    btnUp.click(function () {
      var oldValue = parseFloat(input.val());
      if (oldValue >= max) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue + 1;
      }
      spinner.find("input").val(newVal);
      spinner.find("input").trigger("change");
    });

    btnDown.click(function () {
      var oldValue = parseFloat(input.val());
      if (oldValue <= min) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue - 1;
      }
      spinner.find("input").val(newVal);
      spinner.find("input").trigger("change");
    });

  });







});