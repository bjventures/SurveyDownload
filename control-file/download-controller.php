<?php

class DownloadController {

    private $downloadFile;
    private $apiDirectory;
    private $id;
    private $requestType;
    private $authorisedFileId = CONTROL_FILE_NAME;

    public function __construct(String $id, String $apiDirectory, String $downloadFile, String $requestType) {
        $this->downloadFile = $downloadFile;
        $this->apiDirectory = $apiDirectory;
        $this->id           = $id;
        $this->requestType  = $requestType;
    }

    public function download() {
        include "$this->apiDirectory/views/downloadview.php";
        include "$this->apiDirectory/downloader/stringswap.php";
        $downloadSuccessful = false;
        if (strlen($this->id) > 0) {
            $stringSwaps[]      = New StringSwap("{participant id}", $this->id);
            $downloadSuccessful = $this->downloadFile($stringSwaps, $this->downloadFile, $this->apiDirectory);
        }
        $downloadView = New DownloadView("views/page-insert.php", $downloadSuccessful, $this->requestType);
        $downloadView->render("views/page-template.php");
    }

    private function downloadFile(Array $stringSwaps, String $fileId, String $apiDir): Bool {
        if ($fileId <> $this->authorisedFileId) {
            return false;
        }
        $filePath      = "$apiDir/control-files/$fileId.survey";
        include "$apiDir/downloader/forcedownload.php";
        $forceDownload = new ForceDownload($filePath, $stringSwaps);
        try {
            $forceDownload->downloadFile();
            return true;
        }
        catch (Exception $e) {
            return false;
        }
    }

}
