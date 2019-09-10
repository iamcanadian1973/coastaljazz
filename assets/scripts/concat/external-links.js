(function (document, window, $) {

	'use strict';

	// Open external links in new window (exclue scv image maps, email, tel and foobox)

	$('a').not('svg a, [href*="mailto:"], [href*="tel:"], [class*="foobox"]').each(function () {
		var isInternalLink = new RegExp('/' + window.location.host + '/');
		if ( ! isInternalLink.test(this.href) ) {
			$(this).attr('target', '_blank');
		}
	});
    
    // PDF's
    /*
    $('a[href$=".pdf"]').each(function () {
		$(this).attr('target', '_blank');
	});
    */
    
    // Open files in new window
    $('a').filter(function() {
        return this.href.match(/\.([0-9a-z]+)(?:[\?#]|$)/i);
    }).prop('target', '_blank');
	
    

}(document, window, jQuery));

