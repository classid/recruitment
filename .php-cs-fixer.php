<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('bootstrap')
    ->exclude('storage')
    ->exclude('vendor')
    ->notPath('config/routes.php')
    ->notName('*.blade.php');

$config = new PhpCsFixer\Config();

return $config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PhpCsFixer:risky' => true,
    ])
    ->setFinder($finder);
