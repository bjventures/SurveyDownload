<?php

declare(strict_types=1);

define("BASE_URL", "https://pielsurvey.org/control-file");
define("CONTROL_FILE_NAME", "sample");

$apiDirectory = realpath(dirname(__FILE__));
include "$apiDirectory/download-controller.php";
$id           = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING) ?? "";
$fileId       = "";
$requestType  = "";

$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
switch ($method) {
    case "POST":
        $fileId        = CONTROL_FILE_NAME;
        $requestType   = "POST";
        break;
    case "GET":
        $urlComponents = getUrlComponents();
        $fileId        = $urlComponents["fileId"];
        $id            = $urlComponents["participantId"];
        $requestType   = strlen($fileId) == 0 ? "INITIAL" : "GET";
        break;
    default:
        exit;
}

function getUrlComponents(): Array {
    $returnArray = ['fileId' => '', 'participantId' => ''];
    $url         = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);
    $cleanUrl    = urldecode(trim(parse_url($url, PHP_URL_PATH), '/'));
    $segments    = explode('/', $cleanUrl);
    if (count($segments) == 3) {
        $returnArray['fileId']        = $segments[1];
        $returnArray['participantId'] = $segments[2];
    }
    if (count($segments) == 2) {
        $returnArray['fileId'] = $segments[1];
    }
    return $returnArray;
}

$downloadController = New DownloadController($id, $apiDirectory, $fileId, $requestType);
$downloadController->download();
