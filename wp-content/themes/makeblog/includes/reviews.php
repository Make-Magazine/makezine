<?php 

add_action( 'init', 'register_cpt_review' );

function register_cpt_review() {

	add_rewrite_rule( 'review/([^/]*)/([^/]*)/?$','index.php?review=$matches[2]','top' );

	$labels = array( 
		'name' => _x( 'Reviews', 'review' ),
		'singular_name' => _x( 'Review', 'review' ),
		'add_new' => _x( 'Add New', 'review' ),
		'add_new_item' => _x( 'Add New Review', 'review' ),
		'edit_item' => _x( 'Edit Review', 'review' ),
		'new_item' => _x( 'New Review', 'review' ),
		'view_item' => _x( 'View Review', 'review' ),
		'search_items' => _x( 'Search Reviews', 'review' ),
		'not_found' => _x( 'No reviews found', 'review' ),
		'not_found_in_trash' => _x( 'No reviews found in Trash', 'review' ),
		'parent_item_colon' => _x( 'Parent Review:', 'review' ),
		'menu_name' => _x( 'Reviews', 'review' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => true,
		'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions' ),
		'taxonomies' => array( 'complexity', 'components', 'documentation', 'community', 'completeness', 'maker', 'category', 'post_tag' ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'menu_position' => 42,
	);

	register_post_type( 'review', $args );
}


//require_once( dirname( __FILE__ ) . '/includes/cheezcap-config.php' ); 
require_once( dirname( __FILE__ ) . '/query-multiple-taxonomies/query-multiple-taxonomies.php' ); 

function js_option( $option_name ) {
		global $cap;
		echo $cap->$option_name;
	}

//This is deprecated. I really love the simplicity tho...

function js_excerpt($length){
	echo substr(get_the_excerpt(), 0, $length);
}

//New shorten function. Thanks @ninnypants

add_filter( 'get_the_excerpt', 'dont_add_review_to_excerpt', 5);

function dont_add_review_to_excerpt( $content ) {
	remove_filter( 'the_content', 'js_add_review');
	return $content;
}

function custom_excerpt_length(){
	global $excerpt_length;
	return $excerpt_length;
}

function custom_excerpt_more(){
	global $excerpt_more;
	return $excerpt_more;
}

function js_truncate_post($length = 55, $more = '[...]',$echo = true){
	global $excerpt_length, $excerpt_more;
	$excerpt_length = (int)$length;
	$excerpt_more = $more;
	remove_filter( 'the_excerpt', 'js_add_review');
	add_filter('excerpt_length', 'custom_excerpt_length');
	add_filter('excerpt_more', 'custom_excerpt_more');
	$excerpt = get_the_excerpt();
	remove_filter('excerpt_length', 'custom_excerpt_length');
	remove_filter('excerpt_more', 'custom_excerpt_more');
	if($echo) {
		echo $excerpt;
	}
	else {
		return $excerpt;
	}
}




if ( function_exists('register_sidebar') )
	register_sidebar();
	
	
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

if ( function_exists( 'add_image_size' ) ) { 
	// add_image_size( 'small-thumb', 56, 56, true );
	// add_image_size( 'small-another', 40, 40, true );
	// add_image_size( 'feat-cat-thumb', 263, 117, true );
	// add_image_size( 'review-large', 589, 9999 );
	// add_image_size( 'featured-large', 352, 262 );

}

if (class_exists('MultiPostThumbnails')) { 
	new MultiPostThumbnails(array( 'label' => 'Secondary Image', 'id' => 'secondary-image', 'post_type' => 'post' )); 
	}


function taxes_init() {
	// create a new taxonomy
	register_taxonomy(
		'complexity',
		'review',
		array(
			'label' => __( 'Complexity' ),
			'sort' => true,
			'args' => array( 'orderby' => 'term_order' ),
			'rewrite' => array( 'slug' => 'complexity' )
		)
	);
	register_taxonomy(
		'components',
		'review',
		array(
			'label' => __( 'Components' ),
			'sort' => true,
			'args' => array( 'orderby' => 'term_order' ),
			'rewrite' => array( 'slug' => 'components' )
		)
	);

	register_taxonomy(
		'documentation',
		'review',
		array(
			'label' => __( 'Documentation' ),
			'sort' => true,
			'args' => array( 'orderby' => 'term_order' ),
			'rewrite' => array( 'slug' => 'documentation' )
		)
	);

	register_taxonomy(
		'community',
		'review',
		array(
			'label' => __( 'Community' ),
			'sort' => true,
			'args' => array( 'orderby' => 'term_order' ),
			'rewrite' => array( 'slug' => 'community' )
		)
	);

	register_taxonomy(
		'completeness',
		'review',
		array(
			'label' => __( 'Completeness' ),
			'sort' => true,
			'args' => array( 'orderby' => 'term_order' ),
			'rewrite' => array( 'slug' => 'completeness' )
		)
	);

	$labels = array(
		'name' => _x( 'Review Categories', 'taxonomy general name' ),
		'singular_name' => _x( 'Category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Categories' ),
		'all_items' => __( 'All Categories' ),
		'parent_item' => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item' => __( 'Edit Category' ),
		'update_item' => __( 'Update Category' ),
		'add_new_item' => __( 'Add New Category' ),
		'new_item_name' => __( 'New Category Name' ),
	); 	

	register_taxonomy( 
		'review-category', 
		'review', 
		array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 
				'slug' => 'blog-category'
				),
	));
	
	$labels = array(
		'name' => _x( 'Review Tags', 'taxonomy general name' ),
		'singular_name' => _x( 'Review Tag', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Review Tags' ),
		'popular_items' => __( 'Popular Review Tags' ),
		'all_items' => __( 'All Review Tags' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Tag' ),
		'update_item' => __( 'Update Tag' ),
		'add_new_item' => __( 'Add New Tag' ),
		'new_item_name' => __( 'New Tag Name' ),
		'separate_items_with_commas' => __( 'Separate Review Tags with commas' ),
		'add_or_remove_items' => __( 'Add or remove Review Tags' ),
		'choose_from_most_used' => __( 'Choose from the most used Blog Tags' )
	);
	register_taxonomy(
		'review-tag', 
		'review', 
		array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 
				'slug' => 'review-tag' 
				),
	));

}
add_action( 'init', 'taxes_init' );

function js_terms($terms) {
	$terms = the_terms($post->ID, $terms);
	$count = count($terms);
	if ( $count > 0 ){
	 foreach ( $terms as $term ) {
	   echo 'term'.$term->name;
	 }
	}
 }

function js_ratings_box() {
	global $post;
	ob_start();
?>


<div id="review_box">
							
<h3><span class="red">Make:</span> Kit Reviews</h3>

<h5><?php echo get_the_term_list( $post->ID, 'maker', '', ', ', '' ); ?></h5>
<h2><?php the_title(); ?></h2>
<h4>
<?php
	$price = get_post_custom_values('Price');
	if (isset($price[0])) {
		echo $price[0];
	}
?>
</h4>

<div class="meta">

<?php
	$price = get_post_custom_values('CompanyURL');
	if (isset($price[0])) {
		echo '<a href="';
		echo esc_url( $price[0] );
		echo '" class="btn btn-primary btn-mini">Company Website</a>';
	}
?>

<?php
	$price = get_post_custom_values('ProductURL');
	if (isset($price[0])) {
		echo '<a href="';
		echo esc_url( $price[0] );
		echo '" class="btn btn-danger btn-mini">Buy now!</a>';
	}
?>

<!--<p><?php the_author_posts_link(); ?></p>-->
</div>

<dl class="ratings">
	<dt><span class="define" rel="popover" data-placement="bottom" data-trigger="hover" data-content="(1=Easy, 5=Difficult) Is the kit easy, moderate, or challenging to build for its most likely target audience? Kits clearly aimed at children would, for example, be rated differently from microcontroller kits." data-title="Complexity">Complexity:</span> <?php echo get_the_term_list( $post->ID, 'complexity', '', ', ', '' ); ?></dt>
	<dd class="<?php $terms_as_text = get_the_term_list( $post->ID, 'complexity', '', ', ', '' ) ; echo 'term'.strip_tags($terms_as_text); ?>"></dd>
	
	<dt><span class="define" rel="popover" data-placement="bottom" data-trigger="hover" data-content="(5=Highest quality) How nice are the components in terms of materials, design, fit, and other qualities? Well-made circuit boards, computer-cut plastic and metal parts, and other precision components add to the experience." data-title="Component Quality">Components:</span> <?php echo get_the_term_list( $post->ID, 'components', '', ', ', '' ); ?></dt>
	<dd class="<?php $terms_as_text = get_the_term_list( $post->ID, 'components', '', ', ', '' ) ; echo 'term'.strip_tags($terms_as_text); ?>"></dd>
	
	<dt><span class="define" rel="popover" data-placement="bottom" data-trigger="hover" data-content="(5=Highest quality) How clear, complete, and polished is the documentation? Some of the best instructions, like from Makey award-winner Lego, don’t use words, so they can be understood by anyone." data-title="Documentation Quality">Documentation:</span> <?php echo get_the_term_list( $post->ID, 'documentation', '', ', ', '' ); ?></dt>
	<dd class="<?php $terms_as_text = get_the_term_list( $post->ID, 'documentation', '', ', ', '' ) ; echo 'term'.strip_tags($terms_as_text); ?>"></dd>
	
	<dt><span class="define" rel="popover" data-placement="bottom" data-trigger="hover" data-content="(5=Most community) How much of a community is there around the kit? Are there builder groups, online forums, circles, and meetups? Is the kit used in class- rooms or after-school programs? Do the kit makers or builders have a presence at events like Maker Faire?" data-title="Community Quality">Community:</span> <?php echo get_the_term_list( $post->ID, 'community', '', ', ', '' ); ?></dt>
	<dd class="<?php $terms_as_text = get_the_term_list( $post->ID, 'community', '', ', ', '' ) ; echo 'term'.strip_tags($terms_as_text); ?>"></dd>

	<dt><span class="define" rel="popover" data-placement="bottom" data-trigger="hover" data-content="(5=Most complete) How complete is the kit? Plans only? That rates a 1. Parts bundles and kits rate 2–5, depending on whether it’s just key components, almost every- thing, or absolutely everything you need, including any unusual tools." data-title="Completeness">Completeness:</span> <?php echo get_the_term_list( $post->ID, 'completeness', '', ', ', '' ); ?></dt>
	<dd class="<?php $terms_as_text = get_the_term_list( $post->ID, 'completeness', '', ', ', '' ) ; echo 'term'.strip_tags($terms_as_text); ?>"></dd>
</dl>

<p class="the_tags"> 
	<?php the_tags('<strong>TAGS:</strong> '); ?>
</p>

<p class="date">Reviewed: <?php the_date(); ?></p>

<iframe src="//www.facebook.com/plugins/like.php?href= <?php echo urlencode(get_permalink()); ?>&amp;send=false&amp;layout=button_count&amp;width=183&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=171225639607468" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:183px; height:21px;" allowTransparency="true"></iframe>
								
							
</div>

<?php 

return ob_get_clean();

}

function js_add_review($content) {
	global $post;
		$original = $content;
		$content = js_ratings_box();
		$content .= $original;
	return $content;
}

//add_filter( 'the_content', 'js_add_review', 15 );

//Comments

function js_kit_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 50 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'kit_comments' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'kit_comments' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'kit_comments' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'kit_comments' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'kit_comments' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'kit_comments' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}

//Custom Field Hacks

$field_data = array (
	'Meta' => array (
		'fields' => array(
			'CompanyURL' 				=> array(),
			'ProductURL'				=> array(),
			'Price'						=> array(),
			'MakeProjectsGuideNumber'	=> array(),
		),
	'title'		=> 'Reviews Meta',
	'context'	=> 'advanced',
	'pages'		=> array( 'review' ),
	),
);
// $easy_cf = new Easy_CF($field_data);


/** catch a description for the OG protocol **/
function js_catch_that_desc() {
	global $post;
	$meta = strip_tags($post->post_content);
	$meta = str_replace(array("\n", "\r", "\t"), ' ', $meta);
	$meta = substr(trim($meta), 0, 200);
	$meta= htmlentities($meta);
	return($meta);
}
/** END **/


function js_enqueue_jquery() {
	wp_enqueue_script( 'jquery' );
}

add_action( 'wp_enqueue_scripts', 'js_enqueue_jquery' );



//Here we go with the Make: Projects APi

function js_make_project($guide) { 
	global $post;
	$guide = get_post_custom_values('MakeProjectsGuideNumber');

$url = 'http://makeprojects.com/api/0.1/guide/'.$guide[0];
$json = wpcom_vip_file_get_contents($url);
$json_output = json_decode($json);
// Don't print anything if we didn't get a good response
if ( !is_object( $json_output ) )
	return;
ob_start();
echo '<div class="clear"></div><p class="alert alert-info">';
echo '<a href="' . esc_url( $json_output->url ) . '"><img src="';
echo bloginfo('stylesheet_directory');
echo '/images/proj.jpg" class="pull-right thumbnail" style="padding:10px; background-color:#fff;" alt="Make: Projects" /></a>';
echo 'Check out this full <a href="' . esc_url( $json_output->url ) . '">' . esc_html( $json_output->guide->title ) . '</a> build from <a href="http://makeprojects.com">Make: Projects</a>, where you can find hundreds of project how-tos, techniques, and an active community of makers.</p>';
echo '<p class="summary">' . esc_html( $json_output->guide->summary ) . '</p>';
echo '<p><strong>Author</strong>: ' . esc_html( $json_output->guide->author->text );
echo ' <strong>Time Required</strong>: ' . esc_html( $json_output->guide->time_required );
echo ' <strong>Difficulty</strong>: ' . esc_html( $json_output->guide->difficulty ) . '</p>'; ?>

<div class="">

<img src="<?php echo esc_url( $json_output->guide->image->text ); ?>.standard" class="thumbnail pull-right" alt="<?php echo esc_attr( $json_output->guide->title ); ?>" align="right" />
<?php echo '<div class="summary">' . wp_kses_post( $json_output->guide->introduction_rendered ) .'</div>' ?>

<div class="clear"></div>

</div>		

<div class="row-fluid">

<div class="span6">

	<?php 
		$steps = $json_output->guide->steps;
		if (!empty($steps)) {		
			echo '<h5>Build Steps</h5><ol>';
			foreach ($steps as $step) {
				echo '<li>';
				echo '<a href="#' . esc_attr( $step->number ) . '">';
				echo esc_html( $step->title );
				echo '</a></li>';
			}
			echo '</ol>';
		}
	?>
	
</div>

<div class="span6">

	<?php 
		$documents = $json_output->guide->documents;
		if (!empty($documents)) {
			echo '<strong>Files</strong><ul>';
			foreach ($documents as $document) {
				echo '<li>';
				echo '<a href="' . esc_url( $document->url ) . '">';
				echo esc_html( $document->text );
				echo '</a></li>';
			}
			echo '</ul>';
		}		
	?>

</div>

</div>

<div class="clear"></div>
	<?php 
	$i = 0;
	foreach ($steps as $step) {
		//var_dump($step);
		echo '<div class="row-fluid project" id="' . esc_attr( $step->number ) . '">';
		echo '<div class="span6 big_images">';
			$images = $step->images;
			foreach ($images as $image) {
				//var_dump($image);
				echo '<img src="';
				echo esc_url( $image->text );
				echo '.standard" class="thumbnail item' . esc_attr( $image->imageid ) . ' ' . esc_attr( $image->orderby ) .'" style="width:280px; margin-bottom:10px;" />';
			}
		echo '</div><!--.big_images-->';
		echo '<div class="span6 right_column">';
		$images = $step->images;
		echo '<div class="row-fluid">';
		$number = count($images);
		if ($number > 1) {
			$images = $step->images;
			foreach ($images as $image) {
				echo '<div class="span3" style="margin-right:20px;">';
				echo '<img src="';
				echo esc_url( $image->text );
				echo '.thumbnail" class="thumbnail ' . esc_attr( $image->imageid ) . ' ' . esc_attr( $image->orderby ) . '" />';
				echo '</div>';
			}
		}
		echo '</div>';

		$lines = $step->lines;
		echo '<h3 class="clear">Step #' . esc_html( $step->number ) . ' ' . esc_html( $step->title ) . '</h3>';
		echo '<ol>';
		foreach ($lines as $line) {
			//var_dump($line);
			echo '<li>';
			echo wp_kses_post( $line->text );
			echo '</li>';
			}
		echo '</ol>';
		echo '</div><!--.right_column-->';
		echo '<div class="clear"></div><!--.clear-->';
		echo '</div><!--.project - Step #' . esc_html( $step->number ) .'-->';
		if (++$i == 999) break;

	}
	echo '<div class="conclusion">';
	echo wp_kses_post( $json_output->guide->conclusion ) ;
	echo '</div>';
return ob_get_clean();
}


add_filter('comment_form_defaults','js_change_reply');

function js_change_reply($defaults) {
	$defaults['title_reply'] = 'Your Thoughts?';
	return $defaults;
}

function make_post_add_review($content) {
	global $post;
	if ('post' == get_post_type()) {
		$guide = get_post_custom_values('MakeProjectsGuideNumber');
		if (isset($guide[0])) {
			$content .= js_make_project($guide);
		}
		return $content;
	} else {
		return $content;
	}
}

//add_filter( 'the_content', 'make_post_add_review' );

//add_filter('the_excerpt_rss', 'make_post_add_review');

function new_js_add_review($content) {
	global $post;
	$meta = get_post_meta( get_the_ID(), 'hide' );
	if ( array('review', 'volume' ) == get_post_type() && (empty($meta[0]) == 'on') ) {
		$content = js_ratings_box().$content;
		$guide = get_post_custom_values('MakeProjectsGuideNumber');
		if (isset($guide[0])) {
			$content .= js_make_project($guide);
		}
		return $content;
	} else {
		return $content;
	}
}

//add_filter( 'the_content', 'new_js_add_review' );

//add_filter('the_excerpt_rss', 'new_js_add_review');

// vip_redirects( array('/kitguide' => 'https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&amp;PK=M21KTAD') );

$field_data = array (
	'Kit' => array (
		'fields' => array(
			'hide' => array(
				'label' => 'Check to hide the review box',
				'type' => 'toggle',
				),
		),
	'title'		=> 'Kit or Tool Review',
	'context'	=> 'side',
	'pages'		=> array( 'review' ),
	),
);

// $easy_cf = new Easy_CF($field_data);


// if ( !class_exists( "Easy_CF_Field_Toggle" ) ) {
// 	class Easy_CF_Field_Toggle extends Easy_CF_Field {
// 		public function print_form() {
// 			$class = ( empty( $this->_field_data['class'] ) ) ? $this->_field_data['id'] . '_class' :  $this->_field_data['class'];
// 			$input_class = ( empty( $this->_field_data['input_class'] ) ) ? $this->_field_data['id'] . '_input_class' :  $this->_field_data['input_class'];

// 			$id = ( empty( $this->_field_data['id'] ) ) ? $this->_field_data['id'] :  $this->_field_data['id'];
// 			$label = ( empty( $this->_field_data['label'] ) ) ? $this->_field_data['id'] :  $this->_field_data['label'];
// 			$value = $this->get();
// 			$hint = ( empty( $this->_field_data['hint'] ) ) ? '' :  '<p><em>' . $this->_field_data['hint'] . '</em></p>';

// 			$admin_only = ( empty( $this->_field_data['args']['admin_only'] ) ) ? false : $this->_field_data['args']['admin_only'];
			
// 			$admin_only_notice = $admin_only ? '(Admin Only!)' : '';

// 			$label_format =
// 				'<div class="%s">'.
// 				'<p><strong>%s %s</strong>'.
// 				'%s'.
// 				'<p><label for="%s"><input type="checkbox" name="%s" %s /><strong>Yes</strong></label></p>'.
// 				'</div>';
// 			if ( ! $admin_only || ($admin_only && current_user_can('manage_options') ) )
// 				printf( $label_format, $class, $label, $admin_only_notice, $hint, $id, $id, checked($value, 1));
// 			else
// 				echo '<input type="hidden" name="' . $id . '" value="' . $value . '" />';
// 		}
// 	}
// }

add_action('add_meta_boxes', 'make_review_add_meta_box');

function make_review_add_meta_box() { 
	add_meta_box('volume-parent', 'Magazine Volume', 'make_magazine_parent_page', 'review', 'side', 'high');
}

add_action( 'admin_menu', 'make_review_remove_parent_meta_box' );

function make_review_remove_parent_meta_box() { 
	remove_meta_box('pageparentdiv', 'review', 'normal');
}


function make_printer_makershed_thing() {
	$output = '<div class="well features">
							
		<h3>In The <a href="http://makershed.com">Maker Shed</a></h3>
		
		<div class="row-fluid">
		
			<div class="span3">
				
				<a href="http://www.makershed.com/Printrbot_LC_Plus_3D_Printer_Kit_p/dspb3.htm">
					<img width="125" src="' . get_stylesheet_directory_uri() . '/img/printrbot.jpg" />
				</a>
				
				<div class="blurb">
				
					<h4><a href="http://www.makershed.com/Printrbot_LC_Plus_3D_Printer_Kit_p/dspb3.htm">Printrbot LC Plus 3D - $699</a></h4>
					
				</div>
				
			</div>
			
			<div class="span3">
				
				<a href="http://www.makershed.com/Afinia_H_Series_3D_Printer_p/dsaf1.htm">
					<img width="125" src="' . get_stylesheet_directory_uri() . '/img/affinia.jpg" />
				</a>
				
				<div class="blurb">
				
					<h4><a href="http://www.makershed.com/Afinia_H_Series_3D_Printer_p/dsaf1.htm">Afinia H-Series 3D Printer - $1,499</a></h4>
					
				</div>
				
			</div>
			
			<div class="span3">
				
				<a href="http://www.makershed.com/MakerBot_Replicator_Dual_Extruder_3D_Printer_p/dsmb02-de.htm">
					<img width="125" src="' . get_stylesheet_directory_uri() . '/img/replicator.jpg" />
				</a>
				
				<div class="blurb">
				
					<h4><a href="http://www.makershed.com/MakerBot_Replicator_Dual_Extruder_3D_Printer_p/dsmb02-de.htm">MakerBot Replicator Dual Extruder 3D Printer - $1,749</a></h4>
					
				</div>
				
			</div>
			
			<div class="span3">
				
				<a href="http://www.makershed.com/Make_Ultimate_Guide_to_3D_Printing_p/1449357377.htm">
					<img width="125" src="' . get_stylesheet_directory_uri() . '/img/makesip.jpg" />
				</a>
				
				<div class="blurb">
				
					<h4><a href="http://www.makershed.com/Make_Ultimate_Guide_to_3D_Printing_p/1449357377.htm">Make: Ultimate Guide to 3D Printing - $9.99</a></h4>
				
				</div>
				
			</div>
			
		</div>
		
	</div>';
	return $output;
}