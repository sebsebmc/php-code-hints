<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Symfony\Component\Finder\Finder;
use PhpParser\Parser;
use PhpParser\NodeTraverser;
use PhpParser\Lexer;
use PhpParser\NodeVisitor;
use Ivory\JsonBuilder;

$builder = new JsonBuilder\JsonBuilder();
$finder       = new Finder();

$finder->files()->in($argv[1])
    ->name('*.php');
$start = time();
foreach ($finder as $file) {
    $hintVisitor = new PhpCodeHints\HintVisitor();
    $parser       = new Parser(new PhpParser\Lexer\Emulative);
    $traverser    = new NodeTraverser();

    $traverser->addVisitor(new NodeVisitor\NameResolver);
    $traverser->addVisitor($hintVisitor);
    $fileOut = $file->getRealPath();
    $code = file_get_contents($fileOut);
    //echo $file->getRealPath()."\n";
    try {
        $stmts = $parser->parse($code);
        $stmts = $traverser->traverse($stmts);
        $jsonContent = "";
//        foreach ($hintVisitor->classes as $class) {
//            $jsonContent .= json_encode($class, JSON_PRETTY_PRINT) . ",";
//        }

        $builder->setJsonEncodeOptions(JSON_PRETTY_PRINT);
        $builder->setValues($hintVisitor->fileStmts);
        //$builder->setValues($hintVisitor->functions);
        $jsonContent = $builder->build();
        if ($jsonContent) {
            file_put_contents($argv[2].$file->getBasename('.php').'.json', $jsonContent);
        }
        $builder->reset();
    } catch (PhpParser\Error $e) {
        echo 'Parse Error: ', $e->getMessage();
    }
}
echo (time() - $start);
