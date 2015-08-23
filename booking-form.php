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

require(__DIR__.'/Autoloader.php');
register_activation_hook( __FILE__, 'setup' );

function setup()
{
    $schema = new \BookingForm\Database\Schema();
}
