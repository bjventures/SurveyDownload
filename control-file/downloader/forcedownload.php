<?php

declare(strict_types=1);

Class ForceDownload {

    protected $downloadFile;
    protected $stringSwaps;

    function __construct(String $fileName, Array $stringSwaps) {
        $this->downloadFile = $fileName;
        $this->stringSwaps  = $stringSwaps;
    }

    public function downloadFile() {
        if (!file_exists($this->downloadFile) || !is_file($this->downloadFile)) {
            throw new Exception;
        }
        if (count($this->stringSwaps) == 0) {
            $this->sendHeaders(filesize($this->downloadFile));
            readfile($this->downloadFile);
        }
        else {
            $file = file_get_contents($this->downloadFile);
            if ($file === false) {
                throw new Exception;
            }
            foreach ($this->stringSwaps as $stringSwap) {
                $newfile = str_replace($stringSwap->oldString, $stringSwap->newString, $file);
            }
            $this->sendHeaders(strlen($newfile));
            echo $newfile;
        }
        exit;
    }

    private function sendHeaders(Int $size) {
        header('Content-Type: application/piel-survey; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . basename($this->downloadFile));
        header('Expires: 0');
        header('Cache-Control: no-cache, must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . $size);
    }

}
