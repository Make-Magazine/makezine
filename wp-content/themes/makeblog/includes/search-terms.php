<?php


function make_pop_terms() {

	$data = wpcom_vip_file_get_contents('http://www.google.com/cse/api/013710623676068871951/cse/xunnvqtkgnw/queries');
	
	$xml = simplexml_load_string( $data );
 	 
	if ( ! $xml ) 
		return;

	$items = $xml->item;
	echo '<ul class="terms"><li>Popular Searches:</li>';
	foreach ($items as $item) {	
		$title = str_replace('%0A', '', urlencode($item->title));
		echo '<li><a href="/search/?q='.$title.'"><span class="label label-default label-info">'.$item->title.'</span></a></li>';
	}
	echo '</ul>';

}

function make_hot_topics() {

	$data = wpcom_vip_file_get_contents('http://www.google.com/cse/api/013710623676068871951/cse/xunnvqtkgnw/queries');

	$xml = simplexml_load_string( $data );
 	 
	if ( ! $xml ) 
		return;

	$items = $xml->item;
	echo '<ul class="terms">';
	$i = 0;
	foreach ($items as $item) {	
		$title = str_replace('%0A', '', urlencode($item->title));
		echo '<li><a href="http://blog.makezine.com/search/?q='.$title.'">'.$item->title.'</a></li>';
		if (++$i == 7) break;
	}
	echo '</ul>';

}

function make_namify($item) {
	$haystack = $item->U;
	$needle = 'makeprojects.com';
	if (strlen(strstr($haystack,'makeprojects.com'))>0) {
		//$title = str_replace('Make: ', '<span class="red">Project: </span> ', $item->T);
		$title = $item->T;
		$title = '<span class="red">Project: </span>'.$title;
		echo $title;
	} /*elseif (strlen(strstr($haystack,'makezine.com'))>0) {
		$title = str_replace('makezine.com: ', '<span class="red">Article: </span> ', $item->T);
		echo $title;
	}*/ elseif (strlen(strstr($haystack,'makezine.com'))>0) {
		$title = str_replace('MAKE | ', '<span class="red">Article: </span> ', $item->T);
		echo $title;
	} elseif (strlen(strstr($haystack,'kits.makezine.com'))>0) {
		$title = str_replace('| Make: Kit Reviews', '<span class="red">Kit Review: </span> ', $item->T);
		echo $title;
	} elseif (strlen(strstr($haystack,'blog.makezine.com'))>0) {
		$title = str_replace('MAKE | ', '<span class="red">Post: </span> ', $item->T);
		echo $title;
	} elseif (strlen(strstr($haystack,'makezine.com'))>0) {
		$title = str_replace('MAKE: ', '<span class="red">Post: </span> ', $item->T);
		echo $title;
	} elseif (strlen(strstr($haystack,'makershed.com'))>0) {
		$title = $item->T;
		$title = '<span class="red">Product: </span>'.$title;
		echo $title;
	} elseif (strlen(strstr($haystack,'makerfaire.com'))>0) {
		$title = str_replace('| Maker Faire News', '', $item->T);
		$title = '<span class="red">Maker Faire: </span>'.$title;
		echo $title;
	} elseif (strlen(strstr($haystack,'make-digital.com'))>0) {
		//$title = str_replace('', '', $item->T);
		$title = $item->T;
		$title = '<span class="red">Magazine: </span>'.$title;
		echo $title;
	} elseif (strlen(strstr($haystack,'craftzine.com'))>0) {
		$get_rid_of_me = array('@Craftzine.com blog', 'Craftzine.com blog:');
		$title = str_replace($get_rid_of_me, '', $item->T);
		$title = '<span class="red">Craft: </span>'.$title;
		echo $title;
	} else {
		echo $title;
		}
}


function make_linkify($item) {
	$haystack = $item->U;
	$needle = 'makeprojects.com';
	if (strlen(strstr($haystack,'makershed.com'))>0) {
		$url = $item->U;
		$url = $url.'?Click=107309';
		return $url;
	} else {
		$url = $item->U;
		return $url;
	}
}

function make_search_header() {
	$q = ( !empty( $_GET['q'] ) ) ? htmlspecialchars( esc_attr( $_GET['q'] ) ) : '';
	$si = ( !empty( $_GET['start'] ) ) ? htmlspecialchars( esc_attr( $_GET['start'] ) ) : '';
	if (!isset($_GET['start'])) {
		$si = 1;
	}
	$siteSearch = ( !empty( $_GET['as_sitesearch'] ) ) ? htmlspecialchars( esc_attr( $_GET['as_sitesearch'] ) ) : '';
	$url = wpcom_vip_file_get_contents('http://www.google.com/search?start=0&amp;num=10&amp;q='.urlencode($q).'&amp;start='.urlencode($si).'&amp;count=10&amp;cx=013710623676068871951:xunnvqtkgnw&amp;output=xml_no_dtd&amp;client=google-csbe&amp;as_sitesearch='.$siteSearch);

	$json_output = simplexml_load_string( $url );

	if ( ! $json_output ) 
		return;

	echo '<h2>Search Terms: '.$q.'</h2>';
	//echo '<p><small>Results: '.$json_output->RES->M. ' Time: '.$json_output->TM.'</small></p>';
}

			
function make_search() {

	$q = htmlspecialchars(esc_attr($_GET['q']));
	$si = htmlspecialchars($_GET['start']);
	if (!isset($_GET['start'])) {
		$si = 1;
	}
	$siteSearch = htmlspecialchars(esc_attr($_GET['as_sitesearch']));

	$url = wpcom_vip_file_get_contents('http://www.google.com/search?start=0&amp;num=10&amp;q='.urlencode($q).'&amp;start='.urlencode($si).'&amp;count=10&amp;cx=013710623676068871951:xunnvqtkgnw&amp;output=xml_no_dtd&amp;client=google-csbe&amp;as_sitesearch='.$siteSearch);
	$json_output = simplexml_load_string( $url );

	if ( ! $json_output )
		return;

	?>
	
	<?php 
	function make_refine() {
		$siteSearch = esc_attr($_GET['as_sitesearch']);
		$make = 'makezine.com';
	?>
		<ul id="search" class="pills">
			<li style="margin-top:10px; margin-right:10px;">Refine:</li>
			
			<li class="<?php if ($siteSearch == 'makezine.com')  echo 'active'; ?>">
				<a href="?q=<?php echo htmlspecialchars(esc_attr($_GET['q'])); ?>&amp;as_sitesearch=makezine.com">MAKE</a>
			</li>
			<li class="<?php if ($siteSearch == 'makershed.com')  echo 'active'; ?>">
				<a href="?q=<?php echo htmlspecialchars(esc_attr($_GET['q'])); ?>&amp;as_sitesearch=makershed.com">Maker Shed</a>
			</li>
			<li class="<?php if ($siteSearch == 'makeprojects.com')  echo 'active'; ?>">
				<a href="?q=<?php echo htmlspecialchars(esc_attr($_GET['q'])); ?>&amp;as_sitesearch=makeprojects.com">Make: Projects</a>
			</li>
			<li class="<?php if ($siteSearch == 'makerfaire.com')  echo 'active'; ?>">
				<a href="?q=<?php echo htmlspecialchars(esc_attr($_GET['q'])); ?>&amp;as_sitesearch=makerfaire.com">Maker Faire</a>
			</li>
			<li class="<?php if ($siteSearch == 'craftzine.com')  echo 'active'; ?>">
				<a href="?q=<?php echo htmlspecialchars(esc_attr($_GET['q'])); ?>&amp;as_sitesearch=craftzine.com">Craft</a>
			</li>
		</ul>
		
	<?php
	}
		
	if (isset($_GET['q'])) {
		make_refine();
	}
	
	
	$haystack = htmlspecialchars(esc_attr($_GET['q']));
	$hay = explode(" ", $haystack);
	
	// Limit the number of sub-queries we make
	$hay = array_slice( $hay, 0, 3 );
	$tax_query = array( 'relation' => 'OR' );
	foreach ( $hay as $term ) {
		$term = sanitize_text_field( $term );
		$new_terms = get_terms( 'search_terms', array( 'search' => $term, 'fields' => 'names' ) );
		if ( !empty( $new_terms ) ) {
			foreach( $new_terms as $new_term ) {
				$tax_query[] = array( 'taxonomy' => 'search_terms','field' => 'slug','terms' => array( $new_term ));
			}
		}
	}
	// Only do the featured items search if there are matching terms
	if ( count( $tax_query ) > 1 ) {
	
		$args = array(
			'tax_query' => $tax_query,
			'post_type' => 'search_term'
		);
		$make_search_query = new WP_Query( $args );
		while ( $make_search_query->have_posts() ) : $make_search_query->the_post();
			echo '<div class="row result">';
				echo '<div class="col-md-9 well">';
					echo '<div class="col-md-2" style="margin-left:0px;">';
						$url = get_post_custom_values('LinkURL');
						if (isset($url[0])) {
							echo '<a href="'.esc_url($url[0]).'">';
						}
						the_post_thumbnail('search-thumb', array('class' => 'img-thumbnail'));
						if (isset($url[0])) {
							echo '</a>';
						}
					echo '</div>';
					echo '<div class="col-md-7">';
						echo '<h3>';
						$label = get_post_custom_values('Label');
						if (isset($label[0])) {
							echo '<span class="red">'.esc_attr($label[0]).'</span> ';
						}
						if (isset($url[0])) {
							echo '<a href="'.esc_url($url[0]).'">';
						}
						$linktitle = get_post_custom_values('LinkTitle');
						if (isset($linktitle[0])) {
							echo esc_attr($linktitle[0]);
						}
						echo '</a></h3>';
						if (isset($url[0])) {
							echo '<a href="'.esc_url($url[0]).'">'.substr(esc_url($url[0]), 0, 50);
						}
						
						echo '...</a>';
						the_content();
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '<div class="clear">';
			echo '</div>';
		endwhile;
	
		wp_reset_postdata();
	}
	
	$results = $json_output -> RES -> R;
	$drilldown = $results[0]->PageMap;
	
	$att = "value";
	
	if (isset($results)) {
	
		foreach ($results as $item) {
			$image = $item->xpath(".//DataObject[@type='cse_image']/Attribute");
				if ( !empty($image)) {
				echo '<div class="row result"><div class="result">';
				echo '<div class="col-md-2">';
				if ( function_exists( 'wpcom_vip_get_resized_remote_image_url' ) ) {
					echo '<img class="img-thumbnail" src="' . wpcom_vip_get_resized_remote_image_url( $image[0]->attributes()->$att, '100', '100' ) . '" alt="'.make_linkify($item).'" />';
				} else {
					echo '<img class="img-thumbnail" src="';
					echo $image[0]->attributes()->$att;
					echo '?w=100" width="100" />';
				}
				echo '</div>';
				echo '<div class="col-md-8"><h3><a href="'.make_linkify($item).'">';
				make_namify($item);
				echo '</a></h3>';
				echo '<a href="' . make_linkify( $item ) . '">' . $item->UE . '</a>';
				echo '<p>'.strip_tags($item->S).'</p></div></div><div class="clear:both"></div></div><div class="clear:both"></div>';
			} else {
				echo '<div class="row result"><div class="result">';
				echo '<div class="col-md-10"><h3><a href="'.make_linkify($item).'">';
				//namify($item);
				make_namify($item);
				echo '</a></h3>';
				echo '<a href="' . make_linkify( $item ) . '">' . $item->UE . '</a>';
				echo '<p>'.strip_tags($item->S).'</p></div></div></div>	';
			}
	
		}
		
	} else {
		echo '<h3>Sorry, no results found...</h3>';
	}
	
	if (isset($json_output->RES->NB->NU)) {
		echo '<div class="breadcrumb">';
	}
	
	if (isset($json_output->RES->NB->PU)) {
		echo '<a class="pull-left" href="'.$json_output->RES->NB->PU.'">&larr; Previous Page</a>';
	}
	
	if (isset($json_output->RES->NB->NU)) {
		echo '<a class="pull-right" href="'.$json_output->RES->NB->NU.'">Next Page &rarr;</a>';
	}
	if (isset($json_output->RES->NB->NU)) {
		echo '</div>';
	}
}