<?php

namespace AppBundle\Service;

use AppBundle\Entity\Flight;

class FlightInfo
{
    private $unit;

    public function __construct($unit)
    {
        $this->unit = $unit;
    }

    public function getDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
    {
        $d = 0;
        $earth_radius = 6371;
        $dLat = deg2rad($latitudeTo - $latitudeFrom);
        $dLon = deg2rad($longitudeTo - $longitudeFrom);

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * asin(sqrt($a));

        switch ($this->unit) {
            case 'km':
                $d = $c * $earth_radius;
                break;
            case 'mi':
                $d = $c * $earth_radius / 1.609344;
                break;
            case 'nmi':
                $d = $c * $earth_radius / 1.852;
                break;
        }

        return $d;
    }

    public function getTime(Flight $flight)
    {
        $distance = $this->getDistance(
            $flight->getDeparture()->getLatitude(),
            $flight->getDeparture()->getLongitude(),
            $flight->getArrival()->getLatitude(),
            $flight->getArrival()->getLongitude()
        );

        $speed = $flight->getPlane()->getCruiseSpeed();
        $travelTime = $distance / $speed * 60;
        return $travelTime;

    }
}