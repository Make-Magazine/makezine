<?php 
/*
Template Name: Hot Topics
*/

echo wp_kses_post( stripslashes( make_get_cap_option( 'hot_topics' ) ) );