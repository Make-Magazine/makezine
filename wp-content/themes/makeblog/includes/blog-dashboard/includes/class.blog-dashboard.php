<?php
	
	/**
	 * Blog Dashboard.
	 *
	 * A custom list table to display all posts under a list of post types.
	 *
	 * @package    makeblog
	 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
	 * @author     Cole Geissinger <cgeissinger@makermedia.com>
	 */
	class Make_List_Tables_Blog_Dashboard {

		/**
		 * Contains all information for creating our submenu page, plus some extra data used through out the class
		 * @var array
		 */
		public $submenu_data = array(
			'parent_slug' => 'index.php',
			'page_title'  => 'Blog Dashboard',
			'menu_title'  => 'Dashboard',
			'capability'  => 'delete_others_pages',
			'menu_slug'   => 'blog-dashboard',
			'page_url'	  => 'index.php?page=blog-dashboard',
		);

		/**
		 * We like nonces. Nonces keep us safe. <3
		 * @var string
		 */
		public $nonce_name = 'make-blog-dashboard';


		/**
		 * The list of post types we want listed in our list tables
		 * @var array
		 */
		public $post_types = array(
			'All'	   	  => 'all',
			'Posts'       => 'post',
			'Projects' 	  => 'projects',
			'Videos'   	  => 'video',
			'Articles' 	  => 'magazine',
			'Craft'       => 'craft',
			'Reviews'  	  => 'review',
			'Newsletters' => 'newsletter',
			'Page 2'      => 'page_2',
		);


		/**
		 * A list of post statuses we DO NOT want returned
		 * @var array
		 */
		public $disallowed_post_statuses = array(
			'trash',
			'spam',
			'inherit',
			'private',
			'auto-draft',
		);

		
		/**
		 * List all the of the columns to be outputted.
		 * Used in the Screen Options and table header/footer
		 * @var array
		 */
		public $columns = array(
			'post_title' => array(
				'label'    => 'Title',
				'sortable' => true,
				'default'  => true,
			),
			'post_author' => array(
				'label'	   => 'Authors',
				'sortable' => true,
				'default'  => true,
			),
			'post_cats' => array(
				'label'    => 'Categories',
				'sortable' => true,
				'default'  => true,
			),
			'post_tags' => array(
				'label'    => 'Tags',
				'sortable' => true,
				'default'  => true,
			),
			'post_type' => array(
				'label'    => 'Type',
				'sortable' => true,
				'default'  => true,
			),
			'post_status' => array(
				'label'    => 'Status',
				'sortable' => true,
				'default'  => true,
			),
			'post_parent' => array(
				'label'    => 'Post Parent',
				'sortable' => true,
				'default'  => true,
			),
			'post_date' => array(
				'label'    => 'Date',
				'sortable' => true,
				'default'  => true,
			),
			'post_id' => array(
				'label'    => 'ID',
				'sortable' => true,
				'default'  => true,
			),
		);


		/**
		 * The initilizer.
		 *
		 * Loads all hooks/filters and magic here.
		 */
		public function __construct() {

			// Load our admin page
			add_action( 'admin_menu', array( $this, 'add_menu_page' ) );

			// Load our ajax processor
			add_action( 'wp_ajax_blog_dash_screen_opt', array( $this, 'ajax_save_user_screen_options' ) );

			// Initialize our screen options
			add_action( 'admin_head', array( $this, 'init_screen_options' ) );

			// Load our resources
			add_action( 'admin_enqueue_scripts', array( $this, 'add_resources' ) );
		}


		/**
		 * Registers our submenu.
		 * Do not adjust directly, except for the callback function. Other wise, use the $submenu_data variable to adjust.
		 */
		function add_menu_page() {
			add_submenu_page( $this->submenu_data['parent_slug'], $this->submenu_data['page_title'], $this->submenu_data['menu_title'], $this->submenu_data['capability'], $this->submenu_data['menu_slug'], array( $this, 'display_blog_dashboard_page' ) );
		}


		/**
		 * Loads all required JavaScript/CSS to make our list table work.
		 */
		function add_resources() {
			$screen = get_current_screen();

			if ( $screen->id == 'dashboard_page_blog-dashboard' ) {
				wp_enqueue_style( 'make-dashboard-css', get_stylesheet_directory_uri() . '/includes/blog-dashboard/css/dashboard.css' );

				wp_enqueue_script( 'make-sort-table', get_stylesheet_directory_uri() . '/js/jquery.tablesorter.min.js', array( 'jquery' ) );
				wp_enqueue_script( 'make-dashboard', get_stylesheet_directory_uri() . '/includes/blog-dashboard/js/dashboard-scripts.js', array( 'make-sort-table' ) );
			}
		}


		/**
		 * Centeralize all of our query variables into an easy to use array
		 * @return array
		 */
		function get_query_vars() {
			$query_vars = array(
				'paged' 		 => ( isset( $_GET['paged'] ) ) ? absint( $_GET['paged'] ) : 1,
				'search' 		 => ( isset( $_GET['s'] ) ) ? sanitize_text_field( $_GET['s'] ) : '',
				'post_type' 	 => ( isset( $_GET['content_type'] ) && in_array( $_GET['content_type'], $this->post_types ) ) ? sanitize_text_field( $_GET['content_type'] ) : '',
				'post_status' 	 => ( isset( $_GET['post_status'] ) && $_GET['post_status'] != '' && $_GET['post_status'] != 'all' ) ? sanitize_text_field( $_GET['post_status'] ) : $this->get_post_statuses(),
				'category' 		 => ( isset( $_GET['category'] ) && $_GET['category'] != '0' ) ? sanitize_text_field( $_GET['category'] ) : '',
				'tag'			 => ( isset( $_GET['tag'] ) && $_GET['tag'] != 'all' ) ? sanitize_text_field( $_GET['tag'] ) : '',
				'month'			 => ( isset( $_GET['month'] ) && $_GET['month'] != 'all' ) ? absint( $_GET['month'] ) : '',
				'year'			 => ( isset( $_GET['year'] ) && $_GET['year'] != 'all' ) ? absint( $_GET['year'] ) : '',
				'posts_per_page' => ( isset( $_GET['posts_per_page'] ) && $_GET['posts_per_page'] <= 100 ) ? absint( $_GET['posts_per_page'] ) : 40,
			);

			return $query_vars;
		}


		/**
		 * Handles our Ajax requests for the custom screen options. Called from dashboard-scripts.js. Only runs when a user is logged in (hence the wp_ajax_* action);
		 * @return void
		 */
		function ajax_save_user_screen_options() {

			// Ensure that users with a role of Editor or higher can save these options
			if ( ! current_user_can( 'edit_posts' ) )
				return;

			// Make sure everything is as it's supposed to.
			if ( isset( $_POST['submission'] ) && $_POST['submission'] == 'submit-blog-dash-screen-options' && wp_verify_nonce( $_POST['nonce'], 'blog-dashboard-screen-save' ) ) {

				// Turn our query string into an array
				parse_str( sanitize_text_field( $_POST['data'] ), $data );

				$user_id = get_current_user_id();
				$updates = update_user_attribute( $user_id, 'metaboxhidden_blog_dashboard', $data );
			}
		}


		/**
		 * Handles any additional query string data
		 */
		function add_additional_queries() {
			$query_vars = $this->get_query_vars();
			$additionals = '';

			// Append other query variables in our filters if they are present
			if ( ! empty( $query_vars['search'] ) || $query_vars['search'] != '' )
				$additionals .= '&s=' . $query_vars['search'];

			if ( ! empty( $query_vars['post_status'] ) && ! is_array( $query_vars['post_status'] ) )
				$additionals .= '&post_status=' . $query_vars['post_status'];

			if ( ! empty( $query_vars['month'] ) && $query_vars['month'] != '0' )
				$additionals .= '&month=' . $query_vars['month'];

			if ( ! empty( $query_vars['day'] ) && $query_vars['day'] != '0' )
				$additionals .= '&day=' . $query_vars['day'];
			
			if ( ! empty( $query_vars['year'] ) && $query_vars['year'] != '0' )
				$additionals .= '&year=' . $query_vars['year'];

			if ( ! empty( $query_vars['posts_per_page'] ) )
				$additionals .= '&posts_per_page=' . $query_vars['posts_per_page'];

			return sanitize_text_field( $additionals );
		}


		/**
		 * Counts all post statuses and returns a link that we can use to filter by
		 */
		function count_post_status() {
			$query_vars = $this->get_query_vars();
			$results = array();
			$new_post_types = array_slice( $this->post_types, 1 ); // Remove the first array option which is 'all'
			$output = '';

			foreach ( $this->post_types as $k => $type ) {
				$args = array( 
					'post_type'		 => ( $type == 'all' ) ? $new_post_types : $type,
					'post_status'	 => ( isset( $query_vars['post_status'] ) ) ? $query_vars['post_status'] : '',
					'post_parent'	 => ( isset( $query_vars['post_parent'] ) ) ? $query_vars['post_parent'] : '',
					'tag'			 => ( isset( $query_vars['tag'] ) ) ? $query_vars['tag'] : '',
					'category'		 => ( isset( $query_vars['category'] ) ) ? $query_vars['category'] : '',
					'month'			 => ( isset( $query_vars['month'] ) ) ? $query_vars['month'] : '',
					'day'			 => ( isset( $query_vars['day'] ) ) ? $query_vars['day'] : '',
					'year'			 => ( isset( $query_vars['year'] ) ) ? $query_vars['year'] : '',
					's'				 => ( isset( $query_vars['search'] ) ) ? $query_vars['search'] : '',
					'posts_per_page' => 0,
					'return_fields'	 => 'ids',
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
				$class = ( ( $result['type_uri'] == $query_vars['post_type'] ) || $result['type_uri'] == 'all' && empty( $query_vars['post_type'] ) ) ? ' class="current"' : '';

				$output .= ' | <li><a href="' . esc_url( $this->submenu_data['page_url'] . '&content_type=' . sanitize_text_field( $result['type_uri'] ) ) . $this->add_additional_queries() . '"' . $class . '>' . esc_html( $result['post_type'] ) . '</a><span class="count">(' . absint( $result['post_count'] ) . ')</span> </li>';
			}

			// Remove the first two characters of our string and return it
			return substr( $output, 2 );
		}


		/**
		 * Function to generate the pagination links. Just a wrapper for paginate links
		 */
		function get_pagination_link( $total, $paged ) {
			$links = paginate_links( array(
					'base' 		=> get_pagenum_link() . '%_%',
					'format' 	=> '&paged=%#%',
					'current' 	=> max( 1, sanitize_text_field( $paged ) ),
					'total' 	=> absint( $total )
				) 
			);

			return $links;
		}


		/**
		 * Post Status Drop Down
		 */
		function post_status_dropdown() {
			global $wp_post_statuses;

			$query_vars = $this->get_query_vars();

			$output = '<select name="post_status" id="post_status">';
			$output .= '<option value="all">All Statuses</option>';

			foreach ( $wp_post_statuses as $status => $obj ) {
				if ( ! in_array( $status, $this->disallowed_post_statuses ) ) {
					$post_status = ( ! is_array( $query_vars['post_status'] ) ) ? $query_vars['post_status'] : '';
					$output .= '<option value="' . esc_attr( $obj->name ) . '"' . selected( $post_status, esc_attr( $obj->name ), false ) . '>' . esc_html( $obj->label ) . '</option>';
				}
			}

			$output .= '</select>';

			return $output;
		}


		/**
		 * Generates a dropdown of how many pages we want to display on each page
		 * @param  array $posts_per_page an array of integers to be outputted as options
		 * @return html
		 */
		function posts_per_page_dropdown( $posts_per_page ) {
			$query_vars = $this->get_query_vars();

			$output = 'Posts Per Page <select name="posts_per_page" id="posts-per-page">';

			foreach ( $posts_per_page as $post_count ) {
				$output .= '<option value="' . absint( $post_count ) . '"' . selected( $query_vars['posts_per_page'], absint( $post_count ), false ) . '>' . absint( $post_count ) . '</option>';
			}

			$output .= '</select>';

			echo $output;
		}


		/**
		 * Generate a dropdown to filter the sections. Duh.
		 * @return html
		 */
		function date_dropdown() {

			$query_vars = $this->get_query_vars();

			// Months array
			$months = array(
				01 => 'Jan',
				02 => 'Feb',
				03 => 'Mar',
				04 => 'Apr',
				05 => 'May',
				06 => 'Jun',
				07 => 'Jul',
				08 => 'Aug',
				09 => 'Sep',
				10 => 'Oct',
				11 => 'Nov',
				12 => 'Dec',
			);


			// Years array
			$oldest_post = get_posts( 'posts_per_page=1&order=ASC' );
			$oldest_year = date( 'Y', strtotime( $oldest_post[0]->post_date ) );
			$years  = range( date( 'Y' ), $oldest_year );


			// output our Month dropdown
			$output = '<select name="month" id="month-dropdown">';
			$output .= '<option value="all">Month</option>';
			foreach ( $months as $number => $month ) {
 				$output .= '<option value="' . absint( $number ) . '"' . selected( $query_vars['month'], absint( $number ), false ) . '>' . esc_html( $month ) . '</option>';
			}
			$output .= '</select>';


			// output our Year dropdown
			$output .= '<select name="year" id="year-dropdown">';
			$output .= '<option value="all">Year</option>';

			foreach ( $years as $year ) {
				$output .= '<option value="' . absint( $year ) . '"' . selected( $query_vars['year'], absint( $year ), false ) . '>' . absint( $year ) . '</option>';
			}
			$output .= '</select>';


			// Output our dropdowns
			return $output;
		}


		/**
		 * Generate a dropdown to filter tags
		 * @return html
		 */
		function make_tags_dropdown() {

			$query_vars = $this->get_query_vars();
			$terms = get_terms( 'post_tag', array( 'hide_empty' => false ) );

			$output = '<select name="tag" id="tag-dropdown">';
			$output .= '<option value="all">All Tags</option>';

			foreach ( $terms as $term ) {
				$output .= '<option value="' . sanitize_text_field( $term->slug ) . '"' . selected( sanitize_text_field( $query_vars['tag'] ), sanitize_text_field( $term->slug ), false ) . '>' . esc_html( $term->name ) . '</option>';
			}

			$output .= '</select>';

			return $output;
		}


		/**
		 * Generate a dropdown to filter categories
		 * @return html
		 */
		function make_categories_dropdown() {

			$query_vars = $this->get_query_vars();
			$cats = wp_dropdown_categories( array(
				'hide_empty' 		=> false,
				'selected'   		=> $query_vars['category'],
				'name'		  		=> 'category',
				'show_option_all'   => 'All Categories',
				'sort_column' 		=> 'menu_order, post_title',
				'echo'				=> false,
			) );

			return $cats;
		}


		/**
		 * Return a list of all the post statuses
		 * @return array
		 */
		function get_post_statuses() {
			global $wp_post_statuses;

			foreach ( $wp_post_statuses as $status => $name ) {
				if ( ! in_array( $status, $this->disallowed_post_statuses ) )
					$statuses[] = $status;
			}

			return $statuses;
		}


		/**
		 * Initialize our screen options
		 */
		function init_screen_options() {
			$screen = get_current_screen();

			if ( $screen->id == 'dashboard_page_blog-dashboard' ) {
				add_filter( 'screen_layout_columns', array( $this, 'display_screen_options' ) );
				$screen->add_option( 'make_screen_options', '' );
			}
		}


		/**
		 * Processes the data returned in user meta and allows us to control our table and screen optinos metabox
		 * @param  string  $option  The name of the option to check against (ie post_title, ef_pc, etc, etc)
		 * @param  boolean $metabox Configures the way this function handles the data being outputted. Use this if we are checking for data used in the screen options metabox
		 * @param  boolean $default Some columns we want shown by default. Set this to true to have our metabox checkboxes checked by default
		 * @return string
		 */
		function check_screen_options( $option, $metabox = false, $default = false ) {

			$user_id = get_current_user_id();
			$screen_options = get_user_attribute( $user_id, 'metaboxhidden_blog_dashboard', true );
			$output = '';

			// Let's make sure we have data in DB before requesting it. If there isn't, setup the defaults.
			if ( ! empty( $screen_options ) ) {
				// Process the options for our metaboxes
				if ( $metabox ) {
					// Check if we want something checked by default, do it as long as our data isn't set in the database yet
					if ( $default && isset( $screen_options[ $option . '-hide' ] ) ) {
						$output = ' checked="checked"';
					} else {
						$output = checked( $screen_options[ $option . '-hide' ], $option, false );
					}
				} else { // This code is used when we are not dealing with the screen options metabox (ie our table rows)
					if ( ! isset( $screen_options[ $option . '-hide' ] ) && $screen_options[ $option . '-hide' ] != $option )
						$output = ' style="display:none;"';
				}
			} else {
				if ( $default && $metabox ) {
					$output = ' checked="checked"';
				} elseif ( ! $default && ! $metabox ) {
					$output = ' style="display:none;"';
				}
			}

			return $output;
		}


		/**
		 * Display a list of columns to drop (TODO: find a way to output these easily via WP_Screen classs)
		 */
		function display_screen_options() { ?>
			<div id="screen-options-wrap" class="hidden" tabindex="-1" aria-label="Screen Options Tab">
				<form id="blog-dashboard-screen-options" name="make_blog_dashboard_options" method="get">
					<?php wp_nonce_field( 'blog-dashboard-screen-save', $this->nonce_name, false ); ?>
					<input type="hidden" name="submission" value="submit-blog-dash-screen-options">

					<h5>Show on screen</h5>
					<div class="metabox-prefs">
						<?php foreach ( $this->columns as $column => $details ) : ?>
							<label for="<?php echo $column; ?>-hide">
								<input type="checkbox" class="hide-column-tog" id="<?php echo $column; ?>-hide" name="<?php echo $column; ?>-hide" value="<?php echo $column; ?>"<?php echo $this->check_screen_options( $column, true, $details['default'] ); ?>> <?php echo $details['label']; ?>
							</label>
						<?php endforeach; ?>
						
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
		function convert_to_pretty_time( $time, $is_string = false ) {

			if ( empty( $time ) )
				return;

			if ( $is_string )
				$time = strtotime( $time );

			return date( 'h:i A \- m/d/y', absint( $time ) );
		}


		/**
		 * Helper function to convert integer equivilent boolean values to text
		 * @param  integer $boolean An integer value (0 or 1) that will be converted to text on output
		 * @return string
		 */
		function convert_boolean( $boolean ) {

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
		function convert_author_id( $author_id ) {
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
		function get_integer( $integer ) {

			// Check is we are actuall passing something or if the string is NOT an integer.
			if ( empty( $integer ) || ! absint( $integer ) )
				return;

			$integer = ( $integer != 0 ) ? absint( $integer ) : '';

			return $integer;
		}


		/**
		 * Current Faire Page
		 */
		function display_blog_dashboard_page() {

			//must check that the user has the required capability 
			if ( ! current_user_can( 'delete_others_pages' ) )
				wp_die( __( 'You do not have sufficient permissions to access this page.', 'make' ) );

			// Get any query variables if set
			$query_vars = $this->get_query_vars(); 

			// Check if we are filtering our results by post type.
			if ( empty( $query_vars['post_type'] ) || $query_vars['post_type'] == 'all' ) {
				$post_types = array_slice( $this->post_types, 1 );
			} else {
				$post_types = $query_vars['post_type'];
			}

			$args = array(
				'post_type'		 => $post_types,
				'post_status'	 => ( isset( $query_vars['post_status'] ) ) ? $query_vars['post_status'] : '',
				'posts_per_page' => ( isset( $query_vars['posts_per_page'] ) ) ? $query_vars['posts_per_page'] : '',
				'paged'			 => ( isset( $query_vars['paged'] ) ) ? $query_vars['paged'] : '',
				'category'	 	 => ( isset( $query_vars['category'] ) ) ? $query_vars['category'] : '',
				'tag'			 => ( isset( $query_vars['tag'] ) ) ? $query_vars['tag'] : '',
				'monthnum'		 => ( isset( $query_vars['month'] ) ) ? $query_vars['month'] : '',
				'day'			 => ( isset( $query_vars['day'] ) ) ? $query_vars['day'] : '',
				'year'			 => ( isset( $query_vars['year'] ) ) ? $query_vars['year'] : '',
				's'				 => ( isset( $query_vars['search'] ) ) ? $query_vars['search'] : '',
			);
			$query = new WP_Query( $args ); ?>
			<div class="wrap">
				<h1><?php echo $this->submenu_data['page_title']; ?></h1>
				<ul class="subsubsub">
					<?php echo $this->count_post_status(); ?>
				</ul>

				<form method="get" class="posts-filter">
					<input type="hidden" name="page" value="<?php echo esc_attr( $_REQUEST['page'] ); ?>" />
					<?php wp_nonce_field( 'overview-form-save', $this->nonce_name, false ); ?>
					
					<p class="search-box">
						<label for="post-search-input" class="screen-reader-text">Search All Content</label>
						<input type="search" id="post-search-input" name="s" value="<?php echo ( isset( $query_vars['search'] ) ) ? esc_attr( $query_vars['search'] ) : ''; ?>">
						<input type="submit" name="" id="search-submit" class="button" value="Search All Content">
					</p>

					<div class="tablenav top">
						<?php echo $this->post_status_dropdown(); ?>
						<?php echo $this->date_dropdown(); ?>
						<?php echo $this->make_tags_dropdown(); ?>
						<?php echo $this->make_categories_dropdown(); ?>
						<?php echo $this->posts_per_page_dropdown( array( 20, 30, 40, 50, 60, 70, 80, 90, 100 ) ); ?>
						<input type="submit" name="" id="filter-submit" class="button" value="Filter All Content">
						<button class="button"><a href="<?php echo esc_url( admin_url( $this->submenu_data['page_url'] ) ); ?>">Reset Filters</a></button>
						<div class="tablenav-pages">
							<span class="displaying-num"><?php echo absint( $query->found_posts ); ?> Items</span>
							<?php echo $this->get_pagination_link( $query->max_num_pages, $query_vars['paged'] ); ?>
						</div>
						
					</div>
					
					<table id="blog-dashboard" class="wp-list-table widefat fixed pages">
						<thead>
							<tr>
								<?php foreach( $this->columns as $column => $details ) : ?>
									<th scope="col" id="<?php echo $column; ?>" class="manage-column column-<?php echo $column; ?><?php echo ( $details['sortable'] ) ? ' table-sortable' : ''; ?>"<?php echo $this->check_screen_options( $column, false, $details['default'] ); ?>><?php echo $details['label']; ?></th>
								<?php endforeach; ?>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<?php foreach( $this->columns as $column => $details ) : ?>
									<th scope="col" id="<?php echo $column; ?>" class="manage-column column-<?php echo $column; ?><?php echo ( $details['sortable'] ) ? ' table-sortable' : ''; ?>"<?php echo $this->check_screen_options( $column, false, $details['default'] ); ?>><?php echo $details['label']; ?></th>
								<?php endforeach; ?>
							</tr>
						</tfoot>
						<tbody id="the-list">
							<?php
								global $post, $wp_post_statuses;
								if( ! empty( $query->posts ) ) {
									foreach ( $query->posts as $post ) {
										setup_postdata( $post );

										// Set some variables....
										$post_parent = ( $post->post_parent != 0 ) ? get_the_title( absint( $post->post_parent ) ) : '';
										$meta        = get_post_custom( absint( $post->ID ) );
										$cats        = get_the_category_list( ', ', '', $post->ID );
										$tags 		 = get_the_term_list( $post->ID, 'post_tag', null, ', ' );
										$post_type   = ( get_post_type() == 'magazine' ) ? 'Articles' : ucwords( get_post_type() );
										$post_status = $wp_post_statuses[ get_post_status() ]->label;

										echo '<tr id="post-' . absint( $post->ID ) . '" valign="top">';
										echo '<td class="post_title column-post_title"' . $this->check_screen_options( 'post_title', false, true ) . '><strong><a href="' . get_edit_post_link( absint( $post->ID ) ) . '">' . esc_html( get_the_title() ) . '</a></strong>
												<div class="row-actions">
													<span class="inline hide-if-no-js"><a href="' . get_edit_post_link( absint( $post->ID ) ) . '">Edit</a> | </span>
													<span class="view"><a href="' . get_permalink() . '">View</a> | </span>
													<span class="trash"><a class="submitdelete" href="' . get_delete_post_link( absint( $post->ID ) ) . '">Trash</a></span>
												</div>
											  </td>';
										echo '<td class="post_author column-post_author"' . $this->check_screen_options( 'post_author', false, true ) . '>' . coauthors_posts_links( ', ', ', ', null, null, false ) . '</td>';
										echo '<td class="post_cats column-post_cats"' . $this->check_screen_options( 'post_cats', false, true ) . '>' . wp_kses( $cats, array( 'a' => array( 'href' => array(), 'title' => array() ) ) ) . '</td>';
										echo '<td class="post_tags column-post_tags"' . $this->check_screen_options( 'post_tags', false, true ) . '>' . wp_kses( $tags, array( 'a' => array( 'href' => array(), 'title' => array() ) ) ) . '</td>';
										echo '<td class="post_type column-post_type"' . $this->check_screen_options( 'post_type', false, true ) . '>' . esc_html( $post_type ) . '</td>';
										echo '<td class="post_status column-post_status"' . $this->check_screen_options( 'post_status', false, true ) . '>' . esc_html( $post_status ) . '</td>';
										echo '<td class="post_parent column-post_parent"' . $this->check_screen_options( 'post_parent', false, true ) . '>' . esc_html( $post_parent ) . '</td>';
										echo '<td class="post_date column-post_date"' . $this->check_screen_options( 'post_date', false, true ) . '>' . $this->convert_to_pretty_time( $post->post_date, true ) . '</td>';
										echo '<td class="post_id column-post_id"' . $this->check_screen_options( 'post_id', false, true ) . '>' . $this->get_integer( $post->ID ) . '</td>';
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
							<?php echo $this->get_pagination_link( $query->max_num_pages, $query_vars['paged'] ); ?>
						</div>
						
					</div>
				</form>
			</div>
		<?php }
	}