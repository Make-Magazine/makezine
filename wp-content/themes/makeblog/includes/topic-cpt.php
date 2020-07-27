<?php 

add_action( 'init', 'topic_post_type' );

function topic_post_type() {
	$args = array(
			'labels' => array(
				'name' => __( 'Topic' ),
				'singular_name' => __( 'Topic' ),
				'add_new' => __( 'Add New' ),
				'add_new_item' => __( 'Add New Topic Page' ),
				'edit' => __( 'Edit' ),
				'edit_item' => __( 'Edit Topic Page' ),
				'new_item' => __( 'New Topic Page' ),
				'view' => __( 'View Topic' ),
				'view_item' => __( 'View Topic Page' ),
				'search_items' => __( 'Search Topic Pages' ),
				'not_found' => __( 'No Topic Pages Found...' ),
				'not_found_in_trash' => __( 'No Topic Pages found in trash...' ),
				'parent' => __( 'Parent Topic' ),
			),
			'public' => true,
			'description' => __( 'Landing Pages for specific categories for custom displays.' ),
			'public' => true,
			'show_ui' => true,
			'has_archive'=> true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
		    'show_in_rest' => true,
			'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
			'rewrite' => array( 'slug' => 'topic', 'with_front' => false ),
			'taxonomies' => array( 'post_tag', 'category' ),
			'menu_position' => 50,
			'register_meta_box_cb' => 'register_post_list_metabox',
		);
	register_post_type( 'topic', $args );
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Categories list in multiple color background
 *
 * @since 1.0.0
 */
function news_vibrant_post_categories_list( $get_count ) {
	global $post;
	$post_id = $post->ID;
	$categories_list = get_the_category( $post_id );
	if( !empty( $categories_list ) ) {
?>
	<div class="post-cats-list">
		<?php
			$cat_count = 0;
			foreach ( $categories_list as $cat_data ) {
				if( $cat_count < $get_count ) {
					$cat_name = $cat_data->name;
					$cat_id = $cat_data->term_id;
					$cat_link = get_category_link( $cat_id );
		?>
					<span class="category-button nv-cat-<?php echo esc_attr( $cat_id ); ?>"><a href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $cat_name ); ?></a></span>
		<?php
				}
				$cat_count++;
			}
		?>
	</div><!-- .post-cats-list -->
<?php
	}
}

/*-----------------------------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'news_vibrant_inner_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function news_vibrant_inner_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( ' %s', 'post date', 'news-vibrant-pro' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( ' %s', 'post author', 'news-vibrant-pro' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">By ' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'news_vibrant_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function news_vibrant_entry_footer() {
	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'news-vibrant-pro' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;