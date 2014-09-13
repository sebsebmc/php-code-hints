<?php

namespace PhpCodeHints;

use PhpCodeHints\StmtHintAbstract;
use \PhpParser\Node\Params;
use \PhpParser\Node\Name;

class ClassHint extends StmtHintAbstract
{
    private $extends = "";

    private $methods = [];

    private $properties = [];

    private $constants = [];

    private $classType = 0;

    private $fqn = "";

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

    public function getFqn()
    {
        return $this->fqn;
    }

    public function setFqn($fqn)
    {
        $this->fqn = $fqn;
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

    public function addMethod($name, $type, $byRef, $params, $docComment)
    {
        $paramList = [];
        $paramType = "";
        foreach ($params as $param) {
            $paramName = $param->name;
            if ($param->type instanceof \PhpParser\Node\Name) {
                $paramType = $param->type->toString();
            } else {
                $paramType = $param->type;
            }

            if ($param->default != NULL) {
                $default = $param->default->value;
            } else {
                $default = "";
            }
            $paramList[] = ['name'=>$paramName, 'type'=>$paramType,
                            'byRef'=>$param->byRef, 'default'=>$default];
        }
        $this->methods[] = ['name'=>$name, 'type'=>$type,
                            'byRef'=>$byRef, 'params'=>$paramList, 'doc'=>$docComment];
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

    public function getClassType()
    {
        return $this->classType;
    }

    public function setClassType($classType)
    {
        $this->classType = $classType;
        return $this;
    }
}
