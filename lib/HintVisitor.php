<?php

namespace PhpCodeHints;

use PhpParser\Node;
use PhpParser\Comment;
use PhpParser\NodeVisitor;
use PhpParser\NodeVisitorAbstract;
use PhpCodeHints\ClassHint;

class HintVisitor extends NodeVisitorAbstract
{
    public $fileStmts = [];

    public function beforeTraverse(array $nodes)
    {
        return null;
    }

    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Stmt\Class_) {
            $this->handleClass($node);
        } elseif ($node instanceof Node\Stmt\Function_) {
            $this->handleFunction($node);
        }
        return null;
    }

    public function leaveNode(Node $node)
    {
        return null;
    }

    public function afterTraverse(array $nodes)
    {
        return null;
    }

    private function handleClass(Node\Stmt\Class_ $class)
    {
        $classHint = new ClassHint;

        if (!$class->isAbstract()) {
            $classHint->setStmtType("Class");
            $classHint->setName($class->name);
            if ($class->extends instanceof Node) {
                $classHint->setExtends($class->extends->toString());
            }

            foreach ($class->stmts as $stmt) {
                $paramNames = [];
                $docComment = null;
                if ($stmt instanceof Node\Stmt\ClassMethod && $stmt->isPublic()) {
                    foreach ($stmt->params as $param) {
                        $paramNames[] = $param->name;
                    }
                    $docComment = $stmt->getDocComment();
                    if ($docComment !== null) {
                        $docComment = $docComment->getReformattedText();
                    }
                    $classHint->addMethod($stmt->name, $stmt->type, $paramNames, $docComment);
                }
                if ($stmt instanceof Node\Stmt\Property && $stmt->isPublic()) {
                    $docComment = $stmt->getDocComment();
                    if ($docComment !== null) {
                        $docComment = $docComment->getReformattedText();
                    }
                    $classHint->addProperty($stmt->props, $docComment);
                }
                if ($stmt instanceof Node\Stmt\ClassConst) {
                    $docComment = $stmt->getDocComment();
                    if ($docComment !== null) {
                        $docComment = $docComment->getReformattedText();
                    }
                    $classHint->addConstant($stmt->consts, $docComment);
                }
            }

            $this->fileStmts[] = ['stmtType'=>$classHint->getStmtType(), 'name'=>$classHint->getName(),
                                  'extends'=>$classHint->getExtends(),
                                  'methods'=>$classHint->getMethods(), 'properties'=>$classHint->getProperties(),
                                  'constants'=>$classHint->getConstants()];
        }
    }

    private function handleFunction(Node\Stmt\Function_ $function)
    {
        $functionHint = new FunctionHint;

        $functionHint->stmtType = "Function";
        $functionHint->name = $function->name;

        $this->fileStmts[] = $functionHint;
    }
}
