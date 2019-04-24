<?php
/**
 * Plugin Name: Lynt MO Cache
 * Description: Lynt translations performance booster - igbinary version EXPERIMENTAL
 * Plugin URI:  https://github.com/lynt-smitka/WP-nginx-config/blob/master/extras/mu-plugins/lynt-mo-cache-igb.php
 * Author:      Vladimir Smitka
 * Author URI:  https://lynt.cz/
 * License:     GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('ABSPATH') or die('nothing here');

function lynt_load_textdomain($retval, $domain, $mofile)
{
  global $l10n;
  if (!is_readable($mofile))
    return false;

  if (!function_exists('igbinary_serialize'))
    return false;


  $cache_path = WP_CONTENT_DIR . "/cache/lynt";
  if (!file_exists($cache_path)) {
    mkdir($cache_path, 0770, true);
  }
  $cache_file = sprintf('%s/mo-%s.igb',$cache_path, md5($mofile));


  if (file_exists($cache_file)) {
    $data = igbinary_unserialize(file_get_contents($cache_file));
  } else {
    $data = false;
  }

  $mtime = filemtime($mofile);

  $mo = new MO();
  if (!$data || !isset($data['mtime']) || $mtime > $data['mtime']) {
    if (!$mo->import_from_file($mofile)) return false;
    // prepare structure
    $data = array(
      'mtime' => $mtime,
      'file' => $mofile,
      'entries' => $mo->entries,
      'headers' => $mo->headers
    );

    // export mo object
    file_put_contents($cache_file, igbinary_serialize($data), LOCK_EX);
  } else {
    $mo->entries = $data['entries'];
    $mo->headers = $data['headers'];
  }
  if (isset($l10n[$domain])) {
    $mo->merge_with($l10n[$domain]);
  }
  $l10n[$domain] = &$mo;
  return true;
}

add_filter('override_load_textdomain', 'lynt_load_textdomain', 0, 3);

