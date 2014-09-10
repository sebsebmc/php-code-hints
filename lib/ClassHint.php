<?php

namespace PhpCodeHints;

use PhpCodeHints\StmtHintAbstract;

class ClassHint extends StmtHintAbstract
{
    //private $name = "";

    //private $stmtType = "";

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

    public function getExtends()
    {
        return $this->extends;
    }

    public function setExtends($extends)
    {
        $this->extends = $extends;
        return $this;
    }

    public function addMethod($name, $type, $params, $docComment)
    {
        $this->methods[] = ['name'=>$name, 'type'=>$type, 'params'=>$params, 'doc'=>$docComment];
        return $this;
    }

    public function addProperty(array $props, $docComment)
    {
        foreach ($props as $prop) {
            $this->properties[] = ['name'=>$prop->name, 'doc'=>$docComment];
        }
        return $this;
    }

    public function addConstant(array $consts, $docComment)
    {
        foreach ($consts as $const) {
            $this->constants[] = ['name'=>$const->name, 'value'=>$const->value->value, 'doc'=>$docComment];
        }
        return $this;
    }

    public function getMethods()
    {
        return $this->methods;
    }

    public function getProperties()
    {
        return $this->properties;
    }

    public function getConstants()
    {
        return $this->constants;
    }
}
