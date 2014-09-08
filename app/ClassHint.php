<?php

namespace PhpCodeHints;

class ClassHint {

    public $name = "";

    public $extends = "";

    public $methods = [];

    public $properties = [];

    public function addMethod($name, $type, $params, $docComment)
    {
        $this->methods[] = ['name'=>$name, 'type'=>$type, 'params'=>$params, 'doc'=>$docComment];
        return null;
    }

    public function addProperty($name, $docComment)
    {
    $this->properties[] = ['name'=>$name, 'doc'=>$docComment];
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
