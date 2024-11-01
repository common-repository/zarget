<?php
/**
 * @package Zarget 
 * @version 1.0
 */

/*
Plugin Name: Zarget
Plugin URI:  http://wordpress.org/extend/plugins/zarget/ 
Description: This plugin helps you to connect with Zarget, a simple and powerful tool to optimize your Wordpress site using A/B testing, heatmaps and other optimization tools. Zarget is an all-in-one conversion rate optimization platform.
Version:     1.0.1 
Author:      integrations@zarget.com
Author URI:  http://apps.zarget.com 
License:     GPLv3
Text Domain: zarget 
*/

/*
Copyright 2016 Osmnez Technologies Inc (email: support@zarget.com).

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit; 

// Include files are only required on the admin dashboard
if (is_admin()) {
	require_once( dirname( __FILE__ ) . '/admin/admin.php' );
}


/**
 * Enqueues zarget's dependency scripts
 */
function zarget_enqueue_scripts() {
	// Core scripts
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_enqueue_script( 'jquery-ui-progressbar' );
	wp_enqueue_script( 'jquery-ui-tooltip' );

	// Console scripts	
	wp_enqueue_script( 'zarget_new_api', plugins_url( 'public/js/zarget.js', __FILE__ ), array( 'jquery' ) );
	wp_enqueue_script( 'zarget_config', plugins_url( 'config/js/config.js', __FILE__ ), array( 'jquery' ) );
	
	// Console styles
	wp_enqueue_style( 'zarget_config_styles', plugins_url( 'config/css/config.css', __FILE__ ) );
}
add_action( 'admin_enqueue_scripts', 'zarget_enqueue_scripts' );


/**
 * Inserting Zarget's one-line script 
 */
function zarget_insert_script() {
	$project_id = get_option( 'zarget_project_id' );
	$org_id= get_option( 'zarget_org_id' );
	$project_code = get_option( 'zarget_project_code' );
	if ( !empty($org_id) && ! empty( $project_id ) && ! empty( $project_code)) {
		echo '<script src="'.$project_code.'"></script>';
	}
}
add_action( 'wp_head', 'zarget_insert_script', -1000 );

//Handler for zarget plugin activation
register_activation_hook( __FILE__, 'zarget_plugin_activate' );

//Handler for zarget plugin deactivation
register_deactivation_hook( __FILE__, 'zarget_plugin_deactivate' );

//Function to execute on plugin's deactivation
function zarget_plugin_deactivate(){
	if ( !empty(get_option( 'zarget_token' ))) {
		delete_option( 'zarget_token' );
	} 
	if ( !empty(get_option( 'zarget_auth_token' ))) {
		delete_option( 'zarget_auth_token' );
	} 
	if ( !empty(get_option( 'zarget_org_id' ))) {
		delete_option( 'zarget_org_id' );
	} 
	if ( !empty(get_option( 'zarget_project_id' ))) {
		delete_option( 'zarget_project_id' );
	} 
	if ( !empty(get_option( 'zarget_url' ))) {
		delete_option( 'zarget_url' );
	}
	if ( !empty(get_option( 'zarget_user_id' ))) {
		delete_option( 'zarget_user_id' );
	}
	if ( !empty(get_option( 'zarget_project_code' ))) {
		delete_option( 'zarget_project_code' );
	}
}

//Function to execute on plugin's activation
function zarget_plugin_activate(){
	if ( version_compare( PHP_VERSION, '5.5', '<' ) )
	{
	    exit( sprintf( 'Zarget plugin requires PHP 5.5 or higher. You’re still on %s.', PHP_VERSION ) );
	}	
	
	if ( empty(get_option( 'zarget_url' ))) {
		//Persisting Zarget App Link
                update_option( 'zarget_url' , 'http://app.zarget.com');
        }
}
?>
