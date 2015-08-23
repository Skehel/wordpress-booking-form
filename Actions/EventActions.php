<?php

namespace BookingForm\Actions;


class EventActions {

    private $service;

    function __construct()
    {
        $this->service = new EventService();
        add_action( 'init', ['this', 'newEvent'] );
        add_action( 'init', ['this', 'updateEvent'] );
        add_action( 'init', ['this', 'deleteEvent'] );
    }

    function newEvent()
    {
        if(isset($_POST['new_event']))
        {
            try {
                $this->service->create($_POST);
            } catch (\Exception $e) {
                //TODO
            }
        }
    }

    function updateEvent()
    {
        if(isset($_POST['update_event']))
        {
            try {
                $this->service->update($_POST['event_id'], $_POST);
            } catch (\Exception $e) {
                //TODO
            }
        }
    }

    function deleteEvent()
    {
        if(isset($_POST['delete_event']))
        {
            try {
                $this->service->delete($_POST['event_id']);
            } catch (\Exception $e) {
                //TODO
            }
        }
    }
    
}