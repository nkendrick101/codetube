// Page Transitions
if($('.page-preloading').length) {
	$('a:not([href^="#"])').on('click', function(e) {
    if($(this).attr('class') !== 'video-popup-btn' && $(this).attr('class') !== 'gallery-item' && $(this).attr('class') !== 'ajax-post-link' && $(this).attr('class') !== 'read-more ajax-post-link') {
		console.log($(this).attr('class'));
      e.preventDefault();
      var linkUrl = $(this).attr('href');
      $('.page-preloading').addClass('link-clicked');
      setTimeout(function(){
        window.open(linkUrl , '_self');
      }, 100);
    }
  });
}

;(function() {
  window.onload = function() {
    var preloading = document.querySelector('.page-preloading');
    preloading.classList.add('loading-done');
  };
})();
