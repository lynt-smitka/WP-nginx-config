<?php
/**
 * Plugin Name: Lynt Team Cookie
 * Description: Set cookie lynt_team after open the administration - useful for excluding users from analytics
 * Author:      Vladimir Smitka
 * Author URI:  https://lynt.cz/
 * License:     GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */
defined( 'ABSPATH' ) or die( 'nothing here' );

function lynt_team_cookie() {
  setcookie('lynt_team', 1, time() + (86400 * 365 * 3), "/");
}
add_action('admin_init', 'lynt_team_cookie');
