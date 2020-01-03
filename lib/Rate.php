<?php

class Rate{
    public $isoCode;
    public $bid;
    public $ask;
    public $source;

    public function __construct($source, $ask, $bid, $isoCode)
    {
        $this->source = $source;
        $this->ask = $ask;
        $this->bid = $bid;
        $this->isoCode = $isoCode;
    }
}


?>