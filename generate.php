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

$builder        = new JsonBuilder\JsonBuilder();
$finder         = new Finder();
$fs             = new Filesystem();

$sourcePath = $argv[1];
$targetPath = $argv[2];

$finder->files()->in($sourcePath)
    ->name('*.php');

$start = time();

foreach ($finder as $file) {
    $hintVisitor  = new PhpCodeHints\HintVisitor();
    $parser       = new Parser(new PhpParser\Lexer);
    $traverser    = new NodeTraverser();

    $traverser->addVisitor(new NodeVisitor\NameResolver);
    $traverser->addVisitor($hintVisitor);

    $code = $file->getContents();
    try {
        $stmts = $parser->parse($code);
        $stmts = $traverser->traverse($stmts);
        $jsonContent = "";

        $builder->setJsonEncodeOptions(JSON_PRETTY_PRINT);
        $builder->setValues($hintVisitor->fileStmts);
        $jsonContent = $builder->build();

        if (!$fs->exists($targetPath.$file->getRelativePath())) {
            echo "created directory: ".$targetPath.$file->getRelativePath()."\n";
            $fs->mkdir($targetPath.$file->getRelativePath());
        }
        $outputFilename = $targetPath.$file->getRelativePath()."/".$file->getBasename('.php').'.json';
        file_put_contents($outputFilename, $jsonContent);
        echo "wrote file: ".$outputFilename."\n";

        $builder->reset();
    } catch (PhpParser\Error $e) {
        echo 'Parse Error: ', $e->getMessage();
    }
}
echo "\nGenerated json hint files in: " . (time() - $start) . "secs\n";
