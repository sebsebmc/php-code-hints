<?php

namespace PhpCodeHints;

use PhpCodeHints\StmtHintAbstract;
use PhpParser\Node\Params;

class FunctionHint extends StmtHintAbstract
{
    private $extends = "";

    private $methods = [];

    private $properties = [];

    private $constants = [];

    private $params = [];

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

    public function getParams()
    {
        return $this->params;
    }

    public function setParams(array $params)
    {
        foreach ($params as $param) {
            $paramName = $param->name;
            if ($param->type instanceof PhpParser\Node\Name) {
                $paramType = $param->type->toString();
            } else {
                $paramType = $param->type;
            }
            $this->params[] = ['name'=>$paramName, 'type'=>$paramType];
        }
    }
}
