<?php

/**
 * @package DummyPlugin
 */

namespace DummyPlugin\Base;

/**
 * Asset Loader
 *
 * This class is responsible for:
 * 1. Loading CSS files.
 * 2. Loading JavaScript files.
 * 3. Registering asset-related WordPress hooks.
 *
 * Think of this class as the plugin's
 * "Delivery Boy" for CSS and JS files.
 */
class Enqueue
{
    /**
     * Register WordPress hooks.
     *
     * This method is automatically called by:
     *
     * Init::register_services()
     *
     * Flow:
     * Init
     *  ↓
     * Enqueue Object Created
     *  ↓
     * register()
     *  ↓
     * admin_enqueue_scripts Hook Added
     */
    public function register()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

    /**
     * Load CSS and JavaScript files.
     *
     * This runs automatically when
     * WordPress loads an admin page.
     *
     * Purpose:
     * - Load plugin styles
     * - Load plugin scripts
     */
    public function enqueue()
    {
        /**
         * Load CSS File
         *
         * PLUGIN_URL
         * = Website address of plugin folder
         *
         * Example:
         * http://localhost/demo/wp-content/plugins/dummy-plugin/
         */

        wp_enqueue_style(
            'mypluginstyle',
            PLUGIN_URL . 'assets/mystyle.css'
        );

        /**
         * Load JavaScript File
         */

        wp_enqueue_script(
            'mypluginscript',
            PLUGIN_URL . 'assets/myscript.js'
        );
    }
}


/**
 * * Quick Memory Notes
 */
// register()
// = Register WordPress hooks

// add_action()
// = Tell WordPress to run something later

// admin_enqueue_scripts
// = Load CSS/JS in Admin Panel

// enqueue()
// = Load assets (CSS & JS)

// wp_enqueue_style()
// = Load CSS file

// wp_enqueue_script()
// = Load JavaScript file

// PLUGIN_URL
// = Website address of plugin

// URL = Load assets
// PATH = Load PHP files