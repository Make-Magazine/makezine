<?php
WP_CLI::add_command( 'makeblog', 'MAKE_CLI' );

class MAKE_CLI extends WP_CLI_Command {

	/**
	 * Convert a category to a tag
	 * Create a new term, and then assign all posts the tag
	 *
	 * @subcommand copy-category-to-tag
	 * @synopsis <category-name>
	 */
	public function copy_category_to_tag( $args, $assoc_args ) {

		list( $slug ) = $args;

		$category = get_term_by( 'slug', $slug, 'category' );
		if ( ! $category )
			WP_CLI::error( "'{$slug}' isn't a valid category slug" );

		$tag = get_term_by( 'name', $category->name, 'post_tag' );
		if ( ! $tag ) {
			$tag = wp_insert_term( $category->name, 'post_tag' );
			$tag = get_term_by( 'id', $tag['term_id'], 'post_tag' );
			WP_CLI::line( "Created a tag for '{$tag->name}'" );
		}

		$args = array(
			'category__in' => array( $category->term_id ),

			'posts_per_page' => 1000,
			'offset' => 0,

			'post_type' => 'any',

			// Prevent new posts from affecting the order
			'orderby' => 'ID',
			'order' => 'ASC',

			// Speed this up
			'no_found_rows' => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
		);

		// Get the first set of posts
		$query = new WP_Query( $args );

		$found_posts = 0;

		WP_CLI::line( "Adding '{$tag->name}' as a tag to posts in the category of the same name" );

		// Start looping through chunks of posts
		while ( $query->have_posts() ) {

			foreach ( $query->posts as $post ) {
				WP_CLI::out('.');
				$found_posts++;

				wp_set_object_terms( $post->ID, array( $tag->slug ), 'post_tag', true );
			}

			$this->free_up_memory();

			// Get more posts to process
			$args['offset'] = $args['offset'] + $args['posts_per_page'] ;
			$query = new WP_Query( $args );
		}

		WP_CLI::line( '' );
		WP_CLI::success( "All done. {$found_posts} posts were affected" );

	}

	/**
	 * Merge category
	 *
	 * @subcommand merge-category
	 * @synopsis <from-slug> <to-slug>
	 */
	public function merge_category( $args, $assoc_args ) {

		list( $from, $to ) = $args;

		$from_cat = get_term_by( 'slug', $from, 'category' );
		if ( ! $from_cat )
			WP_CLI::error( "No from category with slug '{$from}'" );

		$to_cat = get_term_by( 'slug', $to, 'category' );
		if ( ! $to_cat )
			WP_CLI::error( "No to category with slug '{$to}'" );

		WP_CLI::line( "Merging '{$from}' to '{$to}'" );
		wp_delete_term( $from_cat->term_id, 'category', array( 'default' => $to_cat->term_id, 'force_default' => true ) );
		WP_CLI::success( "Merge complete" );
	}

	/**
	 * Delete category
	 *
	 * @subcommand delete-category
	 * @synopsis <slug>
	 */
	public function delete_category( $args, $assoc_args ) {

		list( $slug ) = $args;

		$category = get_term_by( 'slug', $slug, 'category' );
		if ( ! $category )
			WP_CLI::error( "No category with slug '{$slug}'" );

		wp_delete_term( $category->term_id, 'category' );
		WP_CLI::success( "Delete complete" );
	}

	/**
	 * Migrate makemagazineuser's posts to guest author profiles
	 *
	 * @subcommand migrate-author-posts
	 */
	public function migrate_author_posts() {
		global $wpdb, $coauthors_plus;

		$post_ids = $wpdb->get_col( "SELECT ID FROM $wpdb->posts WHERE post_author=29763769 AND post_type='projects' AND post_status='publish'" );
		WP_CLI::line( "Checking " . count( $post_ids ) . " posts to maybe update authors" );
		$affected = 0;
		foreach( $post_ids as $post_id ) {
			$coauthors = get_coauthors( $post_id );
			$user_logins = wp_list_pluck( $coauthors, 'user_login' );
			if ( ! empty( $user_logins ) && ! in_array( 'makemagazineuser', $user_logins ) ) {
				WP_CLI::line( "Skipping: Post #{$post_id} already has these coauthors: " . implode( ', ', $user_logins ) );
				continue;
			}
			$original_import_author = get_post_meta( $post_id, '_original_import_author', true );
			if ( ! $original_import_author ) {
				WP_CLI::line( "Error: No _original_import_author found for post #{$post_id}" );
				continue;
			}
			$guest_login = sanitize_title( $original_import_author );
			$guest_author = $coauthors_plus->guest_authors->get_guest_author_by( 'user_login', $guest_login );
			if ( ! $guest_author ) {
				$coauthors_plus->guest_authors->create( array( 'display_name' => $original_import_author, 'user_login' => $guest_login ) );
				$guest_author = $coauthors_plus->guest_authors->get_guest_author_by( 'user_login', $guest_login );
				if ( is_wp_error( $guest_author ) ) {

					continue;
				}
				WP_CLI::line( "---> Created guest author profile for {$original_import_author}" );
			}
			$coauthors_plus->add_coauthors( $post_id, array( $guest_login ) );
			WP_CLI::line( "Added: Post #{$post_id} is now assigned to {$original_import_author}" );
			$affected++;

			if ( $affected && $affected % 10 == 0 )
				sleep( 3 );
		}
		WP_CLI::success( "All done! {$affected} posts were updated" );

	}

	private function free_up_memory() {
		global $wpdb, $wp_object_cache;
		$wpdb->queries = array(); // or define( 'WP_IMPORTING', true );
		if ( ! is_object( $wp_object_cache ) )
			return;
		$wp_object_cache->group_ops = array();
		$wp_object_cache->stats = array();
		$wp_object_cache->memcache_debug = array();
		$wp_object_cache->cache = array();
		$wp_object_cache->__remoteset(); // important
	}
}