<?php

namespace PhpCodeHints;

use PhpCodeHints\StmtHintAbstract;

class ConstantHint extends StmtHintAbstract
{
    private $value;

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

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}
