//////Sidebar height//////////////////
$(document).ready(function() {
  function setHeight() {
    windowHeight = $(window).innerHeight();
    $('.sidebar').css('min-height', windowHeight);
  };
  setHeight();
  
  $(window).resize(function() {
    setHeight();
  });
});

// disable  Browser Back Button
// history.pushState({ page: 1 }, "Title 1", "#no-back");
// window.onhashchange = function (event) {
//   window.location.hash = "no-back";
// };
$('body').append('<div id="backToTop" class="btn btn-lg"><span class="glyphicon glyphicon-chevron-up"></span></div>');
    $(window).scroll(function () {
		if ($(this).scrollTop() <= 200) {
			$('#backToTop').fadeOut();
		} else {
			$('#backToTop').fadeIn();
		}
	}); 
$('#backToTop').click(function(){
    $("html, body").animate({ scrollTop: 0 }, 600);
    return false;
});
