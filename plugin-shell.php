<?php
/**
 * Plugin Name: Plug-in Shell
 * Plugin URI: http://astalarico.com
 * Description: Events System
 * Version: 1.0.0
 * Author: A.S.Talarico
 * Author URI: http://astalarico.com
 * License: GPL2+
 */

/**
 * A.S.Talarico Plugin Shell
 * Index
 *
 * @category WordPressPlugin
 * @package BLANK
 * @author Anthony Talarico <astalarico@gmail.com>
 * @license GPL2+
 * @version 1.0.0
 */

// Check that we're being called by WordPress.
if (!defined('ABSPATH')) {
    die("Please do not call this code directly!");
}
require_once 'defines.php';
require_once 'enqueue.php';
//require_once 'cpt.php';