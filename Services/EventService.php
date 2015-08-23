<?php

namespace BookingForm\Models;


use BookingForm\Tables\EventsTable;

class EventService extends AccessorService {

    function __construct()
    {
        $this->table = new EventsTable();
    }
}