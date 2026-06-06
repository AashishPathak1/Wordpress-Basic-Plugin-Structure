<?php

/**
 * @package DummyPlugin
 */

/**
 * Plugin Name: Dummy Plugin
 * Plugin URI: https://example.com/dummy-plugin
 * Description: A lightweight starter template for a WordPress plugin.
 * Version: 1.0.1
 * Author: Aashish Pathak
 * Author URI: https://example.com
 * License: GPL
 * Text Domain: dummy-plugin
 * Domain Path: /languages
 */

/**
 * Security Check
 *
 * Stop direct access to this file.
 * Only allow WordPress to load it.
 */
if (!defined('ABSPATH')) {
    exit;
}

/*
|--------------------------------------------------------------------------
| Composer Autoloader
|--------------------------------------------------------------------------
|
| Loads all classes automatically.
| No need to manually require each class file.
|
*/

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

/**
 * Plugin Constants
 */

// Physical file location (used by PHP)
define("PLUGIN_PATH", plugin_dir_path(__FILE__));

// Website URL (used for CSS, JS, Images)
define("PLUGIN_URL", plugin_dir_url(__FILE__));

/**
 * Service Loader
 *
 * Check if the Init class exists.
 *
 * If it exists:
 * 1. Load all registered services.
 * 2. Create objects for those services.
 * 3. Run their register() methods.
 *
 * Flow:
 *
 * Plugin Starts
 *      ↓
 * Init Exists?
 *      ↓
 * register_services()
 *      ↓
 * Load Admin Class
 * Load Enqueue Class
 * Load Other Services
 */
if (class_exists('DummyPlugin\\Init')) {
    DummyPlugin\Init::register_services();
}


/*
 * * Quick Memory Checks
 */