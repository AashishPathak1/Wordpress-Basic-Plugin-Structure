<?php

/**
 * @package DummyPlugin
 */

namespace DummyPlugin\Base;

/**
 * Plugin Deactivation Handler
 *
 * This class runs when the plugin is deactivated.
 *
 * Think of it as the plugin's "cleanup worker".
 *
 * Its job is to remove or refresh things
 * that WordPress no longer needs after
 * the plugin is turned off.
 */
class Deactivate
{
    /**
     * Runs during plugin deactivation.
     *
     * This method is connected to:
     *
     * register_deactivation_hook()
     *
     * Flow:
     * User clicks "Deactivate"
     *          ↓
     * WordPress runs deactivate()
     *          ↓
     * Cleanup tasks happen
     */
    public static function deactivate()
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
         * If the plugin created custom URLs
         * or Custom Post Types, WordPress needs
         * to refresh them when the plugin is disabled.
         */

        flush_rewrite_rules();
    }
}


/**
 * * Quick Memory Notes
 */

// Activate
// = Runs when plugin is turned ON

// Deactivate
// = Runs when plugin is turned OFF

// static
// = Can be called without creating an object

// flush_rewrite_rules()
// = Refresh WordPress URLs

// register_deactivation_hook()
// = Tell WordPress what to run on deactivation