<?php

declare(strict_types=1);

echo getcwd() . PHP_EOL;
$dom = new DOMDocument();
$dom->loadXML(file_get_contents('./phpunit-report.xml'));

$testsuites = $dom->getElementsByTagName('testsuites')->item(0);
$testsuiteTotal = $testsuites->firstChild;
$testsuiteUnit = $testsuiteTotal->firstChild;
$testsuitesSearched = $testsuiteUnit->childNodes;

$testsuites->replaceChildren($testsuitesSearched);
$dom->save('./phpunit-report.xml');
