<?php

require_once __DIR__ . "/../vendor/autoload.php";

$code = file_get_contents($argv[1]);

$parser     = new PhpParser\Parser(new PhpParser\Lexer);
$traverser  = new PhpParser\NodeTraverser;
$dumper     = new PhpParser\NodeDumper;

try {
    $stmts = $parser->parse($code);
    $stmts = $dumper->dump($stmts);
} catch (PhpParser\Error $e) {
    echo 'Parse Error: ', $e->getMessage();
}

print_r($stmts);
