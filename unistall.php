<?php

/**
 * *Trigger this file when the plugin is uninstalled. 
 * @package DummyPlugin
 */

/**
 * Security Check
 *
 * Only allow WordPress to run this file.
 * Prevent direct access from the browser.
 *
 * This file runs when:
 *
 * Plugins
 *    ↓
 * Delete Plugin
 *    ↓
 * uninstall.php
 */

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

/**
 * Get all Book posts.
 *
 * post_type => book
 * numberposts => -1
 *
 * -1 means:
 * "Get all posts."
 */

$books = get_posts(array(
    'post_type'   => 'book',
    'numberposts' => -1,
));

/**
 * METHOD 1
 * Delete posts using WordPress functions.
 *
 * Safer approach.
 * WordPress handles all cleanup.
 */

// foreach ($books as $book) {

//     /**
//      * false
//      * = Move to Trash
//      *
//      * true
//      * = Permanently Delete
//      */

//     wp_delete_post($book->ID, true);
// }

/**
 * METHOD 2
 * Delete directly from the database.
 *
 * Faster approach.
 * Useful when removing large amounts of data.
 *
 * WARNING:
 * Direct SQL bypasses WordPress functions.
 * Use carefully.
 */

/**
 * Access the WordPress database object.
 *
 * $wpdb
 * = WordPress Database Helper
 */

global $wpdb;

/**
 * Delete all Book posts.
 */

$wpdb->query("
    DELETE FROM wp_posts
    WHERE post_type = 'book'
");

/**
 * Remove orphaned postmeta records.
 *
 * Orphaned
 * = Meta data that belongs to a post
 * that no longer exists.
 */

$wpdb->query("
    DELETE FROM wp_postmeta
    WHERE post_id NOT IN (
        SELECT ID FROM wp_posts
    )
");

/**
 * Remove orphaned taxonomy relationships.
 *
 * Example:
 *
 * Book Deleted
 *      ↓
 * Category Relationship Still Exists
 *      ↓
 * Cleanup Removes It
 */

$wpdb->query("
    DELETE FROM wp_term_relationships
    WHERE object_id NOT IN (
        SELECT ID FROM wp_posts
    )
");



/**
 **Quick Memory NOTES
 */

// deactivate.php
// = Plugin OFF

// uninstall.php
// = Plugin DELETED

// get_posts()
// = Get records from WordPress

// wp_delete_post()
// = Delete using WordPress

// $wpdb
// = Direct database access

// wp_posts
// = Stores posts

// wp_postmeta
// = Stores custom fields

// wp_term_relationships
// = Stores category/tag links

// DELETE query
// = Remove data from database