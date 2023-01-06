// var swiper = new Swiper(".project-swiper", {
//    slidesPerView: 1,
//    spaceBetween: 24,
//    navigation: { nextEl: ".slider-button-next", prevEl: ".slider-button-prev" },
//    breakpoints: { 640: { slidesPerView: 1, spaceBetween: 15 }, 768: { slidesPerView: 2, spaceBetween: 20 }, 1200: { slidesPerView: 3, spaceBetween: 25 } },
// });

$(document)
   .off("click", ".image-link")
   .on("click", ".image-link", function (e) {
      e.preventDefault();
      $(this)
         .magnificPopup({
            type: "image",
            mainClass: "mfp-with-zoom", // this class is for CSS animation below

            zoom: {
               enabled: true, // By default it's false, so don't forget to enable it
               duration: 300, // duration of the effect, in milliseconds
               easing: "ease-in-out", // CSS transition easing function
               opener: function (openerElement) {
                  return openerElement.is("img") ? openerElement : openerElement.find("img");
               },
            },
         })
         .magnificPopup("open");
   });
