/** @format */

jQuery(function ($) {
  "use strict";

  var slider = new Swiper(".swiper-container.feedback-slider", {
    speed: 2500,
    slidesPerView: 1,
    centeredSlides: false,
    loop: true,
    spaceBetween: 30,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  });

  // var thumbs = new Swiper(".swiper-container.gallery-thumbs", {
  //   slidesPerView: 3,
  //   spaceBetween: 10,
  //   centeredSlides: true,
  //   loop: true,
  //   slideToClickedSlide: true,
  // });
  // slider.controller.control = thumbs;
  // thumbs.controller.control = slider;
});
