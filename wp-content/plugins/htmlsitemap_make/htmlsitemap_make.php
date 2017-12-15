<?php
/*
Plugin Name: Makezine HTML Page Sitemap
Description: Adds an HTML sitemap by entering the shortcode [htmlsitemap_make]
*/


/*
	Add the sitemap when shortcode is encountered
*/

//filter page titles

if (isset($_GET['cat'])) { 

	//filter the page title

	function assignPageTitle(){

		return get_cat_name(get_category_by_slug($_GET['cat'])->term_id ).' Sitemap | Make';

		}

	add_filter('wp_title', 'assignPageTitle');


	function modify_single_post_entry_titles( $title ) {

		if ( is_singular( 'page' ) && in_the_loop() ) {

			/* Modify $title */
			$title = get_cat_name(get_category_by_slug($_GET['cat'])->term_id ).' Sitemap';

		}

		return $title;
	}

	add_filter( 'the_title', 'modify_single_post_entry_titles' );



}


function htmlsitemap_make_shortcode_handler()

{


global $wpdb;
global $wp_query;

global $cat;
global $catname;
global $thepage;


//set styles

echo "
<style>
ol.sitemapbcrumbs { list-style-type: none; margin: 10px 0 10px 0; padding: 0; }
ol.sitemapbcrumbs li { display: inline; }
ol.sitemapbcrumbs li a { font-size: 18px; }

ul.main_sitemap { list-style-type: none; margin-left:0;   }
ul.main_sitemap li { margin-bottom:10px;  padding-bottom:10px;   }
ul.main_sitemap li a { font-size: 23px; border-bottom:1px solid #ccc; padding-bottom:10px; width:100%; display:block;   }
ul.main_sitemap li ul { margin-left:0;  margin-top:10px;  }
ul.main_sitemap li ul li { display:inline; padding-right:15px; border:none;  }
ul.main_sitemap li ul li a { font-size: 18px; border:none; display: inline;  }
ul.sitemap_menu { margin-left:0;  margin-top:10px;  }
ul.sitemap_menu li { display:inline; padding-right:15px; border:none;  }
ul.sitemap_menu li a { font-size: 18px; border:none; text-decoration: none; color: #6e6e6e;  }	
ul.sitemap_top li { font: 200 20px/1.5; border: 1px solid #ccc; padding:5px 5px 5px 0; margin-bottom:5px; }

ul.sitemap_top li a { text-decoration: none; color: #6e6e6e; width: auto; }
ul.sitemap_top li a:hover { color: #005d8f; }

ul.sitemap_links { list-style-type: none; width:100%; margin: 10px 0 0 0; padding: 0; float:left; clear:left; }
ul.sitemap_links li { font: 200 15px/1.2; background-color: #f4f4f4; padding:5px 8px; margin:5px 5px 0 0; width:47%; height:3.3em; float:left; line-height:110%; }
ul.sitemap_links li a { font-size: 16px; text-decoration: none; color: #6e6e6e; width: auto; }
 
ul.sitemap_links li a:hover { color: #005d8f; }

img.attachment-sitemap_th { float:left; width:100px; height:auto; max-height:5em; padding-right:15px; padding-bottom:5em; }

span.sitemap_date { font-size:14px; color:#005d8f; }

.pagination { clear:both; }

@media screen and (max-width: 980px) { 
	ul.sitemap_links li { float:none; width:100%; height:auto; }
	img.attachment-sitemap_th { display:none; }
}
</style>";


//get parameters

//type
if (isset($_GET['type'])) { $type = $_GET['type']; } else { $type = ""; }

//cat
if (isset($_GET['cat'])) {

				$catname = $_GET['cat'];

				//get category object to get id
				$category = get_category_by_slug($_GET['cat']);
				$cat = $category->term_id;			

			} else { $cat = ""; }
 
//page
if (isset($_GET['pag'])) { $thepage = $_GET['pag']; } else { $thepage = 0; }


//posts per page
$postsperpage = 100;

//name of page where shortcode is included
$sitemappagename = "sitemap";

//top category
$topcat = "0"; //options: Enter top category if everything is under one top level category, or "0"

//post types
$post_types = array('post', 'page', 'magazine', 'volume', 'projects', 'review', 'craft');

//functions
function breadcrumb_links() {

	global $cat;
	global $catname;
	
	$thename = get_cat_name($cat);
	$url = $_SERVER['REQUEST_URI'];	
	$url = strtok($_SERVER["REQUEST_URI"],'?');
	
	//echo $url;
	//echo $thename;

	//next will return an array of all category ancestors, with toplevel cat being [0]
	$ancestors = array_reverse(get_ancestors($cat, 'category'));
	
	//remove top level cat in case there is 1 top level category
	//unset($ancestors[0]); 
	
	//print_r($ancestors);

	if ($ancestors) {
	  
	  //set up output
	  $output = '';
	  $position = 1;
	  
	  //$ancestorsnumber = count($ancestors);
	  //echo "number :".$ancestorsnumber;
	  
	  foreach ($ancestors as $value)
  
	  {
	  
		// if needed to skip cats specific cats
		//if($cat == '3' || $cat == '4') continue;
		
		$position++;
	
		$catobj = get_category($value); // get the object for the catid
		$catslug = $catobj->slug;
	
		$catlink = "?cat=".$catslug;
		$categoryname = get_cat_name($value);
		$output .= '
		<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . $catlink . '"><span itemprop="name">' . $categoryname . '</span></a><meta itemprop="position" content="'.$position.'" /> &raquo;</li>
		'
		;
	
	  }
  
	}


	
	//if post_type
	if ($catname=="page" || $catname=="volume") {
	
			$thebreadcrumbs =  '
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="http://'.$_SERVER['HTTP_HOST'].$url.'"><span itemprop="name">Home</span></a><meta itemprop="position" content="1" /> &raquo;</li>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href=""><span itemprop="name">'.ucwords($catname).'</span></a><meta itemprop="position" content="2" /></li>';
		
		} else {
		
		if ($thename=="") {

			$thebreadcrumbs = '
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="http://'.$_SERVER['HTTP_HOST'].$url.'"><span itemprop="name">Home<span></a><meta itemprop="position" content="1" /></li>';	
	
		} else {
		
			if ($output=="") { $newposition = 2; } else { $newposition = $position +1; }
	
			$thebreadcrumbs = '
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="http://'.$_SERVER['HTTP_HOST'].$url.'"><span itemprop="name">Home<span></a><meta itemprop="position" content="1" /> &raquo; </li>'
			.$output.
			'<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href=""><span itemprop="name">'.$thename.'</span></a><meta itemprop="position" content="'.($newposition).'" /></li>';
		
		}
		
		
		}
		

		
	echo "
	<ol itemscope itemtype=\"http://schema.org/BreadcrumbList\" class=\"sitemapbcrumbs\">".$thebreadcrumbs."
	</ol>
	";
	
	
			
	
}


function pagination_bar() {

	global $wp_query;
	global $thepage;
	global $catname;
	
	if ($thepage == 0) { $current = 1; } else { $current = $thepage; }

	$total_pages = $wp_query->max_num_pages;
	
	//echo $total_pages;
	

	if ($total_pages > 1){
		//$current_page = max(1, get_query_var('paged'));
	
		
		echo paginate_links(array(
			'base' => "?cat=".$catname.'%_%',
			//'format' => '/page/%#%/',
			'show_all' => false,
			'prev_next' => true,
			'format' => "&pag=%#%",
			'current' => $current,
			'total' => $total_pages,
		));
		
		}
	}




//check for page or volume


    if ($catname=="page" || $catname=="volume")

	{ 
	
	
	breadcrumb_links();
	
	
	
		if ( $thepage == 0 ) { $offset = 0; } else { $offset = $postsperpage * ($thepage-1); }
	
		//$offset = $postsperpage * $thepage;
		//echo $cat;
		
		//'post_type' => 'post'
		
		$args = array( 'post_type' => $catname, 'posts_per_page' => $postsperpage, 'paged' => get_query_var( 'paged' ), 'orderby' => 'date', 'offset' => $offset );
		
		$wp_query = new WP_Query($args);
		
		$total = $wp_query->found_posts;
			
		/* test	
		echo "type:". $catname;
		echo "<br />";
		echo "Total: ".$total;
		echo "<br />";
		echo "Offset: ".$offset;
		echo "<br />";
		*/
		
		
		$sitemap = get_page_by_title($sitemappagename);
		//echo $sitemap->ID;
		
		
		echo "<ul class=\"sitemap_links\">";
		
		
		
		while (have_posts()):the_post();
		
			
			//don't display sitemap page in sitemap
			if ($sitemap->ID==get_the_ID()) { continue; } else 
			
			{
		
		?>
		
		<li>

		<?php 
/*
 		if ( has_post_thumbnail(get_the_ID())) {
    			echo get_the_post_thumbnail(get_the_ID(),array('class'=>"sitemap_th"));
 			} else {
    			echo '<img src="/wp-content/themes/makeblog/img/make-hdr-logo.png" class="attachment-sitemap_th"/>';
 			}
*/
			
		?>

		<span class="sitemap_date"><?php echo get_the_date( 'Y-m-d' ); ?><span><br />
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php /*echo get_post_type(get_the_ID())*/ ?></li>
		
		<?php
		
			}
		
		endwhile;
		
		echo "</ul>";
		
		?>
		
		
		<nav class="pagination">
			<?php pagination_bar();?>
		</nav>        
        
        
        <?php
        
        //reset
        wp_reset_query();	
	

	 }
	 
	 
	 else
	 
	 
	 {
	

		//check if $cat is not set

		if ($cat == "") { 

			breadcrumb_links();
	
			echo "<ul class=\"main_sitemap\">";

		//$cat is not set list all category children for $topcat

			$args = array(
			  'orderby' => 'name',
			  'parent' => $topcat,
			  
			  );
 
			$categories = get_categories($args);

			

			  foreach ($categories as $category) {
	
					echo '<li class="title" style="border-top: 0px;"><a href="?cat='.$category->slug.'">'.$category->cat_name.'</a>';
					
					//$children = $wpdb->get_results( "SELECT term_id FROM $wpdb->term_taxonomy WHERE parent=$category->term_id" );

					$children=get_categories(
    						array( 'parent' => $cat->cat_ID )
					);
	
					$no_children = count($children);
					
	
					if ($no_children > 0) {
	
					//there are children categories, list them
					
					        echo "<ul class=\"sitemap_top\">";
        
							$args2 = array(
							 'orderby' => 'name',
							 'child_of' => $category->term_id,
							 'parent' => $category->term_id
							 );
		
							$categs = get_categories($args2);
							 foreach ($categs as $categ) {

								echo '<li><a href="?cat='.$categ->slug.'">'.$categ->cat_name.'</a></li>';
								//build excluded categories for the drill down
								$cat_excl .= "-".$categ->term_id.",";

							}
		
							echo "</ul>";
							
							}
					
					
					echo '</li>';
								
					
	
		 }  
	  
	  
		//add pages and volumes

		$post_types = get_post_types( '', 'names' );


		foreach ( $post_types as $post_type ) {

			if (!($post_type == 'page' || $post_type == 'volume')) continue;

		   echo '<li><a href="?cat='.$post_type.'">' . ucwords($post_type) . '</a></li>';
   
   
		}

	  
		echo "</ul>";
	
	

		} else {
		
		//$cat is set
		//First evaluate if category has children, if it does list the children categories

		$children=get_categories(
    			array( 'parent' => $cat->cat_ID )
		);

		//$children = $wpdb->get_results( "SELECT term_id FROM $wpdb->term_taxonomy WHERE parent=$cat" );

		//print_r($children);
	
		$no_children = count($children);
	
		if ($no_children > 0) {
    
    	//there are children categories, list them
    
    	breadcrumb_links();
    	
    	//listing children
        
	echo "<ul class=\"sitemap_menu\">";
        
        $args2 = array(
         'orderby' => 'name',
         'child_of' => $cat,
         'parent' => $cat
         );
        
        $categories2 = get_categories( $args2 );
         foreach ($categories2 as $category2) {

            $topmenu .= '<li><a href="?cat='.$category2->slug.'" style="font-size:18px;">'.$category2->cat_name.'</a><li>';
            //build excluded categories for the drill down
            $cat_excl .= "-".$category2->term_id.",";

        }
        
        
        //$topmenu = rtrim($topmenu, ' | ');
        
        echo  $topmenu."";

	echo "</ul>";
       
        
        //also list all links under this cat that don't have a further cat drill down
        //remove categories that can be drilled down on
        
		
		//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
		if ( $thepage == 0 ) { $offset = 0; } else { $offset = $postsperpage * ($thepage-1); }
	
		//$offset = $postsperpage * $thepage;
	
		
		$catnew = $cat.",".$cat_excl;
		$catnew = rtrim($catnew, ',');
		
		/*
		echo "Cat: ";
		echo $cat;
		echo "<br />";
		echo "post types: ";
		print_r($post_types);
		echo "<br />";
		echo "postsperpage: ".$postsperpage;
		echo "<br />";
		echo "Cat: ".$catnew;
		echo "<br />";
		echo "Offset: ".$offset;
		echo "<br />";
		*/
		
		//'post_type' => 'post'
		
		$args = array( 'post_type' => $post_types, 'posts_per_page' => $postsperpage, 'cat' => $catnew, 'paged' => get_query_var( 'paged' ), 'orderby' => 'date', 'offset' => $offset );

		//print_r($args);		

		
		$wp_query = new WP_Query($args);

		//echo $wp_query->request;

		//print_r($wp_query);
		
		$total = $wp_query->found_posts;

		
			
		/*
		echo "cat: ".$catnew;
		echo "<br />";
		echo "Total: ".$total;
		echo "<br />";
		echo "Offset: ".$offset;
		echo "<br />";
		*/
		
		
		echo "
		<ul class=\"sitemap_links\">
		";
		
		
		while (have_posts()):the_post();
		
		?>
		
		
		<li>

		<?php 
/*
 		if ( has_post_thumbnail(get_the_ID())) {
    			echo get_the_post_thumbnail(get_the_ID(),array('class'=>"sitemap_th"));
 			} else {
    			echo '<img src="/wp-content/themes/makeblog/img/make-hdr-logo.png" class="attachment-sitemap_th"/>';
 			}
*/			
		?>
		

		<span class="sitemap_date"><?php echo get_the_date( 'Y-m-d' ); ?></span><br />
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php /*echo get_post_type(get_the_ID())*/ ?></li>
		
		
		<?php
		
		endwhile;
		
		echo "</ul>";
		
		?>
		
		
		<nav class="pagination">
			<?php pagination_bar();?>
		</nav>        
        
        
        <?php
        
        //reset
        wp_reset_query();
        
        

        
        
    } else {
    
    //there are no children categories
    //list links
	
	//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	//$offset = $postsperpage * $thepage;
		
		if ( $thepage == 0 ) { $offset = 0; } else { $offset = $postsperpage * ($thepage-1); }
		
		breadcrumb_links();
				
		$args = array('post_type' => $post_types, 'posts_per_page' => $postsperpage, 'cat' => $cat, 'paged' => get_query_var( 'paged' ), 'orderby' => 'date', 'offset' => $offset );
		
		$wp_query = new WP_Query($args);
		
		$total = $wp_query->found_posts;
		
		/* test
		echo "cat: ".$cat;
		echo "<br />";
		echo "Total: ".$total;
		echo "<br />";
		echo "Offset: ".$offset;
		echo "<br />";
		*/
		echo "<ul class=\"sitemap_links\">";
		
		while (have_posts()):the_post();
		
		?>
		
		<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> (<?php echo get_the_date( 'Y-m-d' ); ?>) <?php /*echo get_post_type(get_the_ID())*/ ?></li>
		
		<?php
		
		endwhile;
		
		echo "</ul>";
		
		?>
		
		<nav class="pagination">
			<?php pagination_bar(); ?>
		</nav>
	
		<?php
		
		wp_reset_query();

    	}
    
	}
	
}






}




add_shortcode('htmlsitemap_make', 'htmlsitemap_make_shortcode_handler');

?>