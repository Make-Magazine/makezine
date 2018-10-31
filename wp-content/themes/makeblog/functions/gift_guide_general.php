<?php
// PHP stuff for gift-guide-general (2018)

////////////////////////////////////////////////////////////////////
// Add custom post type for Gift Guide
// https://codex.wordpress.org/Post_Types#Custom_Post_Types
////////////////////////////////////////////////////////////////////
function create_post_type() {
   register_post_type( 'gift_guide',
     array(
       'labels' => array(
         'name' => __( 'Gift Guide Items' ),
         'singular_name' => __( 'Gift Guide Item' )
       ),
       'public' => true,
       'has_archive' => true,
       'show_in_rest' => true
     )
   );
}
add_action( 'init', 'create_post_type' );


////////////////////////////////////////////////////////////////////
// Add "Category" taxonomy for Gift Guide
// https://codex.wordpress.org/Function_Reference/register_taxonomy
////////////////////////////////////////////////////////////////////
function gift_guide_category_init() {
   register_taxonomy( 'gift_guide_category', array( 'gift_guide' ), array(
      'hierarchical'            => false,
      'public'                  => true,
      'show_in_nav_menus'       => true,
      'show_ui'                 => true,
      'show_in_rest'            => true,
      'query_var'               => 'gift_guide_category',
      'rewrite'                 => true,
      'capabilities'            => array(
         'manage_terms'  => 'edit_posts',
         'edit_terms'    => 'edit_posts',
         'delete_terms'  => 'edit_posts',
         'assign_terms'  => 'edit_posts'
      ),
      'labels'                  => array(
         'name'                       =>  __( 'Gift Guide Categories', 'gift_guide_category' ),
         'singular_name'              =>  __( 'Gift Guide Category', 'gift_guide_category' ),
         'search_items'               =>  __( 'Search Gift Guide Categories', 'gift_guide_category' ),
         'popular_items'              =>  __( 'Popular Gift Guide Categories', 'gift_guide_category' ),
         'all_items'                  =>  __( 'All Gift Guide Categories', 'gift_guide_category' ),
         'parent_item'                =>  __( 'Parent Gift Guide Category', 'gift_guide_category' ),
         'parent_item_colon'          =>  __( 'Parent Gift Guide Category:', 'gift_guide_category' ),
         'edit_item'                  =>  __( 'Edit Gift Guide Category', 'gift_guide_category' ),
         'update_item'                =>  __( 'Update Gift Guide Category', 'gift_guide_category' ),
         'add_new_item'               =>  __( 'New Gift Guide Category', 'gift_guide_category' ),
         'new_item_name'              =>  __( 'New Gift Guide Category', 'gift_guide_category' ),
         'separate_items_with_commas' =>  __( 'Gift Guide Categories separated by comma', 'gift_guide_category' ),
         'add_or_remove_items'        =>  __( 'Add or remove Gift Guide Categories', 'gift_guide_category' ),
         'choose_from_most_used'      =>  __( 'Choose from the most used Gift Guide Categories', 'gift_guide_category' ),
         'menu_name'                  =>  __( 'Gift Guide Categories', 'gift_guide_category' ),
      ),
   ) );

}
add_action( 'init', 'gift_guide_category_init' );


////////////////////////////////////////////////////////////////////
// Add "Recipient" taxonomy for Gift Guide
// https://codex.wordpress.org/Function_Reference/register_taxonomy
////////////////////////////////////////////////////////////////////
function gift_guide_recipient_init() {
   register_taxonomy( 'gift_guide_recipient', array( 'gift_guide' ), array(
      'hierarchical'            => false,
      'public'                  => true,
      'show_in_nav_menus'       => true,
      //'show_admin_column'       => true,
      'show_ui'                 => true,
      'show_in_rest'            => true,
      'query_var'               => 'gift_guide_recipient',
      'rewrite'                 => true,
      'capabilities'            => array(
         'manage_terms'  => 'edit_posts',
         'edit_terms'    => 'edit_posts',
         'delete_terms'  => 'edit_posts',
         'assign_terms'  => 'edit_posts'
      ),
      'labels'                  => array(
         'name'                       =>  __( 'Gift Guide Recipients', 'gift_guide_recipient' ),
         'singular_name'              =>  __( 'Gift Guide Recipient', 'gift_guide_recipient' ),
         'search_items'               =>  __( 'Search Gift Guide Recipients', 'gift_guide_recipient' ),
         'popular_items'              =>  __( 'Popular Gift Guide Recipients', 'gift_guide_recipient' ),
         'all_items'                  =>  __( 'All Gift Guide Recipients', 'gift_guide_recipient' ),
         'parent_item'                =>  __( 'Parent Gift Guide Recipient', 'gift_guide_recipient' ),
         'parent_item_colon'          =>  __( 'Parent Gift Guide Recipient:', 'gift_guide_recipient' ),
         'edit_item'                  =>  __( 'Edit Gift Guide Recipient', 'gift_guide_recipient' ),
         'update_item'                =>  __( 'Update Gift Guide Recipient', 'gift_guide_recipient' ),
         'add_new_item'               =>  __( 'New Gift Guide Recipient', 'gift_guide_recipient' ),
         'new_item_name'              =>  __( 'New Gift Guide Recipient', 'gift_guide_recipient' ),
         'separate_items_with_commas' =>  __( 'Gift Guide Recipients separated by comma', 'gift_guide_recipient' ),
         'add_or_remove_items'        =>  __( 'Add or remove Gift Guide Recipients', 'gift_guide_recipient' ),
         'choose_from_most_used'      =>  __( 'Choose from the most used Gift Guide Recipients', 'gift_guide_recipient' ),
         'menu_name'                  =>  __( 'Gift Guide Recipients', 'gift_guide_recipient' ),
      ),
   ) );

}
add_action( 'init', 'gift_guide_recipient_init' );


////////////////////////////////////////////////////////////////////
// Add custom API endpoint for giftguide
// https://codex.wordpress.org/Function_Reference/register_taxonomy
////////////////////////////////////////////////////////////////////

add_action('rest_api_init', function () {
   //get faire data such as Meet the Makers and Schedule information based on form id(s)
   register_rest_route('gift-guide/v1', '/items', array(
       'methods' => 'GET',
       'callback' => 'mz_giftguide'
   ));
});

function mz_giftguide(WP_REST_Request $request) {
   $data['error'] = 'Error: Type or Form IDs not submitted';
   $data = get_gift_guide_response();
   wp_send_json($data);
   exit;
}

function get_gift_guide_response() {
   $gg_items = [];
   $gg_items_ordered = [];
   $gg_items_unordered = [];
   $args = array(
         'post_type' => 'gift_guide',
         'meta_key' => 'item_list_order',
         //'meta_type' => 'numeric',
         'orderby' => 'meta_value_num',
         'order' => 'ASC',
         'posts_per_page' => -1//$resultCount
       );
   $loop = new WP_Query( $args );
   $unorderedValue =  $loop->post_count + 1;
   while ( $loop->have_posts() ) {
      $loop->the_post();
      global $post;
      if(get_field('item_visibility') === 'visible') {
         $curItem = [];
         $curItem['title'] = get_the_title();
         $curItem['slug'] = $post->post_name;
         $curItem['item_list_order'] = get_field('item_list_order');
         $curItem['item_description'] = get_field('item_description');
         $curItem['item_id'] = get_the_ID('ID');
         $curItem['item_visibility'] = get_field('item_visibility');
         $curItem['item_image'] = get_field('item_image');
         $curItem['why_to_buy'] = get_field('why_to_buy');
         $curItem['item_price'] = get_field('item_price');
         $curItem['item_purchase_url'] = get_field('item_purchase_url');
         // $curItem['item_sponsored'] = get_field('item_sponsored');
         // $curItem['sponsored_badge'] = get_field('sponsored_badge');
         $curItem['item_editors_pick'] = get_field('item_editors_pick');
         $curItem['editors_pick_badge'] = get_field('editors_pick_badge');
         $curItem['item_categories'] = get_field('item_categories');
         $curItem['item_recipients'] = get_field('item_recipients');
         if(!$curItem['item_list_order']) {
            // Add a value greater than the number of items as the 'item_list_order' 
            // for items that don't have that defined; this prevents issues with sorting
            // in the 'default' order in JS on the frontend
            $curItem['item_list_order'] = $unorderedValue;
            $gg_items_unordered[] = $curItem;
         }
         else {
            $gg_items_ordered[] = $curItem;
         }
      }
   };
   wp_reset_query();
   // Returning items that have 'item_list_order' defined first, then any remaining items
   $gg_items = array_merge($gg_items_ordered, $gg_items_unordered);
   return $gg_items;
}

////////////////////////////////////////////////////////////////////
// Add Admin columns for Gift Guide
// https://codex.wordpress.org/Function_Reference/register_taxonomy
////////////////////////////////////////////////////////////////////

function add_gift_guide_columns($columns) {
   return array_merge($columns, 
            array(
               'item_list_order' => __('Item List Order'),
               'item_categories' => __('Item Categories'),
               'item_recipients' => __('Item Recipients'),
               'item_editors_pick' => __('Editor\'s Pick'),
               'item_permalink' => __('Item Permalink'),
               //'item_sponsored' => __('Sponsored')
            )
         );
}
add_filter('manage_gift_guide_posts_columns' , 'add_gift_guide_columns');
/* ADMIN COLUMN - HEADERS
*/
add_filter('manage_edit-gift_guide_sortable_columns', 'gift_guide_sort');
function gift_guide_sort($columns) {
   $columns['item_list_order'] = 'item_list_order';
   $columns['item_editors_pick'] = 'item_editors_pick';
   // $columns['item_list_order'] = 'item_list_order';
   return $columns;
}
/*
* ADMIN COLUMN - CONTENT
*/
add_action('manage_gift_guide_posts_custom_column', 'manage_gift_guide_columns', 10, 2);
function manage_gift_guide_columns($column_name, $post_id) {

  switch ($column_name) {
     case 'item_list_order':
         echo get_post_meta( $post_id , 'item_list_order' , true );
         break;
      case 'item_editors_pick':
         echo get_post_meta( $post_id , 'item_editors_pick' , true ) === 'yes' ? 'yes' : '';
         break;
      case 'item_permalink':
         $post = get_post( $post_id );
         $slug = $post->post_name;
         $permalink = get_site_url() . '/giftguide/#' . $slug;
         echo '<a href="'.$permalink.'" target="_blank">'.$permalink.'</a>';
         break;
      // case 'item_sponsored':
      //    echo get_post_meta( $post_id , 'item_sponsored' , true ) === 'yes' ? 'yes' : '';
      //    break;
      case 'item_categories':
         $terms = get_terms([
            'taxonomy' => 'gift_guide_category',
            'hide_empty' => false,
         ]);
         $localTerms = [];
         foreach($terms as $key => $term) {
            $tid = $term->term_id;
            $tmt = $term->name;
            $localTerms[$tid] = $tmt;
         }
         $itemCats = get_post_meta( $post_id , 'item_categories' , true );
         $catString = '';
         if(is_array($itemCats)) {
            foreach($itemCats as $cat) {
               $catString .= $localTerms[$cat] . ', ';
            };
            echo substr($catString, 0, -2);
         }
         break;

      case 'item_recipients':
         //echo get_post_meta( $post_id , 'item_recipients' , true );
         $terms = get_terms([
            'taxonomy' => 'gift_guide_recipient',
            'hide_empty' => false,
         ]);
         $localTerms = [];
         foreach($terms as $key => $term) {
            $tid = $term->term_id;
            $tmt = $term->name;
            $localTerms[$tid] = $tmt;
         }
         $itemCats = get_post_meta( $post_id , 'item_recipients' , true );
         $catString = '';
         if(is_array($itemCats)) {
            foreach($itemCats as $cat) {
               $catString .= $localTerms[$cat] . ', ';
            };
            echo substr($catString, 0, -2);
         }
         break;

     default:
         break;
  } // end switch
}
/*
* ADMIN COLUMN - SORTING - ORDERBY
* http://scribu.net/wordpress/custom-sortable-columns.html#comment-4732
*/
add_filter( 'pre_get_posts', 'gift_guide_column_orderby' );
function gift_guide_column_orderby( $query ) {
   if( ! is_admin() )  
   return; 
   $orderby = $query->get( 'orderby');
   if( 'item_list_order' == $orderby ) {
      $query->set('orderby','meta_value');
      $query->set('meta_key','item_list_order');
      $query->set( 'meta_type', 'numeric' );
   }
}

?>
