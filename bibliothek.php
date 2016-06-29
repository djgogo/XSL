<?php
declare(strict_types = 1);
require_once __DIR__ . '/bootstrap.php';

$dom = new \TheSeer\fDOM\fDOMDocument();
$dom->formatOutput = true;
$dom->preserveWhiteSpace = false;
$dom->load(__DIR__.'/templates/bibliothek.xsl');

$renderer = new XslRenderer($dom, new \TheSeer\fXSL\fXSLTProcessor());

$dataModel = new \TheSeer\fDOM\fDOMDocument();
$dataModel->load('prototypes/books.xml');

if(!isset($_GET['order'])) {
    $sortOrder = 'ascending';
} else {
    $sortOrder = $_GET['order'];
}

if (isset($_GET['search']))  {
    $renderer->setParameter('', 'search', $_GET['search']);
}

if (isset($_GET['sort']))  {

    if ($sortOrder === 'ascending') {
        $sortOrder = 'descending';
    } else {
        $sortOrder = 'ascending';
    }

    $renderer->setParameter('', 'sortBy', $_GET['sort']);
    $renderer->setParameter('', 'order', $sortOrder);
}

if (isset($_GET['type']))  {
    $renderer->setParameter('', 'type', $_GET['type']);
}

echo $renderer->render($dataModel);
