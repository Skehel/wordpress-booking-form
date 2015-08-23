<?php


namespace BookingForm\Models;


class AccessorService {

    protected $table;

    function __construct($table)
    {
        $this->table = $table;
    }

    function create($data)
    {
        //TODO check data
        $this->table->insert($data);
    }

    function get($id)
    {
        return $this->table->get($id);
    }

    function all()
    {
        return $this->table->getAll();
    }

    function update($id, $data)
    {
        //TODO check data
        $this->table->update($id, $data);
    }

    function delete($id)
    {
        $this->table->delete($id);
    }

}