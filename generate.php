<?php

require_once __DIR__ . "/vendor/autoload.php";

use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use PhpParser\Parser;
use PhpParser\NodeTraverser;
use PhpParser\Lexer;
use PhpParser\NodeVisitor;
use Ivory\JsonBuilder;

$builder = new JsonBuilder\JsonBuilder();
$finder       = new Finder();
$fs = new Filesystem();

$finder->files()->in($argv[1])
    ->name('*.php');
$start = time();
foreach ($finder as $file) {
    $hintVisitor = new PhpCodeHints\HintVisitor();
    $parser       = new Parser(new PhpParser\Lexer);
    $traverser    = new NodeTraverser();

    $traverser->addVisitor(new NodeVisitor\NameResolver);
    $traverser->addVisitor($hintVisitor);
    $fileOut = $file->getRealPath();
    $code = file_get_contents($fileOut);
    echo $file->getRelativePath()."\n";
    try {
        $stmts = $parser->parse($code);
        $stmts = $traverser->traverse($stmts);
        $jsonContent = "";

        $builder->setJsonEncodeOptions(JSON_PRETTY_PRINT);
        $builder->setValues($hintVisitor->fileStmts);

        $jsonContent = $builder->build();
        if (!$fs->exists($argv[2].$file->getRelativePath())) {
            //echo "mkdir".$argv[2].$file->getRelativePath();
            $fs->mkdir($argv[2].$file->getRelativePath());
        }
        $outpath = $argv[2].$file->getRelativePath().$file->getBasename('.php').'.json';
        //echo "outpath: ".$outpath;
        file_put_contents($argv[2].$file->getRelativePath().$file->getBasename('.php').'.json', $jsonContent);

        $builder->reset();
    } catch (PhpParser\Error $e) {
        echo 'Parse Error: ', $e->getMessage();
    }
}
echo "\nGenerated json hint files in: " . (time() - $start) . "secs\n";
