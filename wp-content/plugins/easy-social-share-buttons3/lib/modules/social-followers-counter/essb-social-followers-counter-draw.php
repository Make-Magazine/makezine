<?php

/**
 * ESSBSocialFollowersCounterDraw
 *
 * Followers counter draw engine
 *
 * @author appscreo
 * @package EasySocialShareButtons
 * @since 3.4
 *
 */
class ESSBSocialFollowersCounterDraw {
	
	public static function network_additional_icon ($social) {
		$r = '';
		
		return $r;
	}

	public static function followers_number($count) {
		$format = essb_followers_option ( 'format' );

		$result = "";

		switch ($format) {
			case 'full' :
				$result = number_format ( $count, 0, '', ',' );
				break;
			case 'fulldot' :
				$result = number_format ( $count, 0, '', '.' );
				break;
			case 'fullspace':
			    $result = number_format( $count, 0, '', ' ');
			    break;
			case 'short' :
				$result = self::followers_number_shorten ( $count );
				break;
			default :
				$result = $count;
				break;
		}

		return $result;
	}

	public static function followers_number_shorten($count) {
		if (! is_numeric ( $count ))
			return $count;

		if ($count >= 1000000) {
			return round ( ($count / 1000) / 1000, 1 ) . "M";
		} elseif ($count >= 100000) {
			return round ( $count / 1000, 0 ) . "k";
		} else if ($count >= 1000) {
			return round ( $count / 1000, 1 ) . "k";
		} else {
			return @number_format ( $count );
		}
	}

	/**
	 * draw_followers_sidebar
	 *
	 * Display social followers sidebar
	 *
	 * @param $options array
	 * @since 4.0
	 */
	public static function draw_followers_sidebar($options) {

		$instance_position = isset ( $options ['position'] ) ? $options ['position'] : '';
		$instance_new_window = 1;
		$instance_nofollow = 1;
		$instance_show_total = isset($options['total']) ? $options['total'] : 0;
		$instance_columns = 1;
		$instance_template = isset ( $options ['template'] ) ? $options ['template'] : 'flat';
		$instance_animation = isset ( $options ['animation'] ) ? $options ['animation'] : '';
		$instance_nospace = isset ( $options ['nospace'] ) ? $options ['nospace'] : 0;
		$instance_button = isset($options['button']) ? $options['button'] : 'h';
		$instance_width = isset($options['width']) ? $options['width'] : '0';
		$width_style = '';
		if (intval($instance_width) > 0) {
			$width_style = ' style="width:'.$instance_width.'px !important;"';
		}

		$instance_hide_value = isset($options['hide_value']) ? $options['hide_value'] : 0;
		$instance_hide_text = isset($options['hide_text']) ? $options['hide_text'] : 0;


		// compatibility with previous template slugs
		if (!empty($instance_template)) {
			if ($instance_template == "lite") {
				$instance_template = "light";
			}
			if ($instance_template == "grey-transparent") {
				$instance_template = "grey";
			}
			if ($instance_template == "color-transparent") {
				$instance_template = "color";
			}
		}

		$class_template = (! empty ( $instance_template )) ? " essbfc-template-" . $instance_template : '';
		$class_animation = (! empty ( $instance_animation )) ? " essbfc-icon-" . $instance_animation : '';
		$class_columns = (! empty ( $instance_columns )) ? " essbfc-col-" . $instance_columns : '';
		$class_nospace = (intval ( $instance_nospace ) == 1) ? " essbfc-nospace" : "";

		$class_nospace .= ' essbfc-sidebar-btn'.$instance_button;

		if (intval($instance_hide_value) == 1) {
			$class_nospace .= ' essbfc-novalue';
		}

		if (intval($instance_hide_text) == 1) {
			$class_nospace .= ' essbfc-notextvalue';
		}

		$class_position = $instance_position == "right" ? " essbfc-sidebar-right" : " essbfc-sidebar-left";

		$link_nofollow = (intval ( $instance_nofollow ) == 1) ? ' rel="nofollow"' : '';
		$link_newwindow = (intval ( $instance_new_window ) == 1) ? ' target="_blank"' : '';

		// loading animations
		if (! empty ( $class_animation )) {
			essb_resource_builder ()->add_static_footer_css ( ESSB3_PLUGIN_URL . '/lib/modules/social-followers-counter/assets/css/hover.css', 'essb-social-followers-counter-animations', 'css' );
		}
		
		// followers main element
		printf ( '<div class="essbfc-container essb-followers-counter essbfc-container-sidebar essbfc-container-sidebar-transition%1$s%2$s%3$s%4$s%5$s">', '', esc_attr($class_columns), esc_attr($class_template), esc_attr($class_nospace), esc_attr($class_position) );

		// get current state of followers counter
		$followers_count = essb_followers_counter ()->get_followers ();

		$display_total = (intval ( $instance_show_total ) == 1) ? true : false;
		$total_followers = 0;
		if ($display_total) {
			foreach ( $followers_count as $network => $count ) {
				if (intval ( $count ) > 0) {
					$total_followers += intval ( $count );
				}
			}
		}

		echo '<ul>';

		$subscribe_salt = mt_rand();
		$draw_subscribe_form = false;
		$subscribe_design = '';
		
		foreach ( essb_followers_counter ()->active_social_networks () as $social ) {
			$social_followers_text = essb_followers_option ( $social . '_text' );
			$social_custom_icon = essb_followers_option($social.'_icon_type');

			if ($social_custom_icon != '') {
				$social_custom_icon = ' essbfc-icon-'.$social.'-'.$social_custom_icon;
			}
			
			$social_custom_icon .= self::network_additional_icon($social);
			
			$social_followers_counter = isset ( $followers_count [$social] ) ? $followers_count [$social] : 0;

			$social_display = $social;
			if ($social_display == "instgram") {
				$social_display = "instagram";
			}


			printf ( '<li class="essbfc-%1$s"%2$s>', esc_attr($social_display), $width_style );

			$follow_url = essb_followers_counter ()->create_follow_address ( $social );
			if (! empty ( $follow_url )) {
			    if ($social == 'subscribe_form') {
			        printf ( '<a href="#"%2$s%3$s data-subscribe-form="%1$s" onclick="essb.toggle_subscribe(\'%4$s\'); return false;">', esc_attr($follow_url), $link_newwindow, $link_nofollow, $subscribe_salt );
			        $subscribe_design = $follow_url;
			        $draw_subscribe_form = true;
			    }
			    else {
				    printf ( '<a href="%1$s"%2$s%3$s>', esc_url($follow_url), $link_newwindow, $link_nofollow );
			    }
			}

			echo '<div class="essbfc-network">';
			printf ( '<i class="essbfc-icon essbfc-icon-%1$s%2$s%3$s"></i>', esc_attr($social_display), esc_attr($class_animation), esc_attr($social_custom_icon) );
			if (intval($social_followers_counter) > 0) {
				printf ( '<span class="essbfc-followers-count">%1$s</span>', esc_attr(self::followers_number ( $social_followers_counter )) );
			}
			else {
				printf ( '<span class="essbfc-followers-count">%1$s</span>', $social_followers_counter );
			}
			printf ( '<span class="essbfc-followers-text">%1$s</span>', $social_followers_text );
			echo '</div>';

			if (! empty ( $follow_url )) {
				echo '</a>';
			}
			echo '</li>';
		}
		
		if ($display_total) {
		    $social = 'total';
		    printf ( '<li class="essbfc-%1$s">', esc_attr($social) );
		    echo '<div class="essbfc-network">';
		    printf ( '<i class="essbfc-icon  essbfc-icon-%1$s%2$s"></i>', esc_attr($social), esc_attr($class_animation) );
		    printf ( '<span class="essbfc-followers-count">%1$s</span>', self::followers_number ( $total_followers ) );
		    printf ( '<span class="essbfc-followers-text">%1$s</span>', essb_followers_option ( 'total_text' ) );
		    echo '</div>';
		    echo '</li>';
		}

		echo '</ul>';

		echo '</div>';
		// followers: end
		
		if ($draw_subscribe_form) {
		    if (!class_exists('ESSBNetworks_Subscribe')) {
		        include_once (ESSB3_PLUGIN_ROOT . 'lib/networks/essb-subscribe.php');
		    }
		    echo ESSBNetworks_Subscribe::draw_popup_subscribe_form($subscribe_design, $subscribe_salt);
		    
		}
	}

	public static function covert_boolean_value($value) {
		$r = 0;

		if ($value === 'yes' || $value === 'true' || intval($value) == 1) {
			$r = 1;
		}

		return $r;
	}

	/**
	 * draw_followers
	 *
	 * Display instance of generated followers counter
	 *
	 * @param $options array
	 * @param $draw_title boolean
	 * @since 3.4
	 */
	public static function draw_followers($options, $draw_title = false, $layout_builder = false) {
		$hide_title = isset ( $options ['hide_title'] ) ? $options ['hide_title'] : 0;
		if (intval ( $hide_title ) == 1) {
			$draw_title = false;
		}

		$instance_title = isset ( $options ['title'] ) ? $options ['title'] : '';
		$instance_new_window = isset ( $options ['new_window'] ) ? $options ['new_window'] : 0;
		$instance_nofollow = isset ( $options ['nofollow'] ) ? $options ['nofollow'] : 0;
		$instance_show_total = isset ( $options ['show_total'] ) ? $options ['show_total'] : 0;
		$instance_total_type = isset ( $options ['total_type'] ) ? $options ['total_type'] : 'button_single';
		$instance_columns = isset ( $options ['columns'] ) ? $options ['columns'] : 3;
		$instance_template = isset ( $options ['template'] ) ? $options ['template'] : 'flat';
		$instance_animation = isset ( $options ['animation'] ) ? $options ['animation'] : '';
		$instance_bgcolor = isset ( $options ['bgcolor'] ) ? $options ['bgcolor'] : '';
		$instance_nospace = isset ( $options ['nospace'] ) ? $options ['nospace'] : 0;

		$instance_hide_value = isset($options['hide_value']) ? $options['hide_value'] : 0;
		$instance_hide_text = isset($options['hide_text']) ? $options['hide_text'] : 0;

		$instance_new_window = self::covert_boolean_value($instance_new_window);
		$instance_nofollow = self::covert_boolean_value($instance_nofollow);
		$instance_show_total = self::covert_boolean_value($instance_show_total);
		$instance_nospace = self::covert_boolean_value($instance_nospace);
		$instance_hide_value = self::covert_boolean_value($instance_hide_value);

		$instance_hide_text = self::covert_boolean_value($instance_hide_text);

		if ($layout_builder) {
			$instance_columns = essb_followers_option('layout_cols');
		}

		// compatibility with previous template slugs
		if (!empty($instance_template)) {
			if ($instance_template == "lite") {
				$instance_template = "light";
			}
			if ($instance_template == "grey-transparent") {
				$instance_template = "grey";
			}
			if ($instance_template == "color-transparent") {
				$instance_template = "color";
			}
		}

		$class_template = (! empty ( $instance_template )) ? " essbfc-template-" . $instance_template : '';
		$class_animation = (! empty ( $instance_animation )) ? " essbfc-icon-" . $instance_animation : '';
		$class_columns = (! empty ( $instance_columns )) ? " essbfc-col-" . $instance_columns : '';
		$class_nospace = (intval ( $instance_nospace ) == 1) ? " essbfc-nospace" : "";

		$style_bgcolor = (! empty ( $instance_bgcolor )) ? ' style="background-color:' . esc_attr($instance_bgcolor) . ';"' : '';

		$link_nofollow = (intval ( $instance_nofollow ) == 1) ? ' rel="nofollow"' : '';
		$link_newwindow = (intval ( $instance_new_window ) == 1) ? ' target="_blank"' : '';

		if (intval($instance_hide_value) == 1) {
			$class_nospace .= ' essbfc-novalue';
		}

		if (intval($instance_hide_text) == 1) {
			$class_nospace .= ' essbfc-notextvalue';
		}

		// loading animations
		if (! empty ( $class_animation )) {
			essb_resource_builder ()->add_static_footer_css ( ESSB3_PLUGIN_URL . '/lib/modules/social-followers-counter/assets/css/hover.css', 'essb-social-followers-counter-animations', 'css' );
		}
		$subscribe_salt = mt_rand();
		$draw_subscribe_form = false;
		$subscribe_design = '';
		
		// followers main element
		printf ( '<div class="essbfc-container essb-followers-counter %1$s%2$s%3$s%5$s"%4$s>', '', esc_attr($class_columns), esc_attr($class_template), $style_bgcolor, esc_attr($class_nospace) );

		if ($draw_title && ! empty ( $instance_title )) {
			printf ( '<h3>%1$s</h3>', $instance_title );
		}

		if ($layout_builder) {
			$cover = essb_followers_option('coverbox_show');

			if ($cover) {
				$coverbox_style = essb_followers_option('coverbox_style');
				$coverbox_bg = essb_followers_option('coverbox_bg');
				$coverbox_profile = essb_followers_option('coverbox_profile');
				$coverbox_title = essb_followers_option('coverbox_title');
				$coverbox_desc = essb_followers_option('coverbox_desc');


				if ($coverbox_title != '') {
					$coverbox_title = stripslashes($coverbox_title);
					$coverbox_title = do_shortcode($coverbox_title);
				}

				if ($coverbox_desc != '') {
					$coverbox_desc = stripslashes($coverbox_desc);
					$coverbox_desc = do_shortcode($coverbox_desc);
				}

				echo '<div class="essbfc-cover '.esc_attr($coverbox_style).'"'.($coverbox_bg != '' ? ' style="background:'.esc_attr($coverbox_bg).';"' : '').'>';

				if ($coverbox_profile != '') {
					echo '<img src="'.esc_url($coverbox_profile).'" class="profile"/>';
				}
				if ($coverbox_title != '') {
					echo '<div class="title">'.$coverbox_title.'</div>';
				}

				if ($coverbox_desc != '') {
					echo '<div class="desc">'.$coverbox_desc.'</div>';
				}

				echo '</div>';
			}
		}

		// get current state of followers counter
		$followers_count = essb_followers_counter ()->get_followers ();

		$display_total = (intval ( $instance_show_total ) == 1) ? true : false;
		$total_followers = 0;
		if ($display_total || $layout_builder) {
			foreach ( $followers_count as $network => $count ) {
				if (intval ( $count ) > 0) {
					$total_followers += intval ( $count );
				}
			}
		}

		if ($display_total && $instance_total_type == "text_before") {
			printf ( '<div class="essbfc-totalastext">%1$s %2$s</div>', self::followers_number ( $total_followers ), essb_followers_option ( 'total_text' ) );
		}

		echo '<ul>';

		if ($layout_builder) {
			$layout_total = essb_followers_option('layout_total');

			if ($layout_total == 'top') {
					$social = 'total';
					printf ( '<li class="essbfc-%1$s blocksize-%2$s">', esc_attr($social), esc_attr($instance_columns) );
					echo '<div class="essbfc-network">';
					printf ( '<i class="essbfc-icon  essbfc-icon-%1$s%2$s"></i>', esc_attr($social), esc_attr($class_animation) );
					printf ( '<span class="essbfc-followers-count">%1$s</span>', self::followers_number ( $total_followers ) );
					printf ( '<span class="essbfc-followers-text">%1$s</span>', essb_followers_option ( 'total_text' ) );
					echo '</div>';
					echo '</li>';
			}
		}

		foreach ( essb_followers_counter ()->active_social_networks () as $social ) {
			$social_followers_text = essb_followers_option ( $social . '_text' );
			$social_custom_icon = essb_followers_option($social.'_icon_type');

			if ($social_custom_icon != '') { $social_custom_icon = ' essbfc-icon-'.$social.'-'.$social_custom_icon; }
			$social_custom_icon .= self::network_additional_icon($social);
			
			$social_followers_counter = isset ( $followers_count [$social] ) ? $followers_count [$social] : 0;

			$social_display = $social;
			if ($social_display == "instgram") {
				$social_display = "instagram";
			}

			$custom_li_class = '';
			if ($layout_builder) {
				$network_columns = essb_followers_option('layout_cols_'.$social);
				if ($network_columns != '') {
					$custom_li_class = ' blocksize-'.$network_columns;
				}
			}

			printf ( '<li class="essbfc-%1$s%2$s">', esc_attr($social_display), esc_attr($custom_li_class) );

			$follow_url = essb_followers_counter ()->create_follow_address ( $social );
			if (! empty ( $follow_url )) {
			    if ($social == 'subscribe_form') {
			        printf ( '<a href="#"%2$s%3$s data-subscribe-form="%1$s" onclick="essb.toggle_subscribe(\'%4$s\'); return false;">', esc_attr($follow_url), $link_newwindow, $link_nofollow, $subscribe_salt );
			        $subscribe_design = $follow_url;
			        $draw_subscribe_form = true;
			    }
			    else {
				    printf ( '<a href="%1$s"%2$s%3$s>', esc_url($follow_url), $link_newwindow, $link_nofollow );
			    }
			}

			echo '<div class="essbfc-network">';
			printf ( '<i class="essbfc-icon essbfc-icon-%1$s%2$s%3$s"></i>', esc_attr($social_display), esc_attr($class_animation), esc_attr($social_custom_icon) );
			if ($social_followers_counter != '') {
				printf ( '<span class="essbfc-followers-count">%1$s</span>', self::followers_number ( $social_followers_counter ) );
			}
			else {
				printf ( '<span class="essbfc-followers-count">%1$s</span>', $social_followers_counter ? $social_followers_counter : '&nbsp;' );
			}
			printf ( '<span class="essbfc-followers-text">%1$s</span>', $social_followers_text ? $social_followers_text : '&nbsp;' );
			echo '</div>';

			if (! empty ( $follow_url )) {
				echo '</a>';
			}
			echo '</li>';
		}

		if ($display_total && $instance_total_type == "button_single") {
			$social = 'total';
			printf ( '<li class="essbfc-%1$s">', esc_attr($social) );
			echo '<div class="essbfc-network">';
			printf ( '<i class="essbfc-icon  essbfc-icon-%1$s%2$s"></i>', esc_attr($social), esc_attr($class_animation) );
			printf ( '<span class="essbfc-followers-count">%1$s</span>', self::followers_number ( $total_followers ) );
			printf ( '<span class="essbfc-followers-text">%1$s</span>', essb_followers_option ( 'total_text' ) );
			echo '</div>';
			echo '</li>';
		}

		if ($layout_builder) {
			$layout_total = essb_followers_option('layout_total');

			if ($layout_total == 'bottom') {
				$social = 'total';
				printf ( '<li class="essbfc-%1$s blocksize-%2$s">', esc_attr($social), esc_attr($instance_columns) );
				echo '<div class="essbfc-network">';
				printf ( '<i class="essbfc-icon  essbfc-icon-%1$s%2$s"></i>', esc_attr($social), $class_animation );
				printf ( '<span class="essbfc-followers-count">%1$s</span>', self::followers_number ( $total_followers ) );
				printf ( '<span class="essbfc-followers-text">%1$s</span>', essb_followers_option ( 'total_text' ) );
				echo '</div>';
				echo '</li>';
			}
		}

		echo '</ul>';

		if ($display_total && $instance_total_type == "text_after") {
			printf ( '<div class="essbfc-totalastext">%1$s %2$s</div>', self::followers_number ( $total_followers ), essb_followers_option ( 'total_text' ) );
		}

		echo '</div>';
		// followers: end
		
		if ($draw_subscribe_form) {
		    if (!class_exists('ESSBNetworks_Subscribe')) {
		        include_once (ESSB3_PLUGIN_ROOT . 'lib/networks/essb-subscribe.php');
		    }
		    echo ESSBNetworks_Subscribe::draw_popup_subscribe_form($subscribe_design, $subscribe_salt);
		    
		}
	}

	/**
	 * Generate the followers counter bar below content or when the [followme-bar] shortcode
	 * is used inside content
	 *
	 * The method is static and returns generated html content based on plugin settings
	 *
	 * @since 5.8.5
	 */
	public static function draw_followers_bar() {
		$instance_title = '';
		$instance_new_window = 1;
		$instance_nofollow = 1;
		$instance_show_total = 0;
		$instance_total_type = 'button_single';
		$instance_columns = essb_followers_option('profile_cols');
		$instance_template = essb_followers_option('profile_template', 'flat');
		$instance_animation = essb_followers_option('profile_animation');
		$instance_bgcolor = '';
		$instance_nospace = essb_followers_option('profile_nospace');

		$instance_hide_value = essb_followers_option('profile_nonumber');
		$instance_hide_text = essb_followers_option('profile_notext');

		if ($instance_columns == '') { $instance_columns = 'flex'; }

		// compatibility with previous template slugs
		if (!empty($instance_template)) {
			if ($instance_template == "lite") {
				$instance_template = "light";
			}
			if ($instance_template == "grey-transparent") {
				$instance_template = "grey";
			}
			if ($instance_template == "color-transparent") {
				$instance_template = "color";
			}
		}

		$class_template = (! empty ( $instance_template )) ? " essbfc-template-" . $instance_template : '';
		$class_animation = (! empty ( $instance_animation )) ? " essbfc-icon-" . $instance_animation : '';
		$class_columns = (! empty ( $instance_columns )) ? " essbfc-col-" . $instance_columns : '';
		$class_nospace = (intval ( $instance_nospace ) == 1) ? " essbfc-nospace" : "";

		$link_nofollow = (intval ( $instance_nofollow ) == 1) ? ' rel="nofollow"' : '';
		$link_newwindow = (intval ( $instance_new_window ) == 1) ? ' target="_blank"' : '';

		if (intval($instance_hide_value) == 1) {
			$class_nospace .= ' essbfc-novalue';
		}

		if (intval($instance_hide_text) == 1) {
			$class_nospace .= ' essbfc-notextvalue';
		}

		$output = '';

		// loading animations
		if (! empty ( $class_animation )) {
			essb_resource_builder ()->add_static_footer_css ( ESSB3_PLUGIN_URL . '/lib/modules/social-followers-counter/assets/css/hover.css', 'essb-social-followers-counter-animations', 'css' );
		}

		// followers main element
		$output .= sprintf ( '<div class="essbfc-container essb-followers-counter %1$s%2$s%3$s%5$s"%4$s>', '', esc_attr($class_columns), esc_attr($class_template), '', esc_attr($class_nospace) );
		$cover = essb_followers_option('profile_c_show');

		if ($cover) {
			$coverbox_style = essb_followers_option('profile_c_style');
			$coverbox_align = essb_followers_option('profile_c_align');
			$coverbox_bg = essb_followers_option('profile_c_bg');
			$coverbox_profile = essb_followers_option('profile_c_profile');
			$coverbox_title = essb_followers_option('profile_c_title');
			$coverbox_desc = essb_followers_option('profile_c_desc');

			if ($coverbox_title != '') {
				$coverbox_title = stripslashes($coverbox_title);
				$coverbox_title = do_shortcode($coverbox_title);
			}

			if ($coverbox_desc != '') {
				$coverbox_desc = stripslashes($coverbox_desc);
				$coverbox_desc = do_shortcode($coverbox_desc);
			}

			if ($coverbox_align != '') {
				$coverbox_align = ' essbfc-cover-align-'.$coverbox_align;
			}

			$output .= '<div class="essbfc-cover '.esc_attr($coverbox_style).esc_attr($coverbox_align).'"'.($coverbox_bg != '' ? ' style="background:'.esc_attr($coverbox_bg).';"' : '').'>';

			if ($coverbox_profile != '') {
				$output .= '<img src="'.esc_url($coverbox_profile).'" class="profile"/>';
			}
			if ($coverbox_title != '') {
				$output .= '<div class="title">'.$coverbox_title.'</div>';
			}

			if ($coverbox_desc != '') {
				$output .= '<div class="desc">'.$coverbox_desc.'</div>';
			}

			$output .= '</div>';
		}
		// get current state of followers counter
		$followers_count = essb_followers_counter ()->get_followers ();

		$display_total = (intval ( $instance_show_total ) == 1) ? true : false;
		$total_followers = 0;

		foreach ( $followers_count as $network => $count ) {
			if (intval ( $count ) > 0) {
				$total_followers += intval ( $count );
			}
		}


		if ($display_total && $instance_total_type == "text_before") {
			$output .= sprintf ( '<div class="essbfc-totalastext">%1$s %2$s</div>', self::followers_number ( $total_followers ), essb_followers_option ( 'total_text' ) );
		}

		$subscribe_salt = mt_rand();
		$draw_subscribe_form = false;
		$subscribe_design = '';
		
		$output .= '<ul>';

		foreach ( essb_followers_counter ()->active_social_networks () as $social ) {
			$social_followers_text = essb_followers_option ( $social . '_text' );
			$social_custom_icon = essb_followers_option($social.'_icon_type');

			if ($social_custom_icon != '') {
				$social_custom_icon = ' essbfc-icon-'.$social.'-'.$social_custom_icon;
			}
			$social_custom_icon .= self::network_additional_icon($social);
			$social_followers_counter = isset ( $followers_count [$social] ) ? $followers_count [$social] : 0;

			$social_display = $social;
			if ($social_display == "instgram") {
				$social_display = "instagram";
			}

			$custom_li_class = '';

			$output .= sprintf ( '<li class="essbfc-%1$s%2$s">', $social_display, $custom_li_class );

			$follow_url = essb_followers_counter ()->create_follow_address ( $social );
			if (! empty ( $follow_url )) {
			    if ($social == 'subscribe_form') {
			        $output .= sprintf ( '<a href="#"%2$s%3$s data-subscribe-form="%1$s" onclick="essb.toggle_subscribe(\'%4$s\'); return false;">', esc_attr($follow_url), $link_newwindow, $link_nofollow, $subscribe_salt );
			        $subscribe_design = $follow_url;
			        $draw_subscribe_form = true;
			    }
			    else {
				    $output .= sprintf ( '<a href="%1$s"%2$s%3$s>', $follow_url, $link_newwindow, $link_nofollow );
			    }
			}

			$output .= '<div class="essbfc-network">';
			$output .= sprintf ( '<i class="essbfc-icon essbfc-icon-%1$s%2$s%3$s"></i>', $social_display, $class_animation, $social_custom_icon );
			if ($social_followers_counter != '') {
				$output .= sprintf ( '<span class="essbfc-followers-count">%1$s</span>', self::followers_number ( $social_followers_counter ) );
			}
			else {
				$output .= sprintf ( '<span class="essbfc-followers-count">%1$s</span>', $social_followers_counter ? $social_followers_counter : '&nbsp;' );
			}
			$output .= sprintf ( '<span class="essbfc-followers-text">%1$s</span>', $social_followers_text ? $social_followers_text : '&nbsp;' );
			$output .= '</div>';

			if (! empty ( $follow_url )) {
				$output .= '</a>';
			}
			$output .= '</li>';
		}

		$output .= '</ul>';

		$output .= '</div>';
		// followers: end
		
		if ($draw_subscribe_form) {
		    if (!class_exists('ESSBNetworks_Subscribe')) {
		        include_once (ESSB3_PLUGIN_ROOT . 'lib/networks/essb-subscribe.php');
		    }
		    $output .= ESSBNetworks_Subscribe::draw_popup_subscribe_form($subscribe_design, $subscribe_salt);
		    
		}

		return $output;
	}

}
