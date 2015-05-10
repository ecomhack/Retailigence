<?php

namespace eLocal\Sensors;


abstract class SensorBase {
    private $_latitude = null;
    private $_longitude = null;


    protected function __construct($long, $lat) {
        $this->_latitude  = $lat;
        $this->_longitude = $long;
    }


    public function getLatitude() {
        return $this->_latitude;
    }

    public function getLongitude() {
        return $this->_longitude;
    }
}
