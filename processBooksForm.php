<?php
require_once __DIR__ . '/bootstrap.php';

/* Enter New Books Template */
$bookFormTemplate = new \TheSeer\fDOM\fDOMDocument();
$bookFormTemplate->load(__DIR__.'/templates/booksForm.xsl');

/* Form Validation File */
$dataModel = new \TheSeer\fDOM\fDOMDocument();
$dataModel->load(__DIR__.'/prototypes/bookFormValidation.xml');

$renderer = new XslRenderer($bookFormTemplate, new \TheSeer\fXSL\fXSLTProcessor());

/* File & XML Backend */
$filePath = '/var/www/bibliothek.competec.ch/prototypes/books.xml';
$fileBackend = new FileBackend($filePath);
$xmlBackend = new XmlBackend($filePath, $fileBackend);

/* Request Process */
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $request = new GetRequest($_GET);
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $request = new PostRequest($_POST);
}else {
    throw new Exception('Nicht unterstützte Request Methode ' . $_SERVER['REQUEST_METHOD']);
}

/* Form Command Handling */
$booksFormCommand = new BooksFormCommand($xmlBackend, $request, $dataModel);
$booksFormCommand->validateRequest();
if ($booksFormCommand->hasErrors()) {
    $booksFormCommand->repopulateForm();
} else {
    $booksFormCommand->performAction();
}

echo $renderer->render($dataModel);
