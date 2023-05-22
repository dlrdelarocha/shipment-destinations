<?php

namespace App\Models;

class ShipmentDestination extends Model
{
    private array $destinations;

    public function __construct($destinations)
    {
        $this->destinations = $destinations;
    }

    public function getAllDestinations(): array
    {
        return $this->destinations;
    }
}
