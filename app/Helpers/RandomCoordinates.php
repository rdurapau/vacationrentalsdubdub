<?php

namespace App\Helpers;

class RandomCoordinates {

    function getPoint()
    {
        $lat = 30.4205 + (rand(0, 1000)/1000);
        $lng = -abs(97.9103 + (rand(0, 1000)/1000));
        return [$lat, $lng];
    }
    
    function getPointOLD()
    {
        $key = array_rand($this->points);
        return $this->points[$key];
    }
}
