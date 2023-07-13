<?php
/*Jesus Dominguez Bueno*/


namespace App\Controllers;
use App\Models\Product;


class ProductController {
    public function read() {
        Product::read();
    }

    public function show($args) {
        Product::show($args["id"]);
    }

    public function create() {
        Product::create();
    }

    public function update($args) {
        Product::update($args["id"]);
    }

    public function delete($args) {
        Product::delete($args["id"]);
    }
}