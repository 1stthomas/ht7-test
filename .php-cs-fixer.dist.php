<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

/** @see: https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/.php-cs-fixer.dist.php */
return (new Config())
    ->setParallelConfig(ParallelConfigFactory::detect()) // @TODO 4.0 no need to call this manually
    ->setRiskyAllowed(true)
    ->setRules([
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => true,
        'header_comment' => ['header' => <<<'EOF'
            (c) PPCmetrics
            EOF],
        'modernize_strpos' => true, // needs PHP 8+ or polyfill
        'no_useless_concat_operator' => true,
        'numeric_literal_separator' => true,
    ])
    ->setFinder(
        (new Finder())
            ->ignoreDotFiles(true)
            ->ignoreVCSIgnored(true)
            ->exclude(['vendor'])
            ->in(__DIR__)
            ->append([__DIR__.'/php-cs-fixer'])
    )
;