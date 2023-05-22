<?php

namespace App\Models;

class Driver extends Model
{
    private array $drivers;

    public function __construct($drivers)
    {
        $this->drivers = $drivers;
    }

    public function getAllDrivers(): array
    {
        return $this->drivers;
    }
}
