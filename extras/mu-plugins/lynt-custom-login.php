<?php
/**
 * Plugin Name: Lynt custom login
 * Description: Allow wp-login.php only with cookie obtained from custom URL.
 * Author:      Vladimir Smitka
 * Author URI:  https://lynt.cz/
 * License:     GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */
defined( 'ABSPATH' ) or die( 'nothing here' );

if ( !defined('LYNT_CUSTOM_LOGIN_URL') )
  define('LYNT_CUSTOM_LOGIN_URL', '/my-admin');

function lynt_handler_custom_login() {

  $path  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

  if($path === LYNT_CUSTOM_LOGIN_URL) {

    $nonce = wp_create_nonce('lynt-custom-login');
    setcookie('wp_lynt_custom_login', $nonce); 
    wp_redirect(implode('?', array_filter(array('/wp-login.php',$query))));
    exit;
  }
}

function lynt_check_custom_login(){  
   $nonce = $_COOKIE['wp_lynt_custom_login'];
  if (!wp_verify_nonce($nonce, 'lynt-custom-login')) {
    header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
    exit;
  }
}

add_action('parse_request', 'lynt_handler_custom_login');
add_action('login_init', 'lynt_check_custom_login');
