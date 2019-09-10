<?php

/****************************************
	WordPress Cleanup functions - work in progress
*****************************************/
	include_once( 'wp-cleanup.php' );


/****************************************
	Theme Settings - load main stylesheet, add body classes
*****************************************/
	include_once( 'theme-settings.php' );



/****************************************
	include_onces (libraries, Classes etc)
*****************************************/
	include_once( 'includes/cpt-core/CPT_Core.php' );

	include_once( 'includes/taxonomy-core/Taxonomy_Core.php' );
    
    include_once( 'includes/table-class.php' );
	
    include_once( 'includes/theme-functions/array.php' );
    
    include_once( 'includes/theme-functions/post.php' );
    
    include_once( 'includes/theme-functions/string.php' );
    
    include_once( 'includes/table-class.php' );

/****************************************
	Functions
*****************************************/
       
	include_once( 'functions/theme.php' );

	include_once( 'functions/template-tags.php' );

	include_once( 'functions/acf.php' );
    
    include_once( 'functions/addtoany.php' );
  
	include_once( 'functions/fonts.php' );

	include_once( 'functions/scripts.php' );

	include_once( 'functions/social.php' );
    
    include_once( 'functions/sidebars.php' );

	include_once( 'functions/menus.php' );
    
    include_once( 'functions/widgets.php' );

	include_once( 'functions/gravity-forms.php' );

	include_once( 'functions/blog.php' );
    
    include_once( 'functions/events-calendar.php' );
    
    include_once( 'functions/partners.php' );
    
    include_once( 'functions/past-programming.php' );
    
    include_once( 'functions/board-staff.php' );
    
    include_once( 'functions/press.php' );
    
    include_once( 'functions/relevanssi.php' );
      
    include_once( 'functions/accent-colors.php' );
     
/****************************************
	Page Builder
*****************************************/

 
 	include_once( 'page-builder/functions.php' );

	include_once( 'page-builder/markup.php' );

	include_once( 'page-builder/layout.php' );

	include_once( 'page-builder/filters.php' );

	// Load modules
    include_once( 'page-builder/modules/cta.php' );
	//include_once( 'page-builder/modules/content-block.php' );
    //include_once( 'page-builder/modules/list.php' );
	//include_once( 'page-builder/modules/grid.php' );
 
/****************************************
	Post Types
*****************************************/

	include_once( 'post-types/cpt-partners.php' );
	include_once( 'post-types/cpt-press-releases.php' );
    //include_once( 'post-types/cpt-people.php' );
    include_once( 'post-types/cpt-past-programs.php' );


/****************************************
	Widgets
*****************************************/

//include_once( 'widgets/widget-cta.php' );