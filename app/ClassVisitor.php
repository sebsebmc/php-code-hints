<?php

namespace PhpCodeHints;

use PhpParser\Node;
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
            $classHint->extends = $class->extends;
            foreach ($class->stmts as $stmt) {
                $paramNames = [];
                if ($stmt instanceof Node\Stmt\ClassMethod && $stmt->isPublic()) {
                    foreach ($stmt->params as $param) {
                        $paramNames[] = $param->name;
                    }
                    $classHint->addMethod($stmt->name, $stmt->type, $paramNames);
                }
                if ($stmt instanceof Node\Stmt\Property && $stmt->isPublic()) {
                    $classHint->addProperty($stmt->props[0]->name);
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
