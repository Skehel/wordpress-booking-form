<?php

namespace BookingForm\Database;

class Schema {

    function __construct()
    {
        $this->createEventsTable();
        $this->createBookingsTable();
    }

    function createEventsTable()
    {
        if($this->checkTableExists('bf_events')) {
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

    function createBookingsTable()
    {
        if($this->checkTableExists('bf_bookings')) {
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

    function checkTableExists($tableName)
    {
        global $wpdb;
        return $wpdb->get_var("SHOW TABLES LIKE '$tableName'") != $tableName;
    }
}