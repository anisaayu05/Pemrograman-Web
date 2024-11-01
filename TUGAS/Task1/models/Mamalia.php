<?php

namespace KebunBinatangVirtual\Models;

use KebunBinatangVirtual\Traits\AsalHewan;

class Mamalia extends Hewan {
    use AsalHewan;

    private $jenisMakanan;

    public function __construct($nama, $umur, $jenisMakanan) {
        parent::__construct($nama, $umur);
        $this->jenisMakanan = $jenisMakanan;
    }

    public function suara() {
        return "Mamalia ini biasanya mengeluarkan suara 'growl' atau 'grunt'.";
    }

    public function deskripsi() {
        return "Mamalia bernama {$this->nama}" . PHP_EOL .
               "Usia: {$this->umur} tahun" . PHP_EOL .
               "Jenis Makanan: {$this->jenisMakanan}" . PHP_EOL .
               "Asal: {$this->asal}";
    }
}
