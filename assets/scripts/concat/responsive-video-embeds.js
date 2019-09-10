(function (document, window, $) {

	'use strict';

	// Responsive video embeds
	var $all_oembed_videos = $("iframe[src*='youtube'], iframe[src*='vimeo']");

	$all_oembed_videos.each(function() {

		var _this = $(this);

		if (_this.parent('.embed-container').length === 0) {
		  _this.wrap('<div class="embed-container"></div>');
		}

		_this.removeAttr('height').removeAttr('width');

 	});
    
    
    $(window).on('load resize', function() {
      
      $('iframe[src*="embed.spotify.com"]').each( function() {
        $(this).css('width', $(this).parent().css('width'));
        $(this).attr('src', $(this).attr('src'));
        $(this).removeClass('loaded');
        
        $(this).on('load', function(){
          $(this).addClass('loaded');
        });
      });
      
      $('iframe[src*="open.spotify.com"]').each( function() {
        $(this).css('width', $(this).parent().css('width'));
        $(this).attr('src', $(this).attr('src'));
        $(this).removeClass('loaded');
        
        $(this).on('load', function(){
          $(this).addClass('loaded');
        });
      });
      
    });
    

}(document, window, jQuery));

