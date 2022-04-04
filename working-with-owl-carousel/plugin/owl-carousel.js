jQuery(document).ready(function() {

    var owlCarousel1 = jQuery('div.owl-carousel');
        owlCarousel1.owlCarousel({
        margin: 0,
        nav: true,
        loop: true,
        dots:false,
        autoplay:true,
        autoplaySpeed: 1200,
        responsive: { 0: { items: 1 }, 768: { items: 3 } },
        navText:[ '<img src="" alt="arrow-left" />', '<img src="" alt="arrow-right" />' ]
    });

});