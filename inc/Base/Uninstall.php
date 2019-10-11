<?php

/**
*
*@package ABC Plugin
*/

namespace Inc\Base;

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}

/**Clear Database stored data
//$turbines = get_posts( array( 'post_type' => 'turbine', 'numberposts' => -1 ) );

foreach( $turbines as $turbine ) {
    wp_delete_post( $turbine->ID, true );
}

// Access the database via SQL
global $wpdb;
$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'turbine'" );
$wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
$wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)" );
?> */ 