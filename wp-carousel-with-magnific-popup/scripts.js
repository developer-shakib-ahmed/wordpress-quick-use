/* Owl Carousel Scripts */ 
jQuery(document).ready(function() {

  let owlCarousel1 = jQuery('div#otribeTestimonials div.owl-carousel');
      owlCarousel1.owlCarousel({
      margin: 30,
      nav: true,
      loop: true,
      dots:true,
      autoplay:false,
      autoplaySpeed: 1200,
      responsive: { 0: { items: 1 }, 768: { items: 3 } },
      navText:[ '<img src="/wp-content/uploads/2022/06/arrow-left.png" alt="arrow-left" />', '<img src="/wp-content/uploads/2022/06/arrow-right.png" alt="arrow-right" />' ]
  });

  jQuery('.testimonial-popup').magnificPopup({
    type: 'inline',
    preloader: false,
  });

});