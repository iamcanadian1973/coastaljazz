export default {
	init() {
        
        var $all_oembed_videos = $("iframe[src*='youtube'], iframe[src*='vimeo']");
        
        $all_oembed_videos.each(function() {
        
            var _this = $(this);
            
            if (_this.parent('.embed-container').length === 0) {
              _this.wrap('<div class="embed-container"></div>');
            }
            
            _this.removeAttr('height').removeAttr('width');
        
        });
        
	},
};
