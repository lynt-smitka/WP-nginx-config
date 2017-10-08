<?php
/**
 * Plugin Name: Lynt mail fixer
 * Description: Lynt set up correct mail settings
 * Author:      Vladimir Smitka
 * Author URI:  https://lynt.cz/
 * License:     GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

defined( 'ABSPATH' ) or die( 'nothing here' );

add_action('phpmailer_init', 'lynt_customize_mail_settings');
   
function lynt_customize_mail_settings($phpmailer) {
    //Set Sender to From address 
    $phpmailer->Sender = $phpmailer->From;
    
    //Setup your own SMTP server
    /*
    $phpmailer->Host = 'smpt.server';
    $phpmailer->Port = 465;
    $phpmailer->SMTPSecure = 'tls';
    $phpmailer->Username = 'jmeno';
    $phpmailer->Password = 'heslo';
    $phpmailer->SMTPAuth = true;
    $phpmailer->IsSMTP();
    */
}
