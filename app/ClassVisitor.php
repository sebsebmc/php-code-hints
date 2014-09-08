<?php

namespace PhpCodeHints;

use PhpParser\Node;
use PhpParser\Comment;
use PhpParser\NodeVisitor;
use PhpParser\NodeVisitorAbstract;
use PhpCodeHints\ClassHint;

class ClassVisitor extends NodeVisitorAbstract {

    public $nodeStrings = [];

    public $classes = [];

    public $methods = [];

    public function beforeTraverse(array $nodes)
    {
        return null;
    }

    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Stmt\Class_) {
            $this->handleClass($node);
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

    private function handleClassMethod(Node\Stmt\ClassMethod $classMethod)
    {
        $this->methods[] = $classMethod;
    }

}
