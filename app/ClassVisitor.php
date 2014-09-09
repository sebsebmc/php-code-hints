<?php

namespace PhpCodeHints;

use PhpParser\Node;
use PhpParser\Comment;
use PhpParser\NodeVisitor;
use PhpParser\NodeVisitorAbstract;
use PhpCodeHints\ClassHint;

class ClassVisitor extends NodeVisitorAbstract
{
    public $classes = [];

    public $functions = [];

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
            $classHint->stmtType = "Class";
            $classHint->name = $class->name;
            if ($class->extends instanceof Node) {
                $classHint->extends = $class->extends->toString();
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
                    $classHint->addProperty($stmt->props[0]->name, $docComment);
                }
            }

            $this->classes[] = $classHint;
        }
    }

    private function handleFunction(Node\Stmt\Function_ $function)
    {
        $functionHint = new FunctionHint;

        $functionHint->stmtType = "Function";
        $functionHint->name = $function->name;

        $this->functions[] = $functionHint;
    }
}
