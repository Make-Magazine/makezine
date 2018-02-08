<?php

/**
 * The function to display author/maker bios
 *
 * @version  1.2
 * @author  Cole Geissinger <cgeissinger@makermedia.com>
 *
 */


class Make_Authors {

	/**
	 * Get our authors information via Gravatar
	 * @return Object
	 *
	 * @version  1.1
	 * @since    1.0
	 */
	public function get_author_data() {
		global $authordata;
		// Get the true author data
		$author = $authordata;

		if ( ! empty( $author ) ) {

			// If the user account is a guest-author, then it will always be used over Gravatar data
			if ( isset($author->data->user_email) || isset($author->user_email) ) { // Author account is linked, so we'll make sure we ignor Gravatar and pull from the guest author account
			{ // If no type is passed, then we'll check for Gravatar information
				$email = (isset($author->data->user_email)) ? $author->data->user_email : $author->user_email;

				// We need to hash out the email so we can properlly and securely request the right Gravatar account
				$hash = md5( strtolower( trim( $email ) ) );
				$url_gravatar = esc_url( 'https://www.gravatar.com/' . $hash . '.json');
				// Request the data from gravatar
				$output = wp_remote_get( esc_url( $url_gravatar )  );
				$gdata = $output['body'];
					
				// Make sure data was actually returned
				if ( $gdata ) {
				 	$profile = json_decode( $gdata );
					$authordata = $profile->entry[0];
 					return $profile->entry[0];
				} else {
					// well, it seems Gravatar returned empty... let's pull from WordPress then.
					//$author = get_userdata( absint( $author->ID ) );

					return $author;
				}
			}
			}
			elseif ($author->type === 'guest-author' ) {
				return $author;
				}
			else {
				return false;
				}
		} else {
			return false;
		}
	}
	public function get_post_author_data($newAuthor) {
		// Get the true author data
		$author = $newAuthor;
		
		if ( ! empty( $author ) ) {
			// If the user account is a guest-author, then it will always be used over Gravatar data
			if ( isset($author->data->user_email) || isset($author->user_email) ) 
			{ // Author account is linked, so we'll make sure we ignor Gravatar and pull from the guest author account
			 // If no type is passed, then we'll check for Gravatar information
				$email = (isset($author->data->user_email)) ? $author->data->user_email : $author->user_email;
			
				// We need to hash out the email so we can properlly and securely request the right Gravatar account
				$hash = md5( strtolower( trim( $email ) ) );
				$url_gravatar = esc_url( 'https://www.gravatar.com/' . $hash . '.json');
				// Request the data from gravatar
				$output = wp_remote_get( esc_url( $url_gravatar )  );
				$gdata = $output['body'];
				
				// Make sure data was actually returned
				if ( $gdata ) {
				 	$profile = json_decode( $gdata );
					$authordata = $profile->entry[0];
					$author = $authordata;
				} else {
					// well, it seems Gravatar returned empty... let's pull from WordPress then.
					//$author = get_userdata( absint( $author->ID ) );
					$author = $author;
				}
			}
			
			elseif ($author->type === 'guest-author' ) {
				$author = $author;
			}
			else {
				$author = false;
			}
		} else {
			$author = false;
		}
		return $author;
	}



	/**
	 * Generates the HTML output of the author profile header
	 * @return html
	 *
	 * @version 1.0
	 * @since   1.1
	 */
	public function author_twitter($newAuthor, $authorID) {
		$author = $this->get_post_author_data($newAuthor);
		$user_id = $authorID;
		$key = 'twitter';
		$single = true;
		$user_twitter = get_user_meta( $user_id, $key, $single );
		// Load this if we have either a list of links from Gravatar or a single website from Guest Authors
		// Update our URLs into a one variable so we have less code. First is Gravatar, second is Guest Authors which only allows one option.
		$output = '';
		if ( isset( $author->accounts ) ) {
			// Add social media accounts
			foreach ( $author->accounts as $account ) {
				// Update the Google URL so we can do some Author appeneding magic stuff?
				if ( $account->shortname === 'twitter' ) {
					$str          = esc_url( $account->url . '?rel=author' );
					$result       = substr( $str, strpos( $str, 'com/' ) + 4, strlen( $str ) );
					$string_array = explode( "?", $result );
					$output .= '<a class="' . esc_attr( $account->shortname ) . '" href="' . esc_url( $account->url . '?rel=author' ) . '"><i class="fa fa-twitter"></i></a>';
					if(strlen($user_twitter) == 0){
						$output .= '<a class="twitter" href="' . esc_url( $account->url . '?rel=author' ) . '"><h3 class="twitter-nickname">@';
						$output .= $string_array[0];
						$output .= '</h3></a>';
					} else {
						$output .= '<a class="twitter" href="' . esc_url( $account->url . '?rel=author' ) . '"><h3 class="twitter-nickname users">@';
						$output .= $user_twitter;
						$output .= '</h3></a>';
					}

				}

			}

		} else {

			if ( isset( $author->urls ) || isset( $author->website ) ) {

				// Update our URLs into a one variable so we have less code. First is Gravatar, second is Guest Authors which only allows one option.
				if ( isset( $author->urls ) ) {
					$urls = $author->urls;
					foreach ( $urls as $url ) {
						$haystack = $url->value;
						$needle   = 'https://twitter';
						$pos      = strripos( $haystack, $needle );
						if ( $pos !== false ) {
							$output .= '<a class="twitter" href="' . esc_url( $url->value ) . '"><i class="fa fa-twitter"></i></a>';
							$str    = esc_url( $url->value );
							$result = substr( $str, strpos( $str, 'com/' ) + 4, strlen( $str ) );
							if(strlen($user_twitter) == 0){
								$output .= '<a class="twitter" href="' . esc_url( $url->value ) . '"><h3 class="twitter-nickname">@';
								$output .= $result;
								$output .= '</h3></a>';
							} else {
								$output .= '<a class="twitter" href="' . esc_url( $url->value ) . '"><h3 class="twitter-nickname users">@';
								$output .= $user_twitter;
								$output .= '</h3></a>';
							}

						}
					}
				}
			}

		}

		return $output;
	}

	public function author_profile($author) {
		
		// Get the true author data
		if ( $author ) : ?>
			<div class="col-xs-12 col-sm-4">
				<?php echo $this->author_avatar( $author ); ?>
			</div>
			<div class="col-xs-12 col-sm-8 author-profile-bio">
				<h1 itemprop="name" class="jumbo"><?php echo esc_html( $this->author_name( $author ) ); ?></h1>
				<?php echo '<div itemprop="description">' . $this->author_bio( $author ) . '</div>'; ?>
				<?php echo $this->author_contact_info( $author ); ?>
				<?php echo '<div itemprop="url">' . $this->author_urls( $author ) . '</div>'; ?>
			</div>
		<?php else : ?>
			<div class="col-xs-12 author-profile-bio">
				<h1 class="jumbo">Author profile could not be found!</h1>
			</div>
		<?php endif; ?>
	<?php }

	/**
	 * Generates the HTML output of the author profile header
	 * @return html
	 *
	 * @version 1.1
	 * @since   1.1
	 */
	public function author_block( $newauthor ) {
    global $authordata;
	
		// Get the true author data
		$author = $authordata;
			// Let's get this going...
		$output = '<div class="row">';
		$output .= '<div class="col-xs-12 col-sm-3">';
		// Grab the image.
		$output .= $this->author_avatar( $author, 198 );
		$output .= '</div>';
		$output .= '<div class="col-xs-12 col-sm-9 -author-profile-bio">';
		// Author name
		$output .= '<h3 class="jumbo"><a href="' . esc_url( home_url( 'author/' . $newauthor->user_nicename ) ) . '" itemprop="author">' . esc_html( $this->author_name( $author ) ) . '</a></h3>';
		
		$output .= $this->author_bio( $author );
		$output .= $this->author_contact_info( $author );
		$output .= $this->author_urls( $author );
		
		$output .= '</div>';
		$output .= '</div>';
		$output .= '<hr>';
		return $output;
	}
	public function author_block_generic( $newauthor,$authorID ) {

		$output = '';
		$output .= '<div class="row mz-author-row"><div class="col-xs-12 col-sm-3 col-lg-2 mz-author-img">';
		$output .= $this->author_avatar( $newauthor, 396 );
		$output .= '</div><div class="col-xs-12 col-sm-9 col-lg-10 -author-profile-bio">';
		$output .= '<h3 class="jumbo"><a href="' . esc_url( home_url( 'author/' . $newauthor->user_nicename ) ) . '">' . esc_html(  $newauthor->display_name ) . '</a></h3>';
		$output .= '</h3><p>';
		// Return the Guest Author information.
		$output .= $this->author_bio( $newauthor );
		$output .= '<p></div></div>';

		return $output;
	}
	public function author_block_story( $newauthor,$authorID ) {
	 	// Let's get this going...
		$output = '';
		$output .= '<div class="author-wrapper"><div class="col-md-3 avatar">';
		$output .= $this->author_avatar( $newauthor, 198 );
		$output .= '<div class="hover-info"><i class="fa fa-sort-asc sort-up fa-lg"></i><div class="author-wrapper">';
		$output .= '<div class="author-name">';
		$output .= '<h3><a href="' . esc_url( home_url( 'author/' . $newauthor->user_nicename ) ) . '">' . esc_html(  $newauthor->display_name ) . '</a></h3>';
		$output .= '</div></div>';
		// Return the Guest Author information.
		$output .= $this->author_bio( $newauthor );
		$output .= '<a href="' . esc_url( home_url( 'author/' . $newauthor->user_nicename ) ) . '">View more articles by ' . esc_html( $newauthor->display_name ) . ' <i class="fa fa-angle-right" aria-hidden="true"></i></a>';
		$output .= '</div></div>';
		$output .= '<div class="author-name">';
		$output .= '<div class="bio-wrapper"><h3><a href="' . esc_url( home_url( 'author/' . $newauthor->user_nicename ) ) . '"><span class="black">By</span> ' . esc_html( $newauthor->display_name ) . '</a></h3>';

		$output .= '<div class="hover-info"><i class="fa fa-sort-asc sort-up fa-lg"></i><div class="author-wrapper">';
		$output .= '<div class="author-name">';
		$output .= '<h3><a href="' . esc_url( home_url( 'author/' . $newauthor->user_nicename ) ) . '">' . esc_html( $newauthor->display_name ) . '</a></h3>';
		$output .= '</div></div>';
		// Return the Guest Author information.
		$output .= $this->author_bio( $newauthor );
		$output .= '<a href="' . esc_url( home_url( 'author/' . $newauthor->user_nicename ) ) . '">View more articles by ' . esc_html( $newauthor->display_name ) . ' <i class="fa fa-angle-right" aria-hidden="true"></i></a>';
		$output .= '</div></div>';
		$output .= '<div class="twitter-wrapper">';
		$output .=  $this->author_twitter($newauthor ,$authorID);
		$output .= '</div></div></div>';

		return $output;
	}
	/**
	 * Returns the profile photo of the author
	 * @param  object $author The author object
	 * @return string
	 *
	 * @version  1.1
	 * @since    1.0
	 */
	public function author_avatar( $newauthor, $size = 298 ) {
		$author = $this->get_post_author_data($newauthor);
		$output = '';
		// If we have a Gravatar object, we'll process that, other wise, we need to hook into WordPress
		if ( isset( $author->thumbnailUrl ) ) {
			$url = $author->thumbnailUrl . '?s=' . absint( $size ) . '&d=retro';

			$output = '<img src="' . esc_url( $url ) . '" alt="' . esc_attr( $this->author_name( $author ) ) . '" class="avatar avatar-' . absint( $size ) . '" width="' . absint( $size ) . '" height="' . absint( $size ) . '">';

		} else {
			// Use the featued image if its set, other wise fall to get_avatar which will check for another solution with a fall back to default retro image
			if ( has_post_thumbnail( absint( $newauthor->ID ) ) ) {
				$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $newauthor->ID ) );
				$args = array(
					'resize' => '300,300',
					'quality' => get_photon_img_quality(),
					'strip' => 'all',
				);
				$url = $output = '<img src="' . wpcom_vip_get_resized_remote_image_url( $image_url[0], absint( $size ), absint( $size ) ) . '" alt="' . esc_attr( $this->author_name( $author ) ) . '" class="avatar avatar-' . absint( $size ) . '" width="' . absint( $size ) . '" height="' . absint( $size ) . '">';
				$re = "/^(.*? src=\")(.*?)(\".*)$/m";
				preg_match_all($re, $url, $matches);
				$str = $matches[2][0];
				$photon = jetpack_photon_url($str, $args);
				// $output = get_the_post_thumbnail( absint( $author->ID ), array( absint( $size ), absint( $size ) ), array( 'alt' => esc_attr( $this->author_name( $author ) ), 'class' => 'avatar avatar-absint( $size )' ) );
				$output = '<img src="' . $photon . '" alt="' . esc_attr( $this->author_name( $author ) ) . '" class="avatar avatar-' . absint( $size ) . '" width="' . absint( $size ) . '" height="' . absint( $size ) . '">';
			} else {
				$output = get_avatar( sanitize_email( $author->user_email ), absint( $size ), 'retro', esc_attr( $this->author_name( $author ) ) );
			}
		}
		

		return $output;
	}


	/**
	 * Returns only the data for the author name
	 * @param  object $author The author object
	 * @return string
	 *
	 * @version  1.1
	 * @since    1.0
	 */
	public function author_name( $author ) {
		$output = '';
		if (!is_array($author) &&  empty($author->display_name)) {
			$author = $this->get_post_author_data($author);

			// Get the Display name from Gravatar or from Guest Authors...
			$output = esc_html( $author->display_name );
		}
		return $output;
	}


	/**
	 * Returns the author bio. We can either pass the bio info back in its raw form or return it with auto formatting
	 * @param  object $author The author object
	 * @param  bool   $raw    Allows us to return the bio in its raw format
	 * @return string
	 *
	 * @version 1.1
	 * @since   1.0
	 */
	public function author_bio( $author, $raw = false ) {
		$output = '';
				if ( !is_array( $author ) 
				&& (empty($author->description ) &&  empty($author->aboutMe )))
				
		{
				
					$author = $this->get_post_author_data($author);
					
					}
		// Get the Gravatar bio or return the Guest Author bio
		if ( isset( $author->aboutMe ) ) {
			$output = $author->aboutMe;
		} elseif ( is_array( $author ) && isset( $author['aboutMe'] ) ) {
			$output = $author['aboutMe'];
		} elseif ( is_array( $author ) && isset( $author['description'] ) ) {
			$output = $author['description'];
		} else {
			$output = $author->description;
		}

		// Return the bio with formatting or else return it as it is
		if ( ! $raw && ! empty( $output ) ) {
			return Markdown( $output );
		} else {
			return $output;
		}
	}


	/**
	 * Returns the author social media accounts
	 * @param  object $author The author object
	 * @return string
	 *
	 * @version  1.1
	 * @since    1.0
	 */
	public function author_contact_info( $author ) {

		// Currently Guest Authors does not provide social media links so we'll only pull if Gravatar object is present
		if ( isset( $author->accounts ) ) {
			$output = '<ul class="social clearfix">';

			// Add social media accounts
			foreach ( $author->accounts as $account ) {
				// Update the Google URL so we can do some Author appeneding magic stuff?
				if ( $account->shortname === 'google' ) {
					$output .= '<li class="' . esc_attr( $account->shortname ) . '"><a class="noborder" href="' . esc_url( $account->url . '?rel=author' ) . '"><span class="sp">&nbsp;</span></a></li>';
				} else {
					$output .= '<li class="' . esc_attr( $account->shortname ) . '"><a class="noborder" href="' . esc_url( $account->url ) . '"><span class="sp">&nbsp;</span></a></li>';
				}
			}

			// Add the email if they got it
			if ( isset( $author->emails ) ) {
				foreach ( $author->emails as $email ) {
					$output .= '<li style="background:transparent;position:relative;top:-2px;"><a href="' . esc_attr( antispambot( "mailto:" . $email->value ) ) . '">' . antispambot( $email->value ) . '</a></li>';
				}
			}

			$output .= '</ul>';

			return $output;
		} elseif ( is_array( $author ) && isset( $author['accounts'] ) ) {
			$output = '<ul class="social clearfix">';

			// Add social media accounts
			foreach ( $author['accounts'] as $account ) {
				// Update the Google URL so we can do some Author appeneding magic stuff?
				if ( $account['shortname'] === 'google' ) {
					$output .= '<li class="' . esc_attr( $account['shortname'] ) . '"><a class="noborder" href="' . esc_url( $account['url'] . '?rel=author' ) . '"><span class="sp">&nbsp;</span></a></li>';
				} else {
					$output .= '<li class="' . esc_attr( $account['shortname'] ) . '"><a class="noborder" href="' . esc_url( $account['url'] ) . '"><span class="sp">&nbsp;</span></a></li>';
				}
			}

			// Add the email if they got it
			if ( isset( $author['emails'] ) ) {
				foreach ( $author['emails'] as $email ) {
					$output .= '<li style="background:transparent;position:relative;top:-2px;"><a href="' . esc_attr( antispambot( "mailto:" . $email['value'] ) ) . '">' . antispambot( $email['value'] ) . '</a></li>';
				}
			}

			$output .= '</ul>';

			return $output;
		}
	}


	/**
	 * Returns the author website link
	 * @param  object $author The author object
	 * @return string
	 *
	 * @version 1.1
	 * @since   1.0
	 */
	public function author_urls( $author ) {

		$hash = md5( strtolower( trim( $author->user_email ) ) );
		$str = file_get_contents( 'https://www.gravatar.com/' . $hash . '.php' );
		$profile = unserialize( $str );
		if ( is_array( $profile ) && isset( $profile['entry'] ) ) {
    	$gravatar_urls = $profile['entry'][0]['urls'];
    }

		// Load this if we have either a list of links from Gravatar or a single website from Guest Authors
		if ( isset( $gravatar_urls) || isset( $author->website ) ) {

			$output = '';

			// Update our URLs into a one variable so we have less code. First is Gravatar, second is Guest Authors which only allows one option.
			if ( isset( $gravatar_urls ) ) {
				$urls = $gravatar_urls;
				foreach ( $urls as $url ) {
					if ( ! empty( $url['value'] ) ) {
						$output .= '<p><i class="fa fa-globe" aria-hidden="true"></i> <a href="' . esc_url( $url['value'] ) . '">' . esc_html( $url['title'] ) . '</a></p>';
					}
				}
			} else {
				$urls = array( (object) array( 'title' => 'Website', 'value' => $author->website ) );
				foreach ( $urls as $url ) {
					if ( ! empty( $url->value ) ) {
						$output .= '<p><i class="fa fa-globe" aria-hidden="true"></i> <a href="' . esc_url( $url->value ) . '">' . esc_html( $url->title ) . '</a></p>';
					}
				}
			}

			return $output;
		}

		// So, might come over as an array instead of an object...
		if ( is_array($author) && isset($author['urls'] ) ) {

			$output = '<ul class="links">';

			foreach ( $author['urls'] as $url ) {
				$output .= '<li><a class="noborder" href="' . esc_url( $url['value'] ) . '">' . esc_html( $url['title'] ) . '</a></li>';
			}

			$output .= '</ul>';

			return $output;
		}
	}


	/**
	 * Returns the author email.
	 * For now we will not return emails set in guest authors for privacy reasons. Gravatar will only send them if they are set to public.
	 * @param  object $author The author object
	 * @return string
	 *
	 * @version 1.0
	 * @since   1.1
	 */
	public function author_email( $author ) {

		$output = '';

		if ( isset( $author->emails ) ) {
			foreach ( $author->emails as $email ) {
				$output .= '<a href="' . esc_attr( antispambot( "mailto:" . $email->value ) ) . '">' . antispambot( $email->value ) . '</a>';
			}
		}

		return $output;
	}
}

// Load our class into a handy dandy variable so we can use this in our helper functions.
$make_author_class = new Make_Authors;


/**
 * Helper function to display the HTML output of the top area of the author profile
 * @return html
 *
 * @version 1.0
 * @since   1.1
 */
function make_author_profile( $author = '' ) {
	global $make_author_class;
	
	echo $make_author_class->author_profile( $author );
}

function get_author_profile($type='story') {
	global $make_author_class;
	$authors = get_coauthors();

	// For each author, build a block.
	foreach ( $authors as $author ) {
    if ($type=='story') {
    	return $make_author_class->author_block_story( $author,$author->ID );
    }
	  else {
	    return $make_author_class->author_block_generic( $author,$author->ID );
	  }
	}
}

function make_author_name( $author = '' ) {
	global $make_author_class;
		
	return $make_author_class->author_name( $author );
}


function make_author_avatar() {
	global $make_author_class;

	return $make_author_class->author_photo();
}


function make_author_bio( $author = '' ) {
	global $make_author_class;

	return $make_author_class->author_bio( $author );
}

/**
 * Helper function for returning all of our bio info stuff.
 * @param  String $type   Insert the type of data you want returned
 *         Accepted Para  full - DEFAULT
 *         				  name
 *         				  photo
 *         				  bio
 *         				  social
 *         				  urls
 * @return Mixed
 *
 * @version  1.0
 * @since    1.0
 */

function make_author( $type = 'full' ) {
	global $make_author_class;

	// Get the authors.
	$authors = get_coauthors();

	$output = '';

	// For each author, build a block.
	foreach ($authors as $author ) {
		$output .= $make_author_class->author_block( $author );
	}

	// Send it out to the page.
	return $output;
}

/**
 * This action addresses anyone without posts which can be authors and co-authors.
 * Redirect is now going to generic make-editors page
 * Fixes guest authors with no posts to actually load their profile instead of returning 404
 * As per http://wordpress.org/support/topic/advice-for-showing-author-profile-page-for-authors-without-posts
 * @return void
 */
function capx_template_redirect() {
	global $wp_query;

	if ( false !== stripos( $_SERVER['REQUEST_URI'], '/author' ) && empty( $wp_query->posts ) ) {
		$wp_query->is_404 = false;
		wp_redirect('/author/make-editors/');
		exit;
	}
}
add_action( 'template_redirect', 'capx_template_redirect' );

function create_tag_cloud( $content ) {
	global $wpdb;

	$postid = get_the_ID();
	// Select term_taxonomy_id from relationships table
	$term_tax = $wpdb->get_col("SELECT term_taxonomy_id
        FROM $wpdb->term_relationships WHERE object_id = '$postid'" );
	// Gather terms to relate
	foreach($term_tax as $term_tax_id) {
		// Get term ids
		$term_id2 = $wpdb->get_col("SELECT term_id
            FROM $wpdb->term_taxonomy WHERE term_taxonomy_id = '$term_tax_id' and taxonomy = 'post_tag'" );
		// Gets rid of empty variables
		if (empty($term_id2)) {
			continue;
		}
		else {
			$term_id3[] = $term_id2[0];
		}
	}
	// Get tag names
	foreach($term_id3 as $cats) {
		$the_cats = $wpdb->get_col("SELECT name
            FROM $wpdb->terms WHERE term_id = '$cats'" );
		// Get tag URLs
		$categories[] = $the_cats[0];
		$tag_urls[] = get_tag_link($cats);
	}
	// Build div
	$tag_cloud_div = '';
	$tag_cloud_div .= '<div class="related-topics">';
	$tag_cloud_div .= '<p>Related Topics</p>';
	$tag_cloud_div .= '<ul class="related-topics-ul">';
	foreach (array_combine($categories, $tag_urls) as $category => $tag_url) {
		$tag_cloud_div .= '<li><a href="' . $tag_url . '">#' . $category . '</a></li>';
	}
	$tag_cloud_div .= '</ul>'; // End list
	$tag_cloud_div .= '</div>';
	return $tag_cloud_div;
}

function display_tag_cloud( $content ) {
	global $post;

	if ( class_exists( 'WPCOM_Liveblog' ) ) {
		// There was a check for a post parent to == 0, I pulled that off. --JS
		if( ! WPCOM_Liveblog::is_liveblog_post() && is_single() && is_main_query() && !in_array( get_post_type(),  array( 'page_2', 'projects' ) ) ) {
			$content .= create_tag_cloud();
		}
	} else {
		// There was a check for a post parent to == 0, I pulled that off. --JS
		if( is_single() && is_main_query() && !in_array( get_post_type(),  array( 'page_2', 'projects' ) ) ) {
			$content .= create_tag_cloud();
		}
	}
	return $content;
}

/**
 * Hooks the WP filter coauthors_supported_post_types
 *
 * @filter coauthors_supported_post_types
 * @param $post_types
 *
 **/
add_filter('coauthors_supported_post_types', 'mz_coauthors_supported_post_types');

function mz_coauthors_supported_post_types( $post_types ) {
	$post_types[] = 'products';
	$post_types[] = 'reviews';
	return $post_types;
}
