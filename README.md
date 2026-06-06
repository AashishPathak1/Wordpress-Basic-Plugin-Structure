# Dummy Plugin

A lightweight WordPress plugin boilerplate built using Object-Oriented Programming (OOP), PSR-4 autoloading, and a service container pattern.

This project is designed as a learning-focused plugin architecture that demonstrates how to organize WordPress plugins using modern PHP practices.

---

## Features

* Object-Oriented Plugin Structure
* PSR-4 Composer Autoloading
* Service Loader Pattern
* WordPress Admin Menu Page
* Asset Enqueuing (CSS & JavaScript)
* Plugin Activation Hook
* Plugin Deactivation Hook
* Plugin Uninstall Cleanup
* Easy to Extend and Maintain

---

## Project Structure

```text
dummy-plugin/
│
├── assets/
│   ├── myscript.js
│   └── mystyle.css
│
├── templates/
│   └── admin.php
│
├── inc/
│   ├── Base/
│   │   ├── Activate.php
│   │   ├── Deactivate.php
│   │   └── Enqueue.php
│   │
│   ├── Pages/
│   │   └── Admin.php
│   │
│   └── Init.php
│
├── vendor/
│
├── uninstall.php
├── composer.json
└── dummy-plugin.php
```

---

# How It Works

The plugin follows a Service Loader architecture.

Instead of manually initializing every class, a central `Init` class loads and registers all services automatically.

```php
DummyPlugin\Init::register_services();
```

Flow:

```text
Plugin Loads
      ↓
Init::register_services()
      ↓
Get All Services
      ↓
Instantiate Classes
      ↓
Call register()
      ↓
Plugin Starts Working
```

---

# Service Loader

The `Init` class acts as the plugin manager.

### Register Services

```php
public static function get_services()
{
    return [
        Pages\Admin::class,
        Base\Enqueue::class,
    ];
}
```

### Load Services

```php
public static function register_services()
{
    foreach (self::get_services() as $class) {

        $service = self::instantiate($class);

        if (method_exists($service, 'register')) {
            $service->register();
        }
    }
}
```

---

# Admin Page

The Admin service creates a custom WordPress admin menu.

```php
add_menu_page(
    'DummyPlugin',
    'Dummy Case',
    'manage_options',
    'dummy_plugin',
    array($this, 'admin_index')
);
```

Result:

```text
Dashboard
    ↓
Dummy Case
```

---

# Asset Loading

CSS and JavaScript are loaded through the Enqueue service.

```php
wp_enqueue_style(
    'mypluginstyle',
    PLUGIN_URL . 'assets/mystyle.css'
);
```

```php
wp_enqueue_script(
    'mypluginscript',
    PLUGIN_URL . 'assets/myscript.js'
);
```

---

# Activation Hook

Runs when the plugin is activated.

```php
Activate::activate();
```

Purpose:

```php
flush_rewrite_rules();
```

This refreshes WordPress rewrite rules and URL structures.

---

# Deactivation Hook

Runs when the plugin is deactivated.

```php
Deactivate::deactivate();
```

Purpose:

```php
flush_rewrite_rules();
```

This removes stale rewrite rules.

---

# Uninstall Process

When the plugin is deleted, `uninstall.php` runs.

Responsibilities:

* Delete Custom Post Type data
* Remove orphaned metadata
* Remove orphaned taxonomy relationships

Example:

```php
DELETE FROM wp_posts
WHERE post_type = 'book'
```

---

# Constants

### PLUGIN_PATH

Physical server path.

```php
define(
    'PLUGIN_PATH',
    plugin_dir_path(__FILE__)
);
```

Example:

```text
C:\xampp\htdocs\demo\wp-content\plugins\dummy-plugin\
```

Used for:

```php
require_once PLUGIN_PATH . 'templates/admin.php';
```

---

### PLUGIN_URL

Public URL for assets.

```php
define(
    'PLUGIN_URL',
    plugin_dir_url(__FILE__)
);
```

Example:

```text
http://localhost/demo/wp-content/plugins/dummy-plugin/
```

Used for:

```php
wp_enqueue_style();
wp_enqueue_script();
```

---

# Installation

### Clone Repository

```bash
git clone https://github.com/yourusername/dummy-plugin.git
```

### Install Dependencies

```bash
composer install
```

### Generate Autoloader

```bash
composer dump-autoload
```

### Activate Plugin

```text
WordPress Dashboard
      ↓
Plugins
      ↓
Dummy Plugin
      ↓
Activate
```

---

# Learning Goals

This project demonstrates:

* Namespaces
* Composer Autoloading
* OOP in WordPress
* Service Container Pattern
* WordPress Hooks
* WordPress Admin Pages
* Activation & Deactivation Hooks
* Plugin Uninstall Logic
* File & URL Constants

---

# Future Improvements

* Custom Post Types
* Custom Taxonomies
* Settings API
* AJAX Integration
* REST API Endpoints
* Gutenberg Blocks
* Shortcodes
* Widget Support
* Database Tables
* Admin Settings Pages

---

# Requirements

* PHP 8.0+
* WordPress 6.x+
* Composer 2.x+

---

# License

GPL v2 or later

---

# Author

**Aashish Pathak**

Built as a learning-focused WordPress plugin boilerplate using modern PHP and WordPress development practices.
