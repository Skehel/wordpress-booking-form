<?php

namespace BookingForm\Actions;


use BookingForm\Models\BookingService;

class BookingActions {

    private $service;

    function __construct()
    {
        $this->service = new BookingService();
        add_action( 'init', ['this', 'newBooking'] );
        add_action( 'init', ['this', 'updateBooking'] );
        add_action( 'init', ['this', 'deleteBooking'] );
    }

    function newBooking()
    {
        if(isset($_POST['new_booking']))
        {
            //TODO take payment
            try {
                $this->service->create($_POST);
            } catch (\Exception $e) {
                //TODO
            }
        }
    }

    function updateBooking()
    {
        if(isset($_POST['update_booking']))
        {
            try {
                $this->service->update($_POST['booking_id'], $_POST);
            } catch (\Exception $e) {
                //TODO
            }
        }
    }

    function deleteBooking()
    {
        if(isset($_POST['delete_booking']))
        {
            try {
                $this->service->delete($_POST['booking_id']);
            } catch (\Exception $e) {
                //TODO
            }
        }
    }

    function showAll()
    {
        $records = $this->service->all();

        $table = '<table>';
        $labels = false;
        foreach($records as $record)
        {
            //create column labels
            if(!$labels)
            {
                $table .= '<tr>';
                foreach($record as $column => $value)
                {
                    $table .= "<td>$column</td>";
                }
                $table .= '</tr>';
                $labels = true;
            }

            $table .= '<tr>';
            foreach($record as $column => $value)
            {
                $table .= "<td>$value</td>";
            }
            $table .= '</tr>';
        }
        $table .='</table>';

        return $table;
    }
}