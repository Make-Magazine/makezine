<?php 

function make_youtube_embed($width,$height) {
	global $post;

	$big_video = get_post_meta( $post->ID, 'Link', true );
	if ( empty( $big_video ) )
		return;

	$url = 'http://www.youtube.com/embed/' . urlencode( $big_video ) . '?showinfo=0&amp;hd=1&amp;mode=transparent';
	
}


function make_youtube_iframe($id, $width = 605, $height = 340) {
	if ( empty( $id ) ) {
		return;
	} else {
		$url = esc_url( 'http://www.youtube.com/embed/' . $id . '?showinfo=0&amp;hd=1&amp;mode=transparent' );
		$output = '<iframe width="' . esc_attr( $width ) . '" height="'. esc_attr( $height ) .'" src="' . $url . '" frameborder="0" allowfullscreen></iframe>';
		return $output;
	}	
}
