<?php

namespace BookingForm\Models;


use BookingForm\Tables\BookingsTable;

class BookingService extends AccessorService {

    function __construct()
    {
        $this->table = new BookingsTable();
    }

}