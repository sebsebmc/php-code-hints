<?php

namespace PhpCodeHints;

use PhpParser\Node;
use PhpParser\NodeVisitor;
use PhpParser\NodeVisitorAbstract;

class ClassVisitor extends NodeVisitorAbstract {

    public $class = "";

    public $classMethods = [];

    public $attributes = [];

    public function beforeTraverse(array $nodes)
    {
        return null;
    }

    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Stmt\Class_) {
            $this->class = $node->name;
        }
        if ($node instanceof Node\Stmt\ClassMethod) {
            $this->classMethods[] = $node->name;
            $this->attrbutes = $node->getAttributes();
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

}
