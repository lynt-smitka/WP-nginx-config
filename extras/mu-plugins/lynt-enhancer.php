<?php
/**
 * Plugin Name: Lynt enhancer
 * Description: Lynt security customizations
 * Plugin URI:  https://github.com/lynt-smitka/WP-nginx-config/blob/master/extras/mu-plugins/lynt-enhancer.php
 * Author:      Vladimir Smitka
 * Author URI:  https://lynt.cz/
 * License:     GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

defined( 'ABSPATH' ) or die( 'nothing here' );

//Enable bcrypt - PHP 5.5+
global $wp_hasher;

if ( empty($wp_hasher) ) {
  require_once( ABSPATH . WPINC . '/class-phpass.php');
  $wp_hasher = new PasswordHash(10, false);
}


//Remove sensitive data from REST API
//User endpoint
function lynt_remove_sensitive_data_from_rest_user( $response ) {
   
   if(!current_user_can('list_users')){
   
     //get WP_REST_Response
     $data = $response->get_data();
     //unset sensitive fields
     if(preg_replace('/[\W]+/', '',$data['name']) == preg_replace('/[\W]+/', '',$data['slug'])) $data['name']="Author";
     unset($data['link']);
     unset($data['slug']);
     unset($data['avatar_urls']);
     //set data back
     $response->set_data($data);
   }
   return $response;
}

//Comment endpoint
function lynt_remove_sensitive_data_from_rest_comment( $response ) {

   if(!current_user_can('list_users')){

     //get WP_REST_Response
     $data = $response->get_data();
     //unset sensitive fields
     unset($data['author_avatar_urls']);
     //set data back
     $response->set_data($data);
   }
   return $response;
}


add_filter( 'rest_prepare_user', 'lynt_remove_sensitive_data_from_rest_user');
add_filter( 'rest_prepare_comment', 'lynt_remove_sensitive_data_from_rest_comment');

//return 401 code after failed login, useful for fail2ban
function lynt_failed_login_401() {
  status_header( 401 );
}
add_action( 'wp_login_failed', 'lynt_failed_login_401' );
