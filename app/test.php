<?php

require_once __DIR__ . "/../vendor/autoload.php";

$code = file_get_contents($argv[1]);

$parser     = new PhpParser\Parser(new PhpParser\Lexer);
$traverser  = new PhpParser\NodeTraverser;

$classVisitor = new PhpCodeHints\ClassVisitor;

$traverser->addVisitor($classVisitor);

try {
    $stmts = $parser->parse($code);
    $stmts = $traverser->traverse($stmts);
    foreach($classVisitor->nodeStrings as $nodeString) {
        echo $nodeString."\n";
    }
} catch (PhpParser\Error $e) {
    echo 'Parse Error: ', $e->getMessage();
}