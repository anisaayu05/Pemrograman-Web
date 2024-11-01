<?php

namespace KebunBinatangVirtual\Controllers;

use KebunBinatangVirtual\Models\Mamalia;
use KebunBinatangVirtual\Models\Burung;

class HewanController {
    public function tampilkanHewan() {
        $gajah = new Mamalia("Gajah Sumatera", 15, "Herbivora");
        $gajah->setAsal("Sumatera, Indonesia");

        $elang = new Burung("Elang Jawa", 5, "Coklat keemasan");
        $elang->setAsal("Pulau Jawa, Indonesia");

        echo $gajah . PHP_EOL;
        echo $elang . PHP_EOL;
    }
}
