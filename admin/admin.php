<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit; 

/**
 * Add Zarget tab to the admin menu.
 */
function zarget_admin_menu() {
	add_menu_page( __( 'Zarget', 'zarget' ), __( 'Zarget', 'zarget' ), 'manage_options', 'zarget-config', 'zarget_conf', plugin_dir_url( __FILE__ ) . '../public/images/zarget-icon.png' );
}
add_action( 'admin_menu', 'zarget_admin_menu' );


/**
 * Add plugin action links for Zarget.
 * @param array $links
 * @param string $file
 * @return array
 */
function zarget_plugin_action_links( $links, $file ) {
	if ( $file == 'zarget/zarget.php' ) {
		$links[] = '<a href="admin.php?page=zarget-config">' . esc_html__( 'Settings', 'zarget' ) . '</a>';
	}
	return $links;
}
add_filter( 'plugin_action_links', 'zarget_plugin_action_links', 10, 2 );


/**
 * Update the Zarget option params.
 */
function zarget_conf() {
	
	if ( ! current_user_can( 'manage_options' ) ) {
			die;
        }
	if ( isset($_POST['nonce']) && isset( $_POST['token']) &&
			wp_verify_nonce($_POST['nonce'], 'wporg_authtoken_verify') ) {

		// Sanitizing the input params
		$token = sanitize_text_field( $_POST['token'] );
		$auth_token = sanitize_text_field( $_POST['auth_token'] );
		$org_id= sanitize_text_field( $_POST['org_id'] );
		$project_id= sanitize_text_field( $_POST['project_id'] );
		$user_id= sanitize_text_field( $_POST['user_id'] );
		$project_code = sanitize_text_field( $_POST['project_code'] );

		// Processing org's script	
		if ( empty( $project_code) ) {
			delete_option( 'zarget_project_code' );
		} else {
			update_option( 'zarget_project_code', $project_code);
		}
		// Processing org's token 
		if ( empty( $token ) ) {
			delete_option( 'zarget_token' );
		} else {
			update_option( 'zarget_token', $token );
		}
		// Processing org's auth token 
		if ( empty( $auth_token ) ) {
			delete_option( 'zarget_auth_token' );
		} else {
			update_option( 'zarget_auth_token', $auth_token );
		}
		// Processing org id
		if ( empty( $org_id ) ) {
			delete_option( 'zarget_org_id' );
		} else {
			update_option( 'zarget_org_id', $org_id );
		}
		// Processing project id
		if ( empty( $project_id ) ) {
			delete_option( 'zarget_project_id' );
		} else {
			update_option( 'zarget_project_id', $project_id );
		}

		// Processing user id
		if ( empty( $user_id ) ) {
			delete_option( 'zarget_user' );
		} else {
			update_option( 'zarget_user_id', $user_id );
		}

	}
	//Navigating to configure page
	include( dirname( __FILE__ ) . '/../config/config.php' );
}

// Calling adminutils.php to get data from Zarget App
if(isset($_GET['token'],$_GET['orgid'])){
	$site_url = get_site_url();
	include 'adminutils.php'; 
	echo getOrgDetails($_GET['token'],$_GET['orgid'], $site_url);
}

?>
