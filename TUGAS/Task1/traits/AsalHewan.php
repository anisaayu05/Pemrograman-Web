<?php

namespace KebunBinatangVirtual\Traits;

trait AsalHewan {
    protected $asal;

    public function setAsal($asal) {
        $this->asal = $asal;
    }

    public function getAsal() {
        return $this->asal;
    }
}
