<?php

namespace PhpCodeHints;

class ClassHint {

    public $name = "";

    public $extends = "";

    public $methods = [];

    public $properties = [];

    public function addMethod($name, $type, $params)
    {
        $this->methods[] = [name=>$name, type=>$type, params=>$params];
        return null;
    }

    public function addProperty($name)
    {
        $this->properties[] = $name;
    }

    public function getMethods()
    {
        return $this->methods;
    }

    public function getProperties()
    {
        return $this->properties;
    }
}
