<?php

namespace KebunBinatangVirtual;

trait AsalHewan {
    protected $asal;

    public function setAsal($asal) {
        $this->asal = $asal;
    }

    public function getAsal() {
        return $this->asal;
    }
}

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

$gajah = new Mamalia("Gajah Sumatera", 15, "Herbivora");
$gajah->setAsal("Sumatera, Indonesia");

$elang = new Burung("Elang Jawa", 5, "Coklat keemasan");
$elang->setAsal("Pulau Jawa, Indonesia");

echo $gajah . PHP_EOL;
echo $elang . PHP_EOL;

?>
