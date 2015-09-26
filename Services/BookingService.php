<?php

namespace BookingForm\Models;


use BookingForm\Database\BookingsTable;

class BookingService extends AccessorService {

    function __construct()
    {
        $this->table = new BookingsTable();
    }

}