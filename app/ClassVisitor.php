<?php

namespace PhpCodeHints;

use PhpParser\Node;
use PhpParser\NodeVisitor;
use PhpParser\NodeVisitorAbstract;

class ClassVisitor extends NodeVisitorAbstract {

    public $nodeStrings = [];

    public function beforeTraverse(array $nodes)
    {
        return null;
    }

    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Stmt\Class_) {
            $this->handleClass($node);
        }
        if ($node instanceof Node\Stmt\ClassMethod) {
            $this->handleClassMethod($node);
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

    public function handleClass(Node\Stmt\Class_ $class)
    {
        $theString = "";
        if ($class->isAbstract) {
            $theString = "abstract ";
        } elseif ($class->isStatic) {
            $theString = "static ";
        } elseif ($class->isFinal) {
            $theString = "final ";
        }
        $this->nodeStrings[] = $theString."class ".$class->name. "{ }";
    }

    public function handleClassMethod(Node\Stmt\ClassMethod $classMethod)
    {
        $this->nodeStrings[] = $classMethod->name."()";
    }

}
