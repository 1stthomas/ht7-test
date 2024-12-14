<?php

declare(strict_types=1);

echo getcwd() . PHP_EOL;
$dom = new DOMDocument();
$dom->loadXML(file_get_contents('./phpunit-report.xml'));

// echo '-------------------' . PHP_EOL;
// echo $dom->saveXML();
// echo '-------------------' . PHP_EOL;

echo "Length testsuites: " . $dom->getElementsByTagName('testsuites')->length . PHP_EOL;
$testsuites = $dom->getElementsByTagName('testsuites')->item(0);

// Find <testsuite name="Unit"/>
// $testsuite = $dom->getElementsByTagName('testsuite')->item(0);
// echo 'name: ' . $testsuite->getAttribute('name') . PHP_EOL;
$testsuite_root = array_reduce(iterator_to_array($dom->getElementsByTagName('testsuite')), function ($carry, \DOMElement $item) use ($testsuites): ?\DOMElement {
    if ($item->parentNode === $testsuites) {
        $carry = $item;
    }
    return $carry;
});
$testcases = $testsuite_root->getElementsByTagName('testcase');
// $testsuites_unit = array_reduce(iterator_to_array($dom->getElementsByTagName('testsuite')), function (array $carry, \DOMElement $item): ?\DOMElement {
//     if ($item->getAttribute('name') === 'Unit') {
//         $carry = $item;
//     }

//     return $carry;
// }, []);
$testsuites->removeChild($testsuite_root);
$testsuite_root_new = new DOMElement('testsuite');
$testsuites->appendChild($testsuite_root_new);
echo "Length testcases: " . count(iterator_to_array($testcases)) . PHP_EOL;
$testsuite_root_new->append(...iterator_to_array($testcases));

// echo "Length testsuite_root: " . $testsuite_root->childNodes->length . PHP_EOL;
echo "Length testcases as child: " . $testsuite_root_new->childNodes->length . PHP_EOL;
// $testsuites->removeChild($testsuite_root);

// array_walk(iterator_to_array($testcases), function (\DOMElement $testcase) use ($testsuites): void {
//     echo 'tag name: ' . $testcase->nodeName . PHP_EOL;
//     $testsuites->appendChild($testcase);
// });

// foreach ($testsuite_unit->childNodes as $child) {
//     echo 'tag name: ' . $child->nodeName . PHP_EOL;
//     $testsuites->appendChild($child);
// }


// /** @var DOMElement $testsuiteTotal */
// $testsuiteTotal = $testsuites->firstChild;
// // $testsuiteUnit = $testsuiteTotal->firstChild;
// // $testsuitesSearched = $testsuiteUnit->childNodes;
// echo 'Length 0: ' . $testsuites->childNodes->length . PHP_EOL;
// echo 'Length: ' . $testsuiteTotal->childNodes->length . PHP_EOL;
// echo 'tag name 1: ' . $testsuiteTotal->nodeName . PHP_EOL;
// print_r($testsuiteTotal->getAttributeNames());
// $testsuiteSearched = $testsuiteTotal->firstChild;
// echo 'tag name 2: ' . $testsuiteSearched->nodeName . PHP_EOL;
// // $testsuitesSearched = $testsuiteTotal->childNodes;


// $testsuites->replaceChildren($testsuitesSearched);
// $testsuites->replaceChild($testsuiteSearched, $testsuiteTotal);
echo '================' . PHP_EOL;
$dom->save('./phpunit-report.xml');
