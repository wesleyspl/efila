$(function(){
	$('.portfolio-container').isotope({
	  itemSelector: '.project',
	  layoutMode: 'fitRows'
	});
	
	$('.portfolio-filter a').click(function() {
	  var current = $(this);
	  
	  current.siblings('a').removeClass('active');
	  current.addClass('active');
	  
	  var filterval = current.attr('data-filter');
	  var filtertarget = current.attr('data-target');
	  $(filtertarget).isotope({ filter: filterval });
	});


	$('.zoom-gallery').magnificPopup({
		delegate: 'a',
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
			duration: 300, // don't foget to change the duration also in CSS
			opener: function(element) {
				return element.find('img');
			}
		}
		
	});
});