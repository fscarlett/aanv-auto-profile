<?php 
/* 
Plugin Name: AANV Auto Profile
Plugin URI: https://foxscarlett.com
Description: For Art Association Napa Valley. Automatically creates an Artist Profile when a new member registers.
Author: Fox Scarlett for West County Media
Author URI: https://www.westcountymedia.com/
Version: 0.1
License: GPL2
*/

if(!defined('ABSPATH')) {
	exit;
}


add_action( 'user_register', 'aanv_create_profile', 10, 1 );

function aanv_create_profile( $user_id ) {

	$aanv_user_info = get_userdata( $user_id );

	$aanv_user_post = array(
        'post_title'   => $aanv_user_info->nickname,
        'post_type'    => 'aanv_profile', 
        'post_status' => 'publish',
    );

	$post_id = wp_insert_post( $aanv_user_post );

	$aanv_author_arg = array(
    'ID' => $post_id,
    'post_author' => $user_id,
	);

	wp_update_post( $aanv_author_arg );

}