<?php

namespace BookingForm\Database;

/**
 * Generic abstract class for interacting with Database in the database
 */
abstract class Table {

    protected $name;
    protected $wdpb;

    /**
     * Constructs class Assigns $wpdb
     */
    function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    /**
     * Gets all records in the table
     * @return Array    2 dimensional array of records or empty
     */
    function getAll()
    {
        $select = "SELECT * FROM $this->name";
        return $this->wpdb->get_results($select, ARRAY_A);
    }

    /**
     * Gets the specified record
     * @param $id
     * @return mixed    Associative array column names as keys or null
     */
    function get($id)
    {
        $select = "SELECT * from $this->name WHERE id=%s";
        return $this->wpdb->get_row(
            $this->wpdb->prepare($select, $id),
            ARRAY_A);
    }


    /**
     * Inserts a new record based on associative array
     * @param $data
     * @return boolean false on failure
     */
    function insert($data)
    {
        return $this->wpdb->insert($this->name, $data);
    }

    /**
     * Updates the record with the specified id the associative array of data
     * @param $id
     * @param $data
     * @return mixed
     */
    function update($id, $data)
    {
        return $this->wpdb->update($this->name, $data, ['id' => $id]);
    }

    /**
     * deletes the record with the specified id
     * @param $id
     * @return boolean false on failure
     */
    function delete($id)
    {
        return $this->wpdb->delete($this->name, ['id' => $id]);
    }
}