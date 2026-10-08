<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Received = 'Received';
    case Preparing = 'Preparing';
    case ReadyForPickup = 'Ready for Pickup';
    case Completed = 'Completed';
}
