<?php
declare(strict_types=1);

Class StringSwap {
    public string $oldString;
    public string $newString;

    function __construct(String $oldString, String $newString) {
        $this->oldString = $oldString;
        $this->newString = $newString;
    }
    
}
