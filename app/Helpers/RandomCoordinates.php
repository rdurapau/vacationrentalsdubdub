<?php

namespace App\Helpers;

class RandomCoordinates {

    function getPoint()
    {
        $lat = rand(-118000000,-80000000)/1000000;
        $lng = rand(32000000,48000000)/1000000;
        return [$lng,$lat];
    }
    
    function getPointOLD()
    {
        $key = array_rand($this->points);
        return $this->points[$key];
    }
}
