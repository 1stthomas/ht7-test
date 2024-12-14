<?php

declare(strict_types=1);

echo getcwd() . PHP_EOL;
$dom = new DOMDocument();
$dom->loadXML(file_get_contents('./phpunit-report.xml'));
echo '-------------------' . PHP_EOL;
echo $dom->saveXML();
echo '-------------------' . PHP_EOL;


$testsuites = $dom->getElementsByTagName('testsuites')->item(0);
/** @var DOMElement $testsuiteTotal */
$testsuiteTotal = $testsuites->firstChild;
// $testsuiteUnit = $testsuiteTotal->firstChild;
// $testsuitesSearched = $testsuiteUnit->childNodes;
echo 'Length: ' . $testsuiteTotal->childNodes->length . PHP_EOL;
echo 'tag name 1: ' . $testsuiteTotal->nodeName . PHP_EOL;
print_r($testsuiteTotal->getAttributeNames());
$testsuiteSearched = $testsuiteTotal->firstChild;
echo 'tag name 2: ' . $testsuiteSearched->nodeName . PHP_EOL;
// $testsuitesSearched = $testsuiteTotal->childNodes;


// $testsuites->replaceChildren($testsuitesSearched);
// $testsuites->replaceChild($testsuiteSearched, $testsuiteTotal);
$dom->save('./phpunit-report.xml');
