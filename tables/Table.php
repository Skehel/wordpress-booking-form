<?php

/**
 * Generic abstract class for interacting with tables in the database
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
        $select = "SELECT * from $this->name WHERE id= ".$this->getPlaceholder($id);
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
        $insert = "INSERT INTO $this->name (";
        $values = "VALUES (";

        $i = 1;
        foreach($data as $column => $value)
        {
            $insert .= $column;
            $values .= $this->getPlaceholder($value);

            if($i < sizeOf($data))
            {
                $insert .= ', ';
                $values .= ', ';
            }
            $i++;
        }

        $insert .= ') '.$values.')';

        return $this->wpdb->query(
            $this->wpdb->prepare($insert, $data),
            ARRAY_A);
    }

    /**
     * Updates the record with the specified id the associative array of data
     * @param $id
     * @param $data
     * @return mixed
     */
    function update($id, $data)
    {
        $update = "UPDATE $this->name SET ";

        $i = 1;
        foreach ($data as $column => $value)
        {
            $update .= $column.'=';
            $update .= $this->getPlaceholder($value);

            if($i < sizeOf($data))
            {
                $update .= ', ';
            }
            $i++;
        }
        $update .= " WHERE id=".$this->getPlaceholder($id);
        $data['id'] = $id;

        return $this->wpdb->query($this->wpdb->prepare($update, $data));
    }

    /**
     * deletes the record with the specified id
     * @param $id
     * @return mixed
     */
    function delete($id)
    {
        $delete = "DELETE FROM $this->name WHERE id= ".$this->getPlaceholder($id);
        return $this->wpdb->query( $this->wpdb->prepare($delete, $id) );
    }

    /**
     * Checks a values type and returns a sprintf placeholder for $wpdb->prepare()
     * @param $value
     * @return string
     */
    private function getPlaceholder($value)
    {
        $type = gettype($value);

        if($type == 'int' || $type == 'double')
        {
            return '%d';
        }

        return '%s';
    }
}