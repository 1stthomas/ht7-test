<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

/** @see: https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/.php-cs-fixer.dist.php */
return (new Config())
    ->setParallelConfig(ParallelConfigFactory::detect())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => false,
        'comment_to_phpdoc' => ['ignored_tags' => ['todo']],
        'concat_space' => ['spacing' => 'one'],
        'declare_strict_types' => true,
        'header_comment' => ['header' => <<<'EOF'
        EOF],
        'function_declaration' => ['closure_fn_spacing' => 'none'],
        'modernize_strpos' => true,
        'multiline_comment_opening_closing' => true,
        'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],
        'no_useless_concat_operator' => true,
        'numeric_literal_separator' => true,
        'phpdoc_line_span' => ['property' => 'single'],
        'phpdoc_to_comment' => ['ignored_tags' => ['var']],
        'single_line_comment_style' => ['comment_types' => ['hash']],
        'yoda_style' => [
            'always_move_variable' => true,
            'equal' => false, 
            'identical' => false, 
            'less_and_greater' => false,
        ],
    ])
    ->setFinder(
        (new Finder())
            ->ignoreDotFiles(true)
            ->ignoreVCSIgnored(true)
            // ->exclude(['vendor'])
            ->in(__DIR__)
    );