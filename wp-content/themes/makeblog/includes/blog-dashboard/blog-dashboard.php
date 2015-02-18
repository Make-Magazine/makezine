<?php

	/**
	 * A nifty plugin for Makezine.com to better manage the volumes and content for each magazine. This combines all post types into in interface.
	 *
	 * This is a replacement to FileMaker Pro.
	 *
	 * Eventually, we could extract this into an actual plugin? Let's build it out so it is independent of the theme.
	 *
	 * @package makeblog
	 * @author Cole Geissinger <cgeissinger@makermedia.com>
	 *
	 * @version 0.1
	 * @since   0.1
	 */
	
	// Make sure we haven't already loaded our class.. 
	if ( ! class_exists( 'Make_List_Tables_Blog_Dashboard' ) && is_admin() ) {
		require_once( 'includes/class.blog-dashboard.php' );

		// Instantiate our listed tables of all blog content.
		$GLOBALS['make_blog_dashboard'] = new Make_List_Tables_Blog_Dashboard();

	}