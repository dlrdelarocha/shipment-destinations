<?php

namespace App\Controllers;

use App\Models\Driver;
use App\Models\ShipmentDestination;

class AssignShipmentDestination
{
    public function __construct(private ShipmentDestination $destinations, private Driver $drivers)
    {
    }

    public function run(): array
    {
        return $this->assignDestinationsToDrivers();
    }

    private function assignDestinationsToDrivers(): array
    {
        $assignments = [];
        $totalSS = 0;
        foreach ($this->destinations->getAllDestinations() as $destination) {
            $bestDriver = null;
            $bestSS = 0;

            foreach ($this->drivers->getAllDrivers() as $driver) {
                if (in_array($driver, array_column($assignments, 'driver_name'))) {
                    continue;
                }

                $ss = $this->calculateSuitabilityScore($destination, $driver);
                if ($ss > $bestSS) {
                    $bestDriver = $driver;
                    $bestSS = $ss;
                }
            }

            /** @todo Create a Response or Assignment class to give a better format to the code's response.  */
            if ($bestDriver !== null) {
                $assignments[$destination]['driver_name'] = $bestDriver;
                $assignments[$destination]['shipment_destination'] = $destination;
                $assignments[$destination]['suitability_score'] = $bestSS;
                $totalSS += $bestSS;
            }
        }

        //ordered by ss_score
        uasort($assignments, function ($a, $b) {
            return $b['suitability_score'] <=> $a['suitability_score'];
        });

        return ['total_suitability_score' => $totalSS, 'assignments' => $assignments];
    }

    private function calculateSuitabilityScore($destination, $driver): float|int
    {
        $destinationLength = strlen($destination);
        $driverLength = strlen($driver);

        $baseSS = $destinationLength % 2 === 0
            ? $this->countVowels($driver) * 1.5
            : $this->countConsonants($driver);

        if ($this->hasCommonFactors($destinationLength, $driverLength)) {
            $baseSS *= 1.5;
        }

        return $baseSS;
    }

    private function countVowels($name): int
    {
        $vowels = ['a', 'e', 'i', 'o', 'u'];
        $name = strtolower($name);
        $count = 0;

        foreach ($vowels as $vowel) {
            $count += substr_count($name, $vowel);
        }

        return $count;
    }

    private function countConsonants($name): int
    {
        $consonants = ['b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q'
            , 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'];

        $name = strtolower($name);
        $count = 0;

        foreach ($consonants as $consonant) {
            $count += substr_count($name, $consonant);
        }

        return $count;
    }

    private function hasCommonFactors($a, $b): bool
    {
        $factorsA = $this->getFactors($a);
        $factorsB = $this->getFactors($b);

        return !empty(array_intersect($factorsA, $factorsB)) ?? true;
    }

    private function getFactors($number): array
    {
        $factors = [];
        //by default, we assume the number One is a common factor
        for ($i = 2; $i <= $number / 2; $i++) {
            if ($number % $i === 0) {
                $factors[] = $i;
            }
        }

        return $factors;
    }
}
