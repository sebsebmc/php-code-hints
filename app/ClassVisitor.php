<?php

namespace PhpCodeHints;

use PhpParser\Node;
use PhpParser\NodeVisitor;
use PhpParser\NodeVisitorAbstract;

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
        $stmts = [];
        if (!$class->isAbstract) {
            foreach($class->stmts as $stmt) {
                if ($stmt instanceof Node\Stmt\ClassMethod && $stmt->type == 1) {
                    $stmts['name'] = $stmt->name;
                    $stmts['type'] = $stmt->type;
                    $this->classes[] = $stmts;
                }
                if ($stmt instanceof Node\Stmt\Property && $stmt->type == 1) {
                    $stmts['name'] = $stmt->props[0]->name;
                    $this->classes[] = $stmts;
                }
            }
        }
    }

    private function handleClassMethod(Node\Stmt\ClassMethod $classMethod)
    {
        $this->methods[] = $classMethod;
    }

}
