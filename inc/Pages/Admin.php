<?php

/**
 * @package DummyPlugin
 */

namespace DummyPlugin\Pages;

/**
 * Admin Page Handler
 *
 * This class is responsible for:
 * 1. Registering the admin menu.
 * 2. Creating the menu page.
 * 3. Loading the admin page template.
 */
class Admin
{
    /**
     * Register all WordPress hooks for this class.
     *
     * This method is called automatically by:
     * Init::register_services()
     *
     * Flow:
     * Init
     *  ↓
     * Admin Object Created
     *  ↓
     * register()
     *  ↓
     * admin_menu Hook Added
     */
    public function register()
    {
        add_action('admin_menu', array($this, 'add_admin_pages'));
    }

    /**
     * Create a new menu item in WordPress Admin.
     *
     * add_menu_page()
     * = Creates a top-level admin menu.
     *
     * Menu Name:
     * Dummy Case
     *
     * When clicked:
     * admin_index() will run.
     */
    public function add_admin_pages()
    {
        add_menu_page(
            'DummyPlugin',                     // Page Title
            'Dummy Case',                      // Menu Title
            'manage_options',                  // Required Capability
            'dummy_plugin',                    // Menu Slug
            array($this, 'admin_index'),       // Callback Function
            'dashicons-hourglass',             // Menu Icon
            110                                // Menu Position
        );
    }

    /**
     * Admin Page Callback
     *
     * Runs when the menu page is opened.
     *
     * Example:
     * Dashboard
     *  ↓
     * Dummy Case
     *  ↓
     * Click
     *  ↓
     * admin_index()
     *  ↓
     * Load admin.php
     */
    public function admin_index()
    {
        /**
         * PLUGIN_PATH
         * = Physical location of plugin files.
         *
         * Example:
         * C:/xampp/htdocs/demo/wp-content/plugins/dummy-plugin/
         *
         * Use PATH when loading PHP files.
         */

        require_once PLUGIN_PATH . 'templates/admin.php';
    }
}



/**
 * * QUICK MEMORY NOTES
 */

// register()
// = Register WordPress hooks

// add_action()
// = Tell WordPress to run something later

// admin_menu
// = Hook that creates Admin Menu items

// add_admin_pages()
// = Create menu item

// add_menu_page()
// = Add a top-level admin menu

// admin_index()
// = Page that opens when menu is clicked

// array($this, 'method')
// = Run this object's method

// PLUGIN_PATH
// = Physical file location

// require_once
// = Load a PHP file once