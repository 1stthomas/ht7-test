<?php

declare(strict_types=1);

echo getcwd() . PHP_EOL;
$dom = new DOMDocument();
$dom->loadXML(file_get_contents('./phpunit-report.xml'));
echo '-------------------' . PHP_EOL;
echo $dom->saveXML();
echo '-------------------' . PHP_EOL;


$testsuites = $dom->getElementsByTagName('testsuites')->item(0);
$testsuiteTotal = $testsuites->firstChild;
// $testsuiteUnit = $testsuiteTotal->firstChild;
// $testsuitesSearched = $testsuiteUnit->childNodes;
echo 'Length: ' . $testsuiteTotal->childNodes->length . PHP_EOL;
$testsuiteSearched = $testsuiteTotal->firstChild;
echo 'tag name: ' . $testsuiteSearched->nodeName . PHP_EOL;
// $testsuitesSearched = $testsuiteTotal->childNodes;


// $testsuites->replaceChildren($testsuitesSearched);
// $testsuites->replaceChild($testsuiteSearched, $testsuiteTotal);
$dom->save('./phpunit-report.xml');
