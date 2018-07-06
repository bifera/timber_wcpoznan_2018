<?php
require_once( __DIR__ . '/vendor/autoload.php' );

$timber = new \Timber\Timber();

$sage_includes = [
  'lib/timber.php',
  'lib/assets.php',
  'lib/setup.php',
  'lib/filters.php',
  'lib/Class-posts.php'
];

foreach ( $sage_includes as $file ) {
	if ( ! $filepath = locate_template( $file ) ) {
		trigger_error( sprintf( __( 'Error locating %s for inclusion', 'sasquatch' ), $file ), E_USER_ERROR );
	}

	require_once $filepath;
}

/**
 * Sober Intervention - cleaning wp-admin
 * more info on https://github.com/soberwp/intervention
 */
use function Sober\Intervention\intervention;

if ( function_exists( 'Sober\Intervention\intervention' ) ) {
  intervention( 'add-svg-support' );
}

function only_one_cat_blogpage($query) {
  if( !is_admin() && $query->is_home() && $query->is_main_query() ){
      $query->set( 'posts_per_page', '5' );
  }
}
add_action( 'pre_get_posts', 'only_one_cat_blogpage' );
