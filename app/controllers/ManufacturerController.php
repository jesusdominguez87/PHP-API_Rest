<?php
/*Jesus Dominguez Bueno*/


namespace App\Controllers;
use App\Models\Manufacturer;

class ManufacturerController {

    public function read() {
        Manufacturer::read();
    }
}