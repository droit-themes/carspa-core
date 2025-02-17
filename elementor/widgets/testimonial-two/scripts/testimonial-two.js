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
});
