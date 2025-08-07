
import Swiper from "swiper";
import { Navigation, Pagination, Autoplay, EffectFade } from "swiper/modules";
export default class SliderBlock {
  constructor() {
    this.init();
  }

  init() {
    this.setDomMap();
    this.bindEvents();
  }

  setDomMap() {
    this.dom = {
      slider: document.querySelector('.swiper'),
    };
  }

  bindEvents() {
    new Swiper(this.dom.slider, {
      modules: [Autoplay, Navigation, Pagination, EffectFade],
      loop: true,
      speed: 1000,
      autoplay: {
        delay: 5000, // 1ms delay for continuous effect
        // disableOnInteraction: false,
      },
      grabCursor: true,
      slidesPerView: 1,
      centeredSlides: true,
      spaceBetween: 10,
      // effect: 'fade',
      allowTouchMove: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
        // dynamicBullets: true,
      },
      // navigation: {
      //   nextEl: '.swiper-btn-next',
      //   prevEl: '.swiper-btn-prev',
      // },

    });
  }
}

