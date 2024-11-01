<?php 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit; 

//Getting Org Details by calling REST API
	function getOrgDetails($token, $orgid, $site_url) {
		$args = array(
				'headers' => array(
					'_at' => $token,'apirequest'=>'true' )
			     );
		$url =  get_option('zarget_url').'/ab/api/org/'.$orgid.'/wordpress/token/validate?site_url='.$site_url;
		$response = wp_remote_post( $url, $args );
		$http_code = wp_remote_retrieve_response_code( $response );
		//echo $http_code;
		return wp_remote_retrieve_body( $response);		
	}
 
?>
