<?php


/**
 * Centeralize all of our query variables into an easy to use array
 * @return array
 */
function make_get_query_vars() {
	$query_vars = array(
		'paged' 		 => ( isset( $_GET['paged'] ) ) ? absint( $_GET['paged'] ) : 1,
		'search' 		 => ( isset( $_GET['s'] ) ) ? sanitize_text_field( $_GET['s'] ) : '',
		'filter' 		 => ( isset( $_GET['filter'] ) ) ? sanitize_text_field( $_GET['filter'] ) : '',
		'volume' 		 => ( isset( $_GET['volume'] ) && $_GET['volume'] != 'all' ) ? sanitize_text_field( $_GET['volume'] ) : '',
		'post_status' 	 => ( isset( $_GET['post_status'] ) && $_GET['post_status'] != '' && $_GET['post_status'] != 'all' ) ? sanitize_text_field( $_GET['post_status'] ) : make_post_statuses(),
		'section' 		 => ( isset( $_GET['section'] ) && $_GET['section'] != 'all' ) ? sanitize_text_field( $_GET['section'] ) : '',
		'tag'			 => ( isset( $_GET['tag'] ) && $_GET['tag'] != '' ) ? sanitize_text_field( $_GET['tag'] ) : '',
		'posts_per_page' => ( isset( $_GET['posts_per_page'] ) ) ? absint( $_GET['posts_per_page'] ) : 40,
	);

	return $query_vars;
}


/**
 * Handles our Ajax requests for the custom screen options. Called from dashboard-scripts.js. Only runs when a user is logged in (hence the wp_ajax_* action);
 * @return [type] [description]
 */
function make_magazine_dashboard_ajax_save_user_screen_options() {

	// Ensure that users with a role of Editor or higher can save these options
	if ( ! current_user_can( 'edit_posts' ) )
		return;

	// Make sure everything is as it's supposed to.
	if ( isset( $_POST['submission'] ) && $_POST['submission'] == 'submit-dashboard-screen-options' && wp_verify_nonce( $_POST['nonce'], 'dashboard-screen-save' ) ) {

		// Turn our query string into an array
		parse_str( sanitize_text_field( $_POST['data'] ), $data );

		$user_id = get_current_user_id();
		$updates = update_user_attribute( $user_id, 'metaboxhidden_mag_dashboard', $data );
	}
}
add_action( 'wp_ajax_mag_dash_screen_opt', 'make_magazine_dashboard_ajax_save_user_screen_options' );


/**
 * Function to count the statuses of Maker Faire applications
 */
function make_count_post_status() {
	$query_vars = make_get_query_vars();
	$results = array();
	$output = '';

	$post_type = array(
		'All'	   => 'all',
		'Projects' => 'projects', 
		'Articles' => 'magazine', 
		'Reviews'  => 'review', 
		'Errata'   => 'errata', 
		'Volume'   => 'volume',
	);
	foreach ( $post_type as $k => $type ) {
		$args = array( 
			'post_type'		 => ( $type == 'all' ) ? array( 'projects', 'magazine', 'review', 'errata', 'volume' ) : $type,
			'post_status'	 => $query_vars['post_status'],
			'post_parent'	 => $query_vars['volume'],
			'section'		 => $query_vars['section'],
			'tag'			 => str_replace( ' ', '-', $query_vars['tag'] ), // Is there a better way to do this? If we search for a tag with spaces, we need those converted to dashes...
			'posts_per_page' => 0,
			'return_fields'	 => 'ids',
			's'				 => $query_vars['search'],	
		);
		$query = new WP_Query( $args );

		$query_results = array(
			'post_type'  => $k,
			'type_uri'   => $type,
			'post_count' => $query->found_posts,
		);

		array_push( $results, $query_results );
		
	}

	foreach ( $results as $result ) {

		// Check the current results and apply our current class if we are currently filtering by that post type.
		$class = ( ( $result['type_uri'] == $query_vars['filter'] ) || $result['type_uri'] == 'all' && empty( $query_vars['filter'] ) ) ? ' class="current"' : '';

		$additionals = '';

		// Append other query variables in our filters if they are present
		if ( ! empty( $query_vars['search'] ) )
			$additionals .= '&s=' . $query_vars['search'];

		if ( ! empty( $query_vars['post_status'] ) && ! is_array( $query_vars['post_status'] ) )
			$additionals .= '&post_status=' . $query_vars['post_status'];

		if ( ! empty( $query_vars['volume'] ) )
			$additionals .= '&volume=' . $query_vars['volume'];

		if ( ! empty( $query_vars['section'] ) )
			$additionals .= '&section=' . $query_vars['section'];

		if ( ! empty( $query_vars['posts_per_page'] ) )
			$additionals .= '&posts_per_page=' . $query_vars['posts_per_page'];


		$output .= ' | <li><a href="' . esc_url( 'edit.php?post_type=volume&page=manager&filter=' . sanitize_text_field( $result['type_uri'] ) ) . sanitize_text_field( $additionals ) . '"' . $class . '>' . esc_html( $result['post_type'] ) . '</a><span class="count">(' . absint( $result['post_count'] ) . ')</span> </li>';
	}

	return substr( $output, 2 );
}


/**
 * Function to generate the pagination links. Just a wrapper for paginate links
 */
function make_get_pagination_link( $total, $paged ) {
	$links = paginate_links( array(
			'base' 		=> get_pagenum_link() . '%_%',
			'format' 	=> '&paged=%#%',
			'current' 	=> max( 1, sanitize_text_field( $paged ) ),
			'total' 	=> absint( $total )
		) 
	);

	return $links;
}

$make_dashboard_disallowed_post_statuses = array(
		'trash',
		'spam',
		'inherit',
		'private',
		'auto-draft',
	);
/**
 * Post Status Drop Down
 */
function make_post_status_dropdown() {
	global $wp_post_statuses, $make_dashboard_disallowed_post_statuses;

	$query_vars = make_get_query_vars();

	$output = '<select name="post_status" id="post_status">';
	$output .= '<option value="all">All Statuses</option>';

	foreach ( $wp_post_statuses as $status => $obj) {
		if ( ! in_array( $status, $make_dashboard_disallowed_post_statuses ) )
			$output .= '<option value="' . esc_attr( $obj->name ) . '"' . selected( sanitize_text_field( $query_vars['post_status'] ), esc_attr( $obj->name ), false ) . '>' . esc_html( $obj->label ) . '</option>';
	}

	$output .= '</select>';

	return $output;
}


/**
 * Generates a dropdown of our volumes we can filter by
 * @return html
 */
function make_volumes_dropdown() {

	$query_vars = make_get_query_vars();

	$pages = wp_dropdown_pages( array(
		'post_type' => 'volume',
		'selected'  => $query_vars['volume'],
		'name'      => 'volume',
		'show_option_none' => 'All Volumes',
		'option_none_value' => 'all',
		'sort_column' => 'menu_order, post_title',
		'echo' => false,
	) );

	if ( ! empty( $pages ) )
		echo $pages;
}


/**
 * Generates a dropdown of how many pages we want to display on each page
 * @param  array $posts_per_page an array of integers to be outputted as options
 * @return html
 */
function make_posts_per_page_dropdown( $posts_per_page ) {
	$query_vars = make_get_query_vars();

	$output = 'Posts Per Page <select name="posts_per_page" id="posts-per-page">';
	$output .= '<option value="20">20</option>';

	foreach ( $posts_per_page as $post_count ) {
		$output .= '<option value="' . absint( $post_count ) . '"' . selected( absint( $query_vars['posts_per_page'] ), absint( $post_count ), false ) . '>' . absint( $post_count ) . '</option>';
	}

	$output .= '</select>';

	echo $output;
}


/**
 * Generate a dropdown to filter the sections. Duh.
 * @return html
 */
function make_section_dropdown() {

	$query_vars = make_get_query_vars();
	$terms = get_terms( 'section', array( 'hide_empty' => false ) );

	$output = '<select name="section" id="section-dropdown">';
	$output .= '<option value="all">All Sections</option>';

	foreach ( $terms as $term ) {
		$output .= '<option value="' . sanitize_text_field( $term->slug ) . '"' . selected( sanitize_text_field( $query_vars['section'] ), sanitize_text_field( $term->slug ), false ) . '>' . esc_html( $term->name ) . '</option>';
	}

	$output .= '</select>';

	return $output;
}


/**
 * Return a list of all the post statuses
 * @return array
 */
function make_post_statuses() {
	global $wp_post_statuses, $make_dashboard_disallowed_post_statuses;

	foreach ( $wp_post_statuses as $status => $name ) {
		if ( ! in_array( $status, $make_dashboard_disallowed_post_statuses ) )
			$statuses[] = $status;
	}

	return $statuses;
}


/**
 * Initialize our screen options
 */
function make_init_screen_options() {
	$screen = get_current_screen();

	if ( $screen->id == 'volume_page_manager' ) {
		add_filter( 'screen_layout_columns', 'make_display_screen_options' );
		$screen->add_option('make_screen_options', '');
	}
}
add_action( 'admin_head', 'make_init_screen_options' );


/**
 * Processes the data returned in user meta and allows us to control our table and screen optinos metabox
 * @param  string  $option  The name of the option to check against (ie post_title, ef_pc, etc, etc)
 * @param  boolean $metabox Configures the way this function handles the data being outputted. Use this if we are checking for data used in the screen options metabox
 * @param  boolean $default Some columns we want shown by default. Set this to true to have our metabox checkboxes checked by default
 * @return string
 */
function make_check_screen_options( $option, $metabox = false, $default = false ) {

	$user_id = get_current_user_id();
	$screen_options = get_user_attribute( $user_id, 'metaboxhidden_mag_dashboard' );
	$output = '';

	// Let's make sure we have data in DB before requesting it. If there isn't, setup the defaults.
	if ( ! empty( $screen_options ) ) {
		// Process the options for our metaboxes
		if ( $metabox ) {
			// Check if we want something checked by default, do it as long as our data isn't set in the database yet
			if ( $default && isset( $screen_options[ $option . '-hide' ] ) ) {
				$output = 'checked="checked"';
			} else {
				$output = checked( $screen_options[ $option . '-hide' ], $option, false );
			}
		} else { // This code is used when we are not dealing with the screen options metabox (ie our table rows)
			if ( empty( $screen_options[ $option . '-hide' ] ) )
				$output = ' style="display:none;"';
		}

	} else {
		if ( $default && $metabox ) {
			$output = 'checked="checked"';
		} elseif ( ! $default && ! $metabox ) {
			$output = ' style="display:none;"';
		}
	}

	return $output;
}


/**
 * Display a list of columns to drop (TODO: find a way to output these easily via WP_Screen classs)
 */
function make_display_screen_options() { ?>
	<div id="screen-options-wrap" class="hidden" tabindex="-1" aria-label="Screen Options Tab">
		<form id="magazine-dashboard-screen-options" name="make_dashboard_options" method="get">
			<?php wp_nonce_field( 'dashboard-screen-save', 'make-magazine-dashboard', false ); ?>
			<input type="hidden" name="submission" value="submit-dashboard-screen-options">

			<h5>Show on screen</h5>
			<div class="metabox-prefs">
				<label for="post_parent-hide">
					<input type="checkbox" class="hide-column-tog" id="post_parent-hide" name="post_parent-hide" value="post_parent" <?php echo make_check_screen_options( 'post_parent', true, true ); ?>> Volume
				</label>
				<label for="post_type-hide">
					<input type="checkbox" class="hide-column-tog" id="post_type-hide" name="post_type-hide" value="post_type" <?php echo make_check_screen_options( 'post_type', true, true ); ?>> Content Type
				</label>
				<label for="post_status-hide">
					<input type="checkbox" class="hide-column-tog" id="post_status-hide" name="post_status-hide" value="post_status" <?php echo make_check_screen_options( 'post_status', true, true ); ?>> Status
				</label>
				<label for="section-hide">
					<input type="checkbox" class="hide-column-tog" id="section-hide" name="section-hide" value="section" <?php echo make_check_screen_options( 'section', true, true ); ?>> Section
				</label>
				<label for="post_title-hide">
					<input type="checkbox" class="hide-column-tog" id="post_title-hide" name="post_title-hide" value="post_title" <?php echo make_check_screen_options( 'post_title', true, true ); ?>> Title
				</label>
				<label for="post_author-hide">
					<input type="checkbox" class="hide-column-tog" id="post_author-hide" name="post_author-hide" value="post_author" <?php echo make_check_screen_options( 'post_author', true, true ); ?>> Author
				</label>
				<label for="post_date-hide"> 
					<input type="checkbox" class="hide-column-tog" id="post_date-hide" name="post_date-hide" value="post_date" <?php echo make_check_screen_options( 'post_date', true, true ); ?>> Date
				</label>
				<label for="ef_first_draft_date-hide">
					<input type="checkbox" class="hide-column-tog" id="ef_first_draft_date-hide" name="ef_first_draft_date-hide" value="ef_first_draft_date"<?php echo make_check_screen_options( 'ef_first_draft_date', true ); ?>> 1st Deadline
				</label>
				<label for="ef_page_count-hide">
					<input type="checkbox" class="hide-column-tog" id="ef_page_count-hide" name="ef_page_count-hide" value="ef_page_count" <?php echo make_check_screen_options( 'ef_page_count', true, true ); ?>> PC
				</label>
				<label for="ef_editor-hide">
					<input type="checkbox" class="hide-column-tog" id="ef_editor-hide" name="ef_editor-hide" value="ef_editor" <?php echo make_check_screen_options( 'ef_editor', true, true ); ?>> ED
				</label>
				<label for="ef_editor_deadline-hide">
					<input type="checkbox" class="hide-column-tog" id="ef_editor_deadline-hide" name="ef_editor_deadline-hide" value="ef_editor_deadline" <?php echo make_check_screen_options( 'ef_editor_deadline', true, true ); ?>> ED Deadline
				</label>
				<label for="ef_copyeditor-hide">
					<input type="checkbox" class="hide-column-tog" id="ef_copyeditor-hide" name="ef_copyeditor-hide" value="ef_copyeditor" <?php echo make_check_screen_options( 'ef_copyeditor', true, true ); ?>> CE
				</label>
				<label for="ef_copyeditor_deadline-hide">
					<input type="checkbox" class="hide-column-tog" id="ef_copyeditor_deadline-hide" name="ef_copyeditor_deadline-hide" value="ef_copyeditor_deadline" <?php echo make_check_screen_options( 'ef_copyeditor_deadline', true, true ); ?>> CE Deadline
				</label>
				<label for="ef_tech_review-hide">
					<input type="checkbox" class="hide-column-tog" id="ef_tech_review-hide" name="ef_tech_review-hide" value="ef_tech_review" <?php echo make_check_screen_options( 'ef_tech_review', true ); ?>> TR
				</label>
				<label for="ef_needs_video-hide">
					<input type="checkbox" class="hide-column-tog" id="ef_needs_video-hide" name="ef_needs_video-hide" value="ef_needs_video" <?php echo make_check_screen_options( 'ef_needs_video', true ); ?>> Needs Video
				</label>
				<label for="ef_needs_photo-hide">
					<input type="checkbox" class="hide-column-tog" id="ef_needs_photo-hide" name="ef_needs_photo-hide" value="ef_needs_photo" <?php echo make_check_screen_options( 'ef_needs_photo', true ); ?>> Needs Photo
				</label>
				<label for="ef_estimate-hide">
					<input type="checkbox" class="hide-column-tog" id="ef_estimate-hide" name="ef_estimate-hide" value="ef_estimate" <?php echo make_check_screen_options( 'ef_estimate', true, true ); ?>> Fee
				</label>
				<label for="ef_invoice_amount-hide">
					<input type="checkbox" class="hide-column-tog" id="ef_invoice_amount-hide" name="ef_invoice_amount-hide" value="ef_invoice_amount" <?php echo make_check_screen_options( 'ef_invoice_amount', true ); ?>> Invoice
				</label>
				<label for="ef_invoice_received-hide">
					<input type="checkbox" class="hide-column-tog" id="ef_invoice_received-hide" name="ef_invoice_received-hide" value="ef_invoice_received" <?php echo make_check_screen_options( 'ef_invoice_received', true ); ?>> Invoiced
				</label>
				<label for="ef_maker_shed-hide">
					<input type="checkbox" class="hide-column-tog" id="ef_maker_shed-hide" name="ef_maker_shed-hide" value="ef_maker_shed" <?php echo make_check_screen_options( 'ef_maker_shed', true ); ?>> Maker Shed
				</label>
				<label for="ef_word_count-hide">
					<input type="checkbox" class="hide-column-tog" id="ef_word_count-hide" name="ef_word_count-hide" value="ef_word_count" <?php echo make_check_screen_options( 'ef_word_count', true ); ?>> WC
				</label>
				<label for="print-view-hide">
					<input type="checkbox" class="hide-column-tog" id="print-view-hide" name="print-view-hide" value="print-view" <?php echo make_check_screen_options( 'print-view', true, true ); ?>> Print View
				</label>
			</div>
			<div class="screen-options"></div>
		</form>
	</div>
<?php }


/**
 * Helper functino to easily convert Unix time to a perfered date settings
 * @param  string  $time      The time to conver
 * @param  boolean $is_string Allows us to convert a string to time
 * @return string
 */
function make_convert_to_pretty_time( $time, $is_string = false ) {

	if ( empty( $time ) )
		return;

	if ( $is_string )
		$time = strtotime( $time );

	return date( 'm/d/y', absint( $time ) );
}


/**
 * Helper function to convert integer equivilent boolean values to text
 * @param  integer $boolean An integer value (0 or 1) that will be converted to text on output
 * @return string
 */
function make_convert_boolean( $boolean ) {

	if ( empty( $boolean ) )
		return;

	if ( $boolean ) {
		$answer = 'Yes';
	} else {
		$answer = 'No';
	}

	return $answer;
} 


/**
 * Helper function to convert author ID into a linked author name
 * @param  integer $author_id The author ID
 * @return string
 */
function make_convert_author_id( $author_id ) {
	// Make sure we actually passed some data..
	if ( empty( $author_id ) )
		return;

	$user = get_userdata( absint( $author_id ) );

	return '<a href="' . get_author_posts_url( absint( $author_id ) ) . '">' . esc_html( $user->display_name ) . '</a>';
}


/**
 * Helper function to process integers and return numbers or an empty string. We use this function because absint will return 0 other wise.. and we don't always want that.
 * @param  string $integer The integer we want to process. If the string is empty, we return nothing rather than 0
 * @return integer/void
 */
function make_get_integer( $integer ) {

	// Check is we are actuall passing something or if the string is NOT an integer.
	if ( empty( $integer ) || ! absint( $integer ) )
		return;

	$integer = ( $integer != 0 ) ? absint( $integer ) : '';

	return $integer;
}


/**
 * Current Faire Page
 */
function make_magazine_dashboard_page() {

	//must check that the user has the required capability 
	if ( ! current_user_can( 'delete_others_pages' ) )
		wp_die( __( 'You do not have sufficient permissions to access this page.', 'make' ) );

	// Get any query variables if set
	$query_vars = make_get_query_vars();

	// Check if we are filtering our results by post type.
	if ( empty( $query_vars['filter'] ) || $query_vars['filter'] == 'all' ) {
		$post_types = array( 'projects', 'magazine', 'review', 'errata', 'volume' );
	} else {
		$post_types = $query_vars['filter'];
	}

	$args = array(
		'post_type'		 => $post_types,
		'post_status'	 => $query_vars['post_status'],
		'posts_per_page' => $query_vars['posts_per_page'],
		'paged'			 => $query_vars['paged'],
		'post_parent'	 => $query_vars['volume'],
		'section'		 => $query_vars['section'],
		'tag'			 => str_replace( ' ', '-', $query_vars['tag'] ),
		's'				 => $query_vars['search'],
	);
	$query = new WP_Query( $args ); ?>
	<div class="wrap">
		<h1>Magazine Dashboard</h1>
		<ul class="subsubsub">
			<?php echo make_count_post_status(); ?>
		</ul>

		<form method="get" class="posts-filter">
			<input type="hidden" name="post_type" value="volume" />
			<input type="hidden" name="page" value="<?php echo esc_attr( $_REQUEST['page'] ); ?>" />
			<?php wp_nonce_field( 'dashboard-form-save', 'make-magazine-dashboard', false ); ?>
			
			<p class="search-box">
				<label for="post-search-input" class="screen-reader-text">Search Dashboard</label>
				<input type="search" id="post-search-input" name="s" value="<?php echo ( isset( $query_vars['search'] ) ) ? esc_attr( $query_vars['search'] ) : ''; ?>">
				<input type="submit" name="" id="search-submit" class="button" value="Search Dashboard">
			</p>
			<p class="search-box page-count">
				Current Page Count <span class="pc-number">0</span> | &nbsp;
			</p>

			<div class="tablenav top">
				<?php echo make_post_status_dropdown(); ?>
				<?php echo make_volumes_dropdown(); ?>
				<?php echo make_section_dropdown(); ?>
				<?php echo make_posts_per_page_dropdown( array( 30, 40, 50, 60, 70, 80, 90, 100 ) ); ?>
				<input type="text" name="tag" placeholder="Filter by Tag" value="<?php echo $query_vars['tag']; ?>">
				<input type="submit" name="" id="filter-submit" class="button" value="Filter Dashboard">
				<button class="button"><a href="<?php echo esc_url( admin_url( 'edit.php?post_type=volume&page=manager' ) ); ?>">Reset Filters</a></button>
				<div class="tablenav-pages">
					<span class="displaying-num"><?php echo absint( $query->found_posts ); ?> Items</span>
					<?php echo make_get_pagination_link( $query->max_num_pages, $query_vars['paged'] ); ?>
				</div>
				
			</div>
			
			<table id="magazine-dashboard" class="wp-list-table widefat fixed pages">
				<thead>
					<tr>
						<th scope="col" id="post_parent" class="manage-column column-post_parent table-sortable"<?php echo make_check_screen_options( 'post_parent', false, true ); ?>>Volume</th>
						<th scope="col" id="post_type" class="manage-column column-post_type table-sortable"<?php echo make_check_screen_options( 'post_type', false, true ); ?>>Content Type</th>
						<th scope="col" id="post_status" class="manage-column column-post_status table-sortable"<?php echo make_check_screen_options( 'post_status', false, true ); ?>>Status</th>
						<th scope="col" id="section" class="manage-column column-section table-sortable"<?php echo make_check_screen_options( 'section', false, true ); ?>>Section</th>
						<th scope="col" id="post_title" class="manage-column column-post_title table-sortable"<?php echo make_check_screen_options( 'post_title', false, true ); ?>>Title</th>
						<th scope="col" id="post_author" class="manage-column column-post_author table-sortable"<?php echo make_check_screen_options( 'post_author', false, true ); ?>>Author</th>
						<th scope="col" id="post_date" class="manage-column column-post_date table-sortable table-sortable"<?php echo make_check_screen_options( 'post_date', false, true ); ?>>Date</th>

						<th scope="col" id="ef_first_draft_date" class="manage-column column-ef_first_draft_date table-sortable"<?php echo make_check_screen_options( 'ef_first_draft_date' ); ?>>1st Deadline</th>
						<th scope="col" id="ef_page_count" class="manage-column column-ef_page_count table-sortable"<?php echo make_check_screen_options( 'ef_page_count', false, true ); ?>>PC</th>
						<th scope="col" id="ef_editor" class="manage-column column-ef_editor table-sortable"<?php echo make_check_screen_options( 'ef_editor', false, true ); ?>>ED</th>
						<th scope="col" id="ef_editor_deadline" class="manage-column column-ef_editor_deadline table-sortable"<?php echo make_check_screen_options( 'ef_editor_deadline', false, true ); ?>>ED Deadline</th>
						<th scope="col" id="ef_copyeditor" class="manage-column column-ef_copyeditor table-sortable"<?php echo make_check_screen_options( 'ef_copyeditor', false, true ); ?>>CE</th>
						<th scope="col" id="ef_copyeditor_deadline" class="manage-column column-ef_copyeditor_deadline table-sortable"<?php echo make_check_screen_options( 'ef_copyeditor_deadline', false, true ); ?>>CE Deadline</th>
						<th scope="col" id="ef_tech_review" class="manage-column column-ef_tech_review table-sortable"<?php echo make_check_screen_options( 'ef_tech_review' ); ?>>TR</th>
						<th scope="col" id="ef_needs_video" class="manage-column column-ef_needs_video table-sortable"<?php echo make_check_screen_options( 'ef_needs_video' ); ?>>Needs Video</th>
						<th scope="col" id="ef_needs_photo" class="manage-column column-ef_needs_photo table-sortable"<?php echo make_check_screen_options( 'ef_needs_photo' ); ?>>Needs Photo</th>
						<th scope="col" id="ef_estimate" class="manage-column column-ef_estimate table-sortable"<?php echo make_check_screen_options( 'ef_estimate', false, true ); ?>>Fee</th>
						<th scope="col" id="ef_invoice_amount" class="manage-column column-ef_invoice_amount table-sortable"<?php echo make_check_screen_options( 'ef_invoice_amount' ); ?>>Invoice</th>
						<th scope="col" id="ef_invoice_received" class="manage-column column-ef_invoice_received table-sortable"<?php echo make_check_screen_options( 'ef_invoice_received' ); ?>>Invoiced</th>
						<th scope="col" id="ef_maker_shed" class="manage-column column-ef_maker_shed table-sortable"<?php echo make_check_screen_options( 'ef_maker_shed' ); ?>>Maker Shed</th>
						<th scope="col" id="ef_word_count" class="manage-column column-ef_word_count table-sortable"<?php echo make_check_screen_options( 'ef_word_count' ); ?>>WC</th>
						<th scope="col" id="print-view" class="manage-column column-print-view table-sortable"<?php echo make_check_screen_options( 'print-view', false, true ); ?>>Print View</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th scope="col" id="post_parent" class="manage-column column-post_parent table-sortable"<?php echo make_check_screen_options( 'post_parent', false, true ); ?>>Volume</th>
						<th scope="col" id="post_type" class="manage-column column-post_type table-sortable"<?php echo make_check_screen_options( 'post_type', false, true ); ?>>Content Type</th>
						<th scope="col" id="post_status" class="manage-column column-post_status table-sortable"<?php echo make_check_screen_options( 'post_status', false, true ); ?>>Status</th>
						<th scope="col" id="section" class="manage-column column-section table-sortable"<?php echo make_check_screen_options( 'section', false, true ); ?>>Section</th>
						<th scope="col" id="post_title" class="manage-column column-post_title table-sortable"<?php echo make_check_screen_options( 'post_title', false, true ); ?>>Title</th>
						<th scope="col" id="post_author" class="manage-column column-post_author table-sortable"<?php echo make_check_screen_options( 'post_author', false, true ); ?>>Author</th>
						<th scope="col" id="post_date" class="manage-column column-post_date table-sortable table-sortable"<?php echo make_check_screen_options( 'post_date', false, true ); ?>>Date</th>

						<th scope="col" id="ef_first_draft_date" class="manage-column column-ef_first_draft_date table-sortable"<?php echo make_check_screen_options( 'ef_first_draft_date' ); ?>>1st Deadline</th>
						<th scope="col" id="ef_page_count" class="manage-column column-ef_page_count table-sortable"<?php echo make_check_screen_options( 'ef_page_count', false, true ); ?>>PC</th>
						<th scope="col" id="ef_editor" class="manage-column column-ef_editor table-sortable"<?php echo make_check_screen_options( 'ef_editor', false, true ); ?>>ED</th>
						<th scope="col" id="ef_editor_deadline" class="manage-column column-ef_editor_deadline table-sortable"<?php echo make_check_screen_options( 'ef_editor_deadline', false, true ); ?>>ED Deadline</th>
						<th scope="col" id="ef_copyeditor" class="manage-column column-ef_copyeditor table-sortable"<?php echo make_check_screen_options( 'ef_copyeditor', false, true ); ?>>CE</th>
						<th scope="col" id="ef_copyeditor_deadline" class="manage-column column-ef_copyeditor_deadline table-sortable"<?php echo make_check_screen_options( 'ef_copyeditor_deadline', false, true ); ?>>CE Deadline</th>
						<th scope="col" id="ef_tech_review" class="manage-column column-ef_tech_review table-sortable"<?php echo make_check_screen_options( 'ef_tech_review' ); ?>>TR</th>
						<th scope="col" id="ef_needs_video" class="manage-column column-ef_needs_video table-sortable"<?php echo make_check_screen_options( 'ef_needs_video' ); ?>>Needs Video</th>
						<th scope="col" id="ef_needs_photo" class="manage-column column-ef_needs_photo table-sortable"<?php echo make_check_screen_options( 'ef_needs_photo' ); ?>>Needs Photo</th>
						<th scope="col" id="ef_estimate" class="manage-column column-ef_estimate table-sortable"<?php echo make_check_screen_options( 'ef_estimate', false, true ); ?>>Fee</th>
						<th scope="col" id="ef_invoice_amount" class="manage-column column-ef_invoice_amount table-sortable"<?php echo make_check_screen_options( 'ef_invoice_amount' ); ?>>Invoice</th>
						<th scope="col" id="ef_invoice_received" class="manage-column column-ef_invoice_received table-sortable"<?php echo make_check_screen_options( 'ef_invoice_received' ); ?>>Invoiced</th>
						<th scope="col" id="ef_maker_shed" class="manage-column column-ef_maker_shed table-sortable"<?php echo make_check_screen_options( 'ef_maker_shed' ); ?>>Maker Shed</th>
						<th scope="col" id="ef_word_count" class="manage-column column-ef_word_count table-sortable"<?php echo make_check_screen_options( 'ef_word_count' ); ?>>WC</th>
						<th scope="col" id="print-view" class="manage-column column-print-view table-sortable"<?php echo make_check_screen_options( 'print-view', false, true ); ?>>Print View</th>
					</tr>
				</tfoot>
				<tbody id="the-list">
					<?php
						global $post, $wp_post_statuses;
						if( ! empty( $query->posts ) ) {
							foreach ( $query->posts as $post ) {
								setup_postdata( $post );

								// Set some variables....
								$volume      = ( $post->post_parent != 0 ) ? get_the_title( absint( $post->post_parent ) ) : '';
								$meta        = get_post_custom( absint( $post->ID ) );
								$sections    = get_the_term_list( absint( $post->ID ), 'section', '', ', ' );
								$post_type   = ( get_post_type() == 'magazine' ) ? 'Articles' : ucwords( get_post_type() );
								$post_status = $wp_post_statuses[ get_post_status() ]->label;

								echo '<tr id="post-' . absint( $post->ID ) . '" valign="top">';
								echo '<td class="post_parent column-post_parent"' . make_check_screen_options( 'post_parent', false, true ) . '>' . esc_html( $volume ) . '</td>';
								echo '<td class="post_type column-post_type"' . make_check_screen_options( 'post_type', false, true ) . '>' . esc_html( $post_type ) . '</td>';
								echo '<td class="post_status column-post_status"' . make_check_screen_options( 'post_status', false, true ) . '>' . esc_html( $post_status ) . '</td>';
								echo '<td class="section column-section"' . make_check_screen_options( 'section', false, true ) . '>' . wp_kses( $sections, array( 'a' => array( 'href' => array(), 'title' => array() ) ) ) . '</td>';
								echo '<td class="post_title column-post_title"' . make_check_screen_options( 'post_title', false, true ) . '><strong><a href="' . get_edit_post_link( absint( $post->ID ) ) . '">' . esc_html( get_the_title() ) . '</a></strong>
										<div class="row-actions">
											<span class="list-inline hide-if-no-js"><a href="' . get_edit_post_link( absint( $post->ID ) ) . '">Edit</a> | </span>
											<span class="trash"><a class="submitdelete" href="' . get_delete_post_link( absint( $post->ID ) ) . '">Trash</a></span>
										</div>
									  </td>';
								echo '<td class="post_author column-post_author"' . make_check_screen_options( 'post_author', false, true ) . '>' . coauthors_posts_links( ', ', ', ', null, null, false ) . '</td>';
								echo '<td class="post_date column-post_date"' . make_check_screen_options( 'post_date', false, true ) . '>' . make_convert_to_pretty_time( $post->post_date, true ) . '</td>';
								echo '<td class="ef_first_draft_date column-ef_first_draft_date"' . make_check_screen_options( 'ef_first_draft_date' ) . '>' . make_convert_to_pretty_time( $meta['_ef_editorial_meta_date_first-draft-date'][0] ) . '</td>';
								echo '<td class="ef_page_count column-ef_page_count ef_pc_count"' . make_check_screen_options( 'ef_page_count', false, true ) . '>' . make_get_integer( $meta['_ef_editorial_meta_number_page-count'][0] ) . '</td>';
								echo '<td class="ef_editor column-ef_editor"' . make_check_screen_options( 'ef_editor', false, true ) . '>' . make_convert_author_id( $meta['_ef_editorial_meta_user_editor'][0] ) . '</td>';
								echo '<td class="ef_editor_deadline column-ef_editor_deadline"' . make_check_screen_options( 'ef_editor_deadline', false, true ) . '>' . make_convert_to_pretty_time( $meta['_ef_editorial_meta_date_editor-deadline'][0] ) . '</td>';
								echo '<td class="ef_copyeditor column-ef_copyeditor"' . make_check_screen_options( 'ef_copyeditor', false, true ) . '>' . make_convert_author_id( $meta['_ef_editorial_meta_user_copyeditor'][0] ) . '</td>';
								echo '<td class="ef_copyeditor_deadline column-ef_copyeditor_deadline"' . make_check_screen_options( 'ef_copyeditor_deadline', false, true ) . '>' . make_convert_to_pretty_time( $meta['_ef_editorial_meta_date_copyedit-deadline'][0] ) . '</td>';
								echo '<td class="ef_tech_review column-ef_tech_review"' . make_check_screen_options( 'ef_tech_review' ) . '>' . make_convert_boolean( $meta['_ef_editorial_meta_checkbox_tech-review'][0] ) . '</td>';
								echo '<td class="ef_needs_video column-ef_needs_video"' . make_check_screen_options( 'ef_needs_video' ) . '>' . make_convert_boolean( $meta['_ef_editorial_meta_checkbox_needs-video'][0] ) . '</td>';
								echo '<td class="ef_needs_photo column-ef_needs_photo"' . make_check_screen_options( 'ef_needs_photo' ) . '>' . make_convert_boolean( $meta['_ef_editorial_meta_checkbox_needs-photo'][0] ) . '</td>';
								echo '<td class="ef_estimate column-ef_estimate"' . make_check_screen_options( 'ef_estimate', false, true ) . '>' . make_get_integer( $meta['_ef_editorial_meta_number_estimate'][0] ) . '</td>';
								echo '<td class="ef_invoice_amount column-ef_invoice_amount"' . make_check_screen_options( 'ef_invoice_amount' ) . '>' . make_convert_boolean( $meta['_ef_editorial_meta_number_invoice-amount'][0] ) . '</td>';
								echo '<td class="ef_invoice_received column-ef_invoice_received"' . make_check_screen_options( 'ef_invoice_received' ) . '>' . make_convert_boolean( $meta['_ef_editorial_meta_checkbox_invoice-received'][0] ) . '</td>';
								echo '<td class="ef_maker_shed column-ef_maker_shed"' . make_check_screen_options( 'ef_maker_shed' ) . '>' . make_convert_boolean( $meta['_ef_editorial_meta_checkbox_available-maker-shed'][0] ) . '</td>';
								echo '<td class="ef_word_count column-ef_word_count"' . make_check_screen_options( 'ef_word_count' ) . '>' . make_get_integer( $meta['_ef_editorial_meta_number_word-count'][0] ) . '</td>';
								echo '<td class="print-view column-print-view"' . make_check_screen_options( 'print-view', false, true ) . '><a href="' . esc_url( admin_url( 'edit.php?post_type=volume&page=production_editor&p=' . get_the_ID() ) ) . '">Print View</a></td>';
								echo '</tr>';
							}
						} else {
							echo '<tr class="no-items"><td class="colspanchange" colspan="3">No content found.</td></tr>';
						} ?>
				</tbody>
				
			</table>
			<div class="tablenav bottom">

				<div class="tablenav-pages">
					<span class="displaying-num"><?php echo absint( $query->found_posts ); ?> Items</span>
					<?php echo make_get_pagination_link( $query->max_num_pages, $query_vars['paged'] ); ?>
				</div>
				
			</div>
		</form>
	</div>

<?php }

/**
 * Hook the page in
 */
function make_add_menu_page() {
	add_submenu_page( 'edit.php?post_type=volume', 'Dashboard', 'Dashboard', 'delete_others_pages', 'manager', 'make_magazine_dashboard_page' );
}

add_action( 'admin_menu', 'make_add_menu_page' );