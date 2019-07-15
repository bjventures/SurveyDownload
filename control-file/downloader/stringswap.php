<?php

declare(strict_types=1);

Class StringSwap {

    public $oldString;
    public $newString;

    function __construct(String $oldString, String $newString) {
        $this->oldString = $oldString;
        $this->newString = $newString;
    }

}
