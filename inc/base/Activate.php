<?php

/**
 * @package DummyPlugin
 */

namespace DummyPlugin\Base;

/**
 * Plugin Activation Handler
 *
 * This class runs when the plugin is activated.
 *
 * Think of it as the plugin's "setup worker".
 *
 * Its job is to prepare WordPress
 * before the plugin starts running.
 */
class Activate
{
    /**
     * Runs during plugin activation.
     *
     * This method is connected to:
     *
     * register_activation_hook()
     *
     * Flow:
     * User clicks "Activate"
     *          ↓
     * WordPress runs activate()
     *          ↓
     * Setup tasks happen
     *          ↓
     * Plugin becomes active
     */
    public static function activate()
    {
        /**
         * Refresh WordPress rewrite rules.
         *
         * Rewrite rules control URLs such as:
         *
         * example.com/books
         * example.com/products
         * example.com/news
         *
         * If the plugin creates:
         * - Custom Post Types
         * - Custom URL structures
         * - Custom Rewrite Rules
         *
         * WordPress needs to rebuild its URL map.
         */

        flush_rewrite_rules();
    }
}


/**
 * * Quick Memory Notes
 */

// Activate
// = Runs when plugin is turned ON

// static
// = No object needed

// register_activation_hook()
// = Tell WordPress what to run on activation

// flush_rewrite_rules()
// = Refresh WordPress URLs

// Activation = Setup
// Deactivation = Cleanup