$(document).ready(function() {

	$('.zoom-gallery').magnificPopup({
		delegate: 'a.gallery-item',
		type: 'image',
		closeOnContentClick: false,
		closeBtnInside: false,
		mainClass: 'mfp-with-zoom mfp-img-mobile',
		image: {
			verticalFit: true,
			titleSrc: function(item) {
				return item.el.attr('title');
			}
		},
		gallery: {
			enabled: true
		},
		zoom: {
			enabled: true,
			duration: 300,
			opener: function(element) {
				return element.find('img');
			}
		}
		
	});

    $("#testimonial").owlCarousel({
	    navigation : false,
	    slideSpeed : 700,
	    paginationSpeed : 700,
	    autoPlay: 10000,
	    singleItem:true
    });

    $("#brands").owlCarousel({
	    navigation : false,
	    slideSpeed : 700,
	    paginationSpeed : 700,
	    autoPlay: 10000,
	    items:6,
		itemsDesktop : [1199,5],
		itemsDesktopSmall : [979,4]
    });

});