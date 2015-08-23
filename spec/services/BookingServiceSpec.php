<?php

namespace services\BookingForm\Services;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BookingServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('BookingForm\Services\BookingService');
    }
}
