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

register_activation_hook( __FILE__, 'setup' );

function setup()
{
    create_events_table();
    create_bookings_table();
}

function create_events_table()
{
    if(check_table_exists('bf_events')) {
        $create = "CREATE TABLE `bf_events` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `time` datetime NOT NULL,
        `name` varchar(25) DEFAULT NULL,
        `location` varchar(100) DEFAULT NULL,
        `price` decimal(10,0) DEFAULT NULL,
        `capacity` int(11) DEFAULT NULL,
        PRIMARY KEY (`id`)
        )";
        global $wpdb;
        $wpdb->query($create);
    }
    //TODO if not check schema matches, then continue, throw error or ask for different prefix

}

function create_bookings_table()
{
    if(check_table_exists('bf_bookings')) {
        $create = "CREATE TABLE `bf_bookings` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `event_id` int(11) DEFAULT NULL,
        `name` varchar(50) DEFAULT NULL,
        `phone` varchar(15) DEFAULT NULL,
        `email` varchar(50) DEFAULT NULL,
        `people` int(11) DEFAULT NULL,
        `date_booked` datetime DEFAULT NULL,
        PRIMARY KEY (`id`)
        )";
        global $wpdb;
        $wpdb->query($create);
    }
    //TODO if not check schema matches, then continue, throw error or ask for different prefix
}

function check_table_exists($table_name)
{
    global $wpdb;
    return $wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name;
}