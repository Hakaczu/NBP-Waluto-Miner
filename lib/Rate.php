<?php

class Rate{
    public $isoCode;
    public $codeId;
    public $bid;
    public $ask;
    public $source;

    public function __construct(String $isoCode)
    {
        $this->isoCode = $isoCode;
    }
}


?>