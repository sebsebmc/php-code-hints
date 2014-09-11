<?php

namespace PhpCodeHints;

use PhpCodeHints\StmtHintAbstract;

class NamespaceHint extends StmtHintAbstract
{
    private $extends = "";

    private $methods = [];

    private $properties = [];

    private $constants = [];

    public function getStmtType()
    {
        return $this->stmtType;
    }

    public function setStmtType($stmtType)
    {
        $this->stmtType = $stmtType;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
