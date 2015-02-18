<?php

function wp_pagenavi($before = '', $after = '', $prelabel = '', $nxtlabel = '', $pages_to_show = 6, $always_show = false) {
	global $request, $posts_per_page, $wpdb, $paged;
	
	if(empty($prelabel)) {
		$prelabel = '<li class="prev">&larr; Previous</li>'; 
	} 
	
	if(empty($nxtlabel)) {
		$nxtlabel = '<li class="next">Next &rarr;</li>';
	} 
	
	$half_pages_to_show = round($pages_to_show/2);
		if (!is_single()) {
		if(!is_category() && !is_tag()) {
			preg_match('#FROM\s(.*)\sORDER BY#siU', $request, $matches);  
			} 
		else {
			preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches);
			}
	
	$fromwhere = $matches[1];
	$numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");
	$max_page = ceil($numposts /$posts_per_page);
	
	if(empty($paged)) {
		$paged = 1;
		}
	
	if($max_page > 1 || $always_show) {
		echo "$before <p class='pagenav_most'>Most recent posts: page $paged of $max_page </p>";
		echo "<div class='pagination'><ul class=''>";   if ($paged >= ($pages_to_show-1)) {
		}
	
	previous_posts_link($prelabel);
	
	for($i = $paged - $half_pages_to_show; $i <= $paged + $half_pages_to_show; $i++) {   if ($i >= 1 && $i <= $max_page) {
		if($i == $paged) {
			echo '<li class="active"><a href="'. esc_url( get_pagenum_link($i) ).'">'.$i.'</a></li>';
			}
			else {
				echo '<li><a href="'. esc_url( get_pagenum_link($i) ).'">'.$i.'</a></li>';   }
				}
			}
	
	next_posts_link($nxtlabel, $max_page);
	if (($paged+$half_pages_to_show) < ($max_page)) {
		//echo ' ... <a href="'. esc_url( get_pagenum_link($max_page) ).'">Last &raquo;</a>';
		}
	echo " </ul></div>$after";
		}
	}
}
