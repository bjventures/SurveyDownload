<?php

$baseUrl = BASE_URL;

$download = <<<EOT
        <h3>Survey Download Form</h3>
    <Form class="form-id" Method ="POST" Action = "{$baseUrl}/" novalidate>
        <p>Please enter your participant id</p>
        <input type="text" name="id" placeholder="Participant Id">
        <input type="submit" />
    </form>

EOT;

$error = <<<EOT
        <p class="error">The file could not be downloaded. Please contact the researcher.</p>
EOT;

include 'page-insert-background.php';
switch ($requestType) {
    case "INITIAL":
        echo $download;
        break;
    case "POST":
        echo $downloadSuccessful ? $download : $download . $error;
        break;
    case "GET":
        echo $downloadSuccessful ? "" : $error;
        break;
    default:
        break;
}
