<?php
/**
 * Plugin Name: Lynt mail fixer
 * Description: Lynt set up correct mail sender
 * Author:      Vladimir Smitka
 * Author URI:  https://lynt.cz/
 * License:     GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

defined( 'ABSPATH' ) or die( 'nothing here' );

//Set Sender to From address 
add_action('phpmailer_init', 'lynt_customize_mail_headers');   
function lynt_customize_mail_headers($phpmailer) {
    $phpmailer->Sender = $phpmailer->From;
}
