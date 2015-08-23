<?php
/*
Plugin Name: Booking Form
Plugin URI: https://github.com/Skehel/TODO
Description: A plugin for creating and managing booking forms for a wordpress site.
Version: 0.0.1
Author: Tim Skehel
Author URI: http://timskehel.com
License: TODO
*/

/**
 * A simple PSR-4 Autoloader
 * Copied from http://www.php-fig.org/psr/psr-4/examples/
 * @param string $class The fully-qualified class name.
 * @return void
 */
spl_autoload_register(function ($class) {
    $prefix = 'BookingForm\\';

    $base_dir = __DIR__.'/';

    //move on to next autoloader if class does not use prefix
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});


register_activation_hook( __FILE__, 'setup' );

function setup()
{
    $schema = new \BookingForm\Database\Schema();
}
