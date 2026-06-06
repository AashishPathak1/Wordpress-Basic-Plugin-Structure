<?php

/**
 * @package DummyPlugin
 */

namespace DummyPlugin;

/**
 * Plugin Loader
 *
 * Acts like the plugin's "manager".
 * It loads all classes/services and starts them.
 */
final class Init
{
    /**
     * List all classes that should be loaded.
     *
     * Add new services here:
     * - Admin Pages
     * - Enqueue Assets
     * - Custom Post Types
     * - Settings Pages
     *
     * @return array
     */
    public static function get_services()
    {
        return [
            Pages\Admin::class,
            Base\Enqueue::class,
        ];
    }

    /**
     * Start all registered services.
     *
     * Flow:
     * 1. Get all classes.
     * 2. Create an object from each class.
     * 3. Run register() if available.
     */
    public static function register_services()
    {
        foreach (self::get_services() as $class) {

            // Create object from class name
            $service = self::instantiate($class);

            // Run register() if the method exists
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

    /**
     * Create a new object from a class name.
     *
     * Example:
     * Admin::class
     * becomes
     * new Admin()
     *
     * @param string $class
     * @return object
     */
    private static function instantiate($class)
    {
        return new $class();
    }
}

/**
 * * Quick Memory Notes
 * * get_services()      → What to load? 
 * * register_services() → Start everything. 
 * * instantiate()       → Create object.
 */

// get_services()
// = List of classes to load

// register_services()
// = Loop through the list and start everything

// instantiate()
// = Convert class name into an object

// self::
// = Call a method from the same class

// ::class
// = Get the full class name as a string

// method_exists()
// = Check if a method exists before calling it