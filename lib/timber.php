<?php
/**
 * Conditional tags for Timber
 */

function add_to_context( $data ){
  //menu
  $data['main_menu'] = new TimberMenu( 'main_menu' );
  $data['footer_menu'] = new TimberMenu( 'footer_menu' );

  if ( function_exists('yoast_breadcrumb') ) {
    $data['breadcrumbs'] = yoast_breadcrumb('<p id="breadcrumbs">','</p>', false );
  }

  return $data;
}
add_filter( 'timber_context', 'add_to_context' );