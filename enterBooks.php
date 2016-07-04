<?php
declare(strict_types = 1);
require_once __DIR__ . '/bootstrap.php';

$dom = new \TheSeer\fDOM\fDOMDocument();
$dom->formatOutput = true;
$dom->preserveWhiteSpace = false;
$dom->load(__DIR__.'/templates/booksForm.xsl');

$renderer = new XslRenderer($dom, new \TheSeer\fXSL\fXSLTProcessor());

echo $renderer->render($dom);
