var w;
var h;
var dw;
var dh;
var header_trigger_size = 40;

function executeFunctionByName(functionName, context /*, args */) {
  var args = [].slice.call(arguments).splice(2);
  var namespaces = functionName.split(".");
  var func = namespaces.pop();
  for(var i = 0; i < namespaces.length; i++) {
    context = context[namespaces[i]];
  }
  return context[func].apply(this, args);
}

var changeptype = function(){
    w = $(window).width();
    h = $(window).height();
    dw = $(document).width();
    dh = $(document).height();

    if($.browser.mobile === true){
      	$("body").addClass("mobile");
    }
    
    $("body").addClass(jQuery.browser.name);

    $(".main-slider.fullsize").height(h);
    $(".main-slider .slider-caption").css("marginTop",-$(".main-slider .slider-caption").height()/2);
}

$(document).ready(function(){
	FastClick.attach(document.body);
	//resizefunc.push("initscrolls");
	resizefunc.push("changeptype");
  switch_logo();

  $(window).on('scroll', function(){
    if ($(window).scrollTop() > header_trigger_size) {
      $('header nav').addClass('scrolled');
    } else {
      $('header nav').removeClass('scrolled');
    }
    switch_logo();
  });

  if($.browser.mobile !== true && ($.browser.webkit === true || $.browser.mozilla === true || $.browser.msie === true)){
    $.stellar({
      horizontalScrolling: false,
      responsive: true,
      verticalOffset: 0
    });
  }
  //SCROLL TO TOP
  $(window).scroll(function(){
    if ($(this).scrollTop() > 500) {
      $('.tothetop').addClass("showup");
    } else {
      $('.tothetop').removeClass("showup");
    }
  });
  
  //Click event to scroll to top
  $('.tothetop').click(function(){
    $('html, body').animate({scrollTop : 0},600);
    return false;
  });

  //LOAD VIDEOS
  Pace.on("done", function(){
    $("video[data-src]").each(function(){
        $(this).attr("src",$(this).data("src"));
    });
  });
  
  //TOOLTIP
  $('body').tooltip({
    selector: "[data-toggle=tooltip]",
    container: "body"
  });

  //SMART ANIMATE
  if(jQuery.browser.mobile === true){
    $(".animated-progressbar").each(function(){
        var $el = $(this).find(".progress-bar");
        var percentage = $el.data("percentage");
        $el.width(percentage+"%");
    });
  }else{
    $("[data-animate]").addClass("hideit");
    $("[data-animate]").appear();
    
    $(document).on("appear", "[data-animate]", function(){
        var $el = $(this);
        if(!$el.hasClass("hideit"))return false;
        var animation = $el.data("animate");
        var duration = $el.data("duration");
        var delay = $el.data("delay") || 0;
        
        setTimeout(function(){
          if(duration){
            $el.css("-webkit-animation-duration: "+duration+";animation-duration: "+duration+";");
          }
          $el.removeClass("hideit").addClass("animated "+animation);
          $el.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
              $el.removeClass("animated "+animation);
          });
        }, delay);
    });

    $(document).on("disappear", "[data-animate]", function(){
        var $el = $(this);
        var repeat = $el.data("repeat") || false;
        if(repeat === true)
        $el.addClass("hideit");
    });

    $(".animated-progressbar").appear();
    $(document).on("appear", ".animated-progressbar", function(){
        var $el = $(this).find(".progress-bar");
        var percentage = $el.data("percentage");
        var duration = $el.data("duration");
        var delay = $el.data("delay") || 0;
        
        setTimeout(function(){
          $el.width(percentage+"%");
        },delay);
    });
  }
  //RUN RESIZE ITEMS
  $(window).resize(debounce(resizeitems,100));
  $("body").trigger("resize");
});

var debounce = function(func, wait, immediate) {
  var timeout, result;
  return function() {
    var context = this, args = arguments;
    var later = function() {
      timeout = null;
      if (!immediate) result = func.apply(context, args);
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) result = func.apply(context, args);
    return result;
  };
}

function switch_logo(){
  if(!$(".navbar-brand .logo").data("original-src")){ 
    $(".navbar-brand .logo").data("original-src", $(".navbar-brand img").attr("src"));
  }

  if($("header").hasClass("inverted") || $("header > nav").hasClass("scrolled")){
    $(".navbar-brand .logo").attr("src", $(".navbar-brand .logo").data("dark-src"));
  }else{
    $(".navbar-brand .logo").attr("src", $(".navbar-brand .logo").data("original-src"));
  }
}

function resizeitems(){
  if($.isArray(resizefunc)){  
    for (i = 0; i < resizefunc.length; i++) {
        window[resizefunc[i]]();
    }
  }
}

function initscrolls(){
    if(jQuery.browser.mobile !== true){
	    //SLIM SCROLL
	    $('.slimscroller').slimscroll({
	      height: 'auto',
	      size: "5px"
	    });

	    $('.slimscrollleft').slimScroll({
	        height: 'auto',
	        position: 'left',
	        size: "5px",
	        color: '#7A868F'
	    });
	}
}
function toggle_slimscroll(item){
    if($("#wrapper").hasClass("enlarged")){
      $(item).css("overflow","inherit").parent().css("overflow","inherit");
      $(item). siblings(".slimScrollBar").css("visibility","hidden");
    }else{
      $(item).css("overflow","hidden").parent().css("overflow","hidden");
      $(item). siblings(".slimScrollBar").css("visibility","visible");
    }
}

function nifty_modal_alert(effect,header,text){
    
    var randLetter = String.fromCharCode(65 + Math.floor(Math.random() * 26));
    var uniqid = randLetter + Date.now();

    $modal =  '<div class="md-modal md-effect-'+effect+'" id="'+uniqid+'">';
    $modal +=    '<div class="md-content">';
    $modal +=      '<h3>'+header+'</h3>';
    $modal +=      '<div class="md-modal-body">'+text;
    $modal +=      '</div>';
    $modal +=    '</div>';
    $modal +=  '</div>';

    $("body").prepend($modal);

    window.setTimeout(function () {
        $("#"+uniqid).addClass("md-show");
        $(".md-overlay,.md-close").click(function(){
          $("#"+uniqid).removeClass("md-show");
          window.setTimeout(function () {$("#"+uniqid).remove();},500);
        });
    },100);

    return false;
}

function blockUI(item) {    
    $(item).block({
      message: '<div class="loading"></div>',
      css: {
          border: 'none',
          width: '14px',
          backgroundColor: 'none'
      },
      overlayCSS: {
          backgroundColor: '#fff',
          opacity: 0.4,
          cursor: 'wait'
      }
    });
}

function unblockUI(item) {
    $(item).unblock();
}

function toggle_fullscreen(){
    var fullscreenEnabled = document.fullscreenEnabled || document.mozFullScreenEnabled || document.webkitFullscreenEnabled;
    if(fullscreenEnabled){
      if(!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) {
          launchIntoFullscreen(document.documentElement);
      }else{
          exitFullscreen();
      }
    }
}


// Thanks to http://davidwalsh.name/fullscreen

function launchIntoFullscreen(element) {
  if(element.requestFullscreen) {
    element.requestFullscreen();
  } else if(element.mozRequestFullScreen) {
    element.mozRequestFullScreen();
  } else if(element.webkitRequestFullscreen) {
    element.webkitRequestFullscreen();
  } else if(element.msRequestFullscreen) {
    element.msRequestFullscreen();
  }
}

function exitFullscreen() {
  if(document.exitFullscreen) {
    document.exitFullscreen();
  } else if(document.mozCancelFullScreen) {
    document.mozCancelFullScreen();
  } else if(document.webkitExitFullscreen) {
    document.webkitExitFullscreen();
  }
}