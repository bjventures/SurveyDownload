<?php

declare(strict_types=1);

Class DownloadView {

    private $pageInsert;
    private $downloadSuccessful;
    private $requestType;

    public function __construct(String $page, Bool $downloadSuccessful, String $requestType) {
        $this->pageInsert         = $page;
        $this->downloadSuccessful = $downloadSuccessful;
        $this->requestType        = $requestType;
    }

    public function render(String $template = null) {
        $downloadSuccessful = $this->downloadSuccessful;
        $pageInsert         = $this->pageInsert;
        $requestType        = $this->requestType;
        ob_start();
        if (!is_null($template)) {
            include($template);
        }
        else {
            include($this->pageInsert);
        }
        echo ob_get_clean();
        exit;
    }

}
