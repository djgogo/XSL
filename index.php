<?php
declare(strict_types = 1);
require_once __DIR__ . '/bootstrap.php';

$dom = new \TheSeer\fDOM\fDOMDocument();
$dom->load(__DIR__.'/templates/bibliothek.xsl');

$renderer = new XslRenderer($dom, new \TheSeer\fXSL\fXSLTProcessor());

$dataModel = new \TheSeer\fDOM\fDOMDocument();
$dataModel->load('prototypes/books.xml');
//
//if ($sortOrder === '' || $sortOrder === 'descending') {
//    $sortOrder = 'ascending';
//}else {
//    $sortOrder = 'descending';
//}

if (isset($_GET['sort']))  {
    $renderer->setParameter('', 'sortBy', $_GET['sort']);
    $renderer->setParameter('', 'order', 'ascending');
}

if (isset($_get['type']))  {
    $renderer->setParameter('', 'type', $_GET['type']);
}

echo $renderer->render($dataModel);
