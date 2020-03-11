<?php

/*
 * As of ACF 5.60, they default removed the custom fields option on pages. This adds it back
 */

function mf_acf_init() {
  acf_update_setting('remove_wp_meta_box', false);
}

add_action('acf/init', 'mf_acf_init');


add_filter('acf/load_field/key=field_55de4a5cb9453', 'set_default_displaycategory');

function set_default_displaycategory($field) {
  $field['default_value'] = array(4523); // taxonomy term "news" in Tags
  return $field;
}