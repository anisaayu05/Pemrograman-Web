<?php

namespace KebunBinatangVirtual\Models;

use KebunBinatangVirtual\Traits\AsalHewan;

class Burung extends Hewan {
    use AsalHewan;

    private $warnaBulu;

    public function __construct($nama, $umur, $warnaBulu) {
        parent::__construct($nama, $umur);
        $this->warnaBulu = $warnaBulu;
    }

    public function suara() {
        return "Burung ini biasanya berkicau dengan suara 'chirp' atau 'tweet'.";
    }

    public function deskripsi() {
        return "Burung bernama {$this->nama}" . PHP_EOL .
               "Usia: {$this->umur} tahun" . PHP_EOL .
               "Warna Bulu: {$this->warnaBulu}" . PHP_EOL .
               "Asal: {$this->asal}";
    }
}
