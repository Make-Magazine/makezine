<?php

add_action( 'init', 'register_cpt_errata' );

function register_cpt_errata() {

	add_rewrite_rule( 'errata/([^/]*)/([^/]*)/?$','index.php?errata=$matches[2]','top' );

	$labels = array( 
		'name' => _x( 'Errata', 'errata' ),
		'singular_name' => _x( 'Erratum', 'errata' ),
		'add_new' => _x( 'Add New', 'errata' ),
		'add_new_item' => _x( 'Add New Erratum', 'errata' ),
		'edit_item' => _x( 'Edit Erratum', 'errata' ),
		'new_item' => _x( 'New Erratum', 'errata' ),
		'view_item' => _x( 'View Erratum', 'errata' ),
		'search_items' => _x( 'Search Errata', 'errata' ),
		'not_found' => _x( 'No errata found', 'errata' ),
		'not_found_in_trash' => _x( 'No errata found in Trash', 'errata' ),
		'parent_item_colon' => _x( 'Parent Erratum:', 'errata' ),
		'menu_name' => _x( 'Errata', 'errata' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => true,
		'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
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
		'menu_position' => 47,
	);

	register_post_type( 'errata', $args );
}

add_action('add_meta_boxes', 'make_errata_add_meta_box');

function make_errata_add_meta_box() { 
	add_meta_box('volume-parent', 'Magazine Volume', 'make_magazine_parent_page', 'errata', 'side', 'high');
}

add_action( 'admin_menu', 'make_errata_remove_parent_meta_box' );

function make_errata_remove_parent_meta_box() { 
	remove_meta_box('pageparentdiv', 'errata', 'normal');
}

function make_magazine_errata( $title = 'Errata' ) {
	global $post;
	$args = array(
		'post_parent' => $post->ID,
		'no_found_rows' => true,
		'post_type' => 'errata',
		'posts_per_page'=>-1,
		'orderby' => 'name',
		'order' => 'asc'
	);
	
	$the_query = new WP_Query( $args );

	// Need a way to filter out the title if there are no results in the query.
	if($post->post_parent == 0 && !empty($the_query->posts) ) {
		echo '<h3>'. $title .'</h3>';
		//print_r($the_query);
	}

	while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

		<section <?php post_class(); ?>>

				<h4><a class="red" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

				<p><?php the_excerpt(); ?></p>

		</section> 

	<?php endwhile;

	// Reset Post Data
	wp_reset_postdata();

}