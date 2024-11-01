<?php

namespace KebunBinatangVirtual\Models;

abstract class Hewan {
    protected $nama;
    protected $umur;

    public function __construct($nama, $umur) {
        $this->nama = $nama;
        $this->umur = $umur;
    }

    abstract public function suara();
    abstract public function deskripsi();

    public function __toString() {
        return str_repeat("=", 40) . PHP_EOL .
               $this->deskripsi() . PHP_EOL .
               "Suara: " . $this->suara() . PHP_EOL .
               str_repeat("=", 40) . PHP_EOL;
    }
}
