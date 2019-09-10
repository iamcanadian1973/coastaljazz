
if( jQuery('.blog #main .row').length ) {
    var infScroll = new InfiniteScroll( '.blog #main .row', {
      // defaults listed
    
      path: '.blog nav.posts-navigation .nav-previous a',
      // REQUIRED. Determines the URL for the next page
      // Set to selector string to use the href of the next page's link
      // path: '.pagination__next'
      // Or set with {{#}} in place of the page number in the url
      // path: '/blog/page/{{#}}'
      // or set with function
      // path: function() {
      //   return return '/articles/P' + ( ( this.loadCount + 1 ) * 10 );
      // }
    
      append: '#main .row article.post',
      // REQUIRED for appending content
      // Appends selected elements from loaded page to the container
    
      checkLastPage: true,
      // Checks if page has path selector element
      // Set to string if path is not set as selector string:
      //   checkLastPage: '.pagination__next'
    
      prefill: false,
      // Loads and appends pages on intialization until scroll requirement is met.
    
      responseType: 'document',
      // Sets the type of response returned by the page request.
      // Set to 'text' to return flat text for loading JSON.
    
      outlayer: false,
      // Integrates Masonry, Isotope or Packery
      // Appended items will be added to the layout
    
      scrollThreshold: 400,
      // Sets the distance between the viewport to scroll area
      // for scrollThreshold event to be triggered.
    
      elementScroll: false,
      // Sets scroller to an element for overflow element scrolling
    
      loadOnScroll: false,
      // Loads next page when scroll crosses over scrollThreshold
    
      history: 'append',
      // Changes the browser history and URL.
      // Set to 'push' to use history.pushState()
      //    to create new history entries for each page change.
    
      historyTitle: true,
      // Updates the window title. Requires history enabled.
    
      hideNav: 'nav.posts-navigation',
      // Hides navigation element
    
      status: undefined,
      // Displays status elements indicating state of page loading:
      // .infinite-scroll-request, .infinite-scroll-load, .infinite-scroll-error
      // status: '.page-load-status'
    
      button: '.view-more-button',
      // Enables a button to load pages on click
      // button: '.load-next-button'
    
      //onInit: undefined,
      // called on initialization
      // useful for binding events on init
      onInit: function() {
         //this.on( 'append', function() {...})
         jQuery('.blog #primary').append('<div class="text-center"><button class="button view-more-button">Load more</button></div>');
       },
    
      debug: false,
      // Logs events and state changes to the console.
    })

}