let mySwiper = new Swiper(".mySwiper", {
  effect: "flip",
  grabCursor: false,
  loop: true,
  autoplay: {
    delay: 5000,
    disableOnInteraction: false,
  }
});

let slideNews = new Swiper(".slide-news", {
  slidesPerView: 3,
  spaceBetween: 20,
  breakpoints: {
          360: {
            slidesPerView: 1,
          },
          769: {
            slidesPerView: 3,
          },
        },
  loop: true,
  autoplay: {
    delay: 5000,
    disableOnInteraction: false,
  },
});

let mitra = new Swiper(".slide-mitra", {
  spaceBetween: 20,
  breakpoints: {
          360: {
            slidesPerView: 1,
          },
          769: {
            slidesPerView: "auto",
          },
        },
  loop: true,
  autoplay: {
    delay: 5000,
    disableOnInteraction: false,
  },
});

let ratings = new Swiper(".slide-ratings", {
  spaceBetween: 20,
  centeredSlides: false,
  breakpoints: {
          768: {
            slidesPerView: 1,
          },
          1024: {
            slidesPerView: 2,
          },
        },
  loop: true, 
  autoplay: {
    delay: 5000,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});

$('.accordion-items').click(function () {
  $('.accordion-items').each(function (i) {
    $($('.accordion-items')[i]).removeClass('active')
  })
  $(this).toggleClass('active')
})

$('.file input').change(function (event) {
  let fileTmp = URL.createObjectURL(event.target.files[0]);
  $(this).parent().addClass('active')
  $(this).prev().attr('src', fileTmp)
})
$('.files input').change(function (event) {
  $('.files .infos p').html($(this).val().split("\\").pop())
})

document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')