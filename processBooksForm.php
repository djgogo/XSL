<?php
require_once __DIR__ . '/bootstrap.php';

/* Enter New Books Template */
$dom = new \TheSeer\fDOM\fDOMDocument();
$dom->load(__DIR__.'/templates/booksForm.xsl');

/* Books Catalogue */
$books = new \TheSeer\fDOM\fDOMDocument();
$books->preserveWhiteSpace = false;
$books->formatOutput = true;
$books->load(__DIR__.'/prototypes/books.xml');

/* Form Validation File */
$dataModel = new \TheSeer\fDOM\fDOMDocument();
$dataModel->load(__DIR__.'/prototypes/bookFormValidation.xml');

$renderer = new XslRenderer($dom, new \TheSeer\fXSL\fXSLTProcessor());

/* XML Backend Class */
$filePath = '/var/www/bibliothek.competec.ch/prototypes/books.xml';
$xmlBackend = new XmlBackend($filePath, $books);

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
