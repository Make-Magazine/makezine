<?php
/**
 * Template Name: Beat Reports
 */

$authors = array(
	'fitzwillie' => array(
		'name' => 'Ken Denmead',
		'beat' => '',
		'title' => 'Editorial Director',
		'username' => 'fitzwillie',
		),
	'frauenfelder' => array(
		'name' => 'Mark Frauenfelder',
		'beat' => '',
		'title' => 'Editor at large',
		'username' => 'frauenfelder',
		),
	'stettholbrook1234' => array(
		'name' => 'Stett Holbrook',
		'beat' => 'Food, Sustainability, and Young Makers',
		'title' => 'Senior Editor',
		'username' => 'stettholbrook1234',
		),
	'snowgoli' => array(
		'name' => 'Goli Mohammadi',
		'beat' => 'Art and Craft',
		'title' => 'Senior Editor',
		'username' => 'snowgoli',
		),
	'khammondoreillycom' => array(
		'name' => 'Keith Hammond',
		'beat' => 'Alternative Transportation, Alternative Energy, Outdoor, and DIY Space',
		'title' => 'Projects Editor',
		'username' => 'khammondoreillycom',
		),
	'ignoblegnome' => array(
		'name' => 'Andrew Terranova',
		'beat' => 'Robotics',
		'title' => 'Contributing Writer',
		'username' => 'ignoblegnome',
		),
	'aallan' => array(
		'name' => 'Alasdair Allan',
		'beat' => 'Electronics and Arduino',
		'title' => 'Contributing Editor',
		'username' => 'aallan',
		),
	'seanmichaelragan' => array(
		'name' => 'Sean Ragan',
		'beat' => 'Science and 3D Printing',
		'title' => 'MAKE technical editor',
		'username' => 'seanmichaelragan',
		),
	'lauracochrane' => array(
		'name' => 'Laura Cochrane',
		'beat' => 'Craft and Young Makers',
		'title' => 'Assistant Editor',
		'username' => 'lauracochrane',
		),
	'makemattr' => array(
		'name' => 'Matt Richardson',
		'beat' => 'Electronics &amp; Embedded Platforms',
		'title' => 'MAKE contributing editor',
		'username' => 'makemattr',
		),
	'devinck' => array(
		'name' => 'Marc de Vinck',
		'beat' => '3D Printing, Robotics',
		'title' => 'Contributing Writer',
		'username' => 'devinck',
		),
	'skotcroshere' => array(
		'name' => 'Skot Croshere',
		'beat' => 'Arduino and Electronics',
		'title' => 'Contributing Writer',
		'username' => 'skotcroshere',
		),
	'pushtheotherbutton' => array(
		'name' => 'Michael Colombo',
		'beat' => 'Workshop',
		'title' => 'Contributing Writer',
		'username' => 'pushtheotherbutton',
		),
	'travisgood' => array(
		'name' => 'Travis Good',
		'beat' => 'Maker Pro and Makerspaces',
		'title' => 'Contributing Writer',
		'username' => 'travisgood',
		),
	'dcdenison' => array(
		'name' => 'D.C. Denison',
		'beat' => 'Maker Pro',
		'title' => 'Contributing Writer',
		'username' => 'dcdenison',
		),
	);

foreach ( $authors as $author ) {
	
	$user = get_user_by( 'login', $author['username'] );
	$user_id = ( isset( $user->data->ID ) ) ? $user->data->ID : '';
	echo '<div class="row" style="margin-bottom:20px;">';
	echo '<div class="span2">';
		echo ( $user ) ? '<a href="' . get_author_link( false, $user_id ) . '">' . get_avatar( $user->data->user_email, '140', '', $user_id ) . '</a>' : '';
	echo '</div>';	
	echo '<div class="span6">';
		echo ( $user ) ? '<h3><a href="' . get_author_link( false, $user_id ) . '">' . esc_html( $author['name'] ) . '</a> <small>' . esc_html( $author['title'] ) . '</small></h3>' : '';
		echo ( !empty( $author['beat'] ) ) ? '<h4>Beat: ' . esc_html( $author['beat'] ) . '</h4>' : '' ;
		$args = array(
			'author' => $user_id,
			'posts_per_page' => 5,
			'post_type' => array( 'post', 'craft' ),
			'no_found_rows' => true,
		);
		echo '<ul>';
		$the_query = new WP_Query( $args );
		while ( $the_query->have_posts() ) : $the_query->the_post();
			echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
		endwhile;
		echo '</ul>';
		echo '<p><a href="' . get_author_link( false, $user_id ) . '">Read more &rarr;</a></p>';
	echo '</div></div>';
}
