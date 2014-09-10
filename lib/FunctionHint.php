<?php

namespace PhpCodeHints;

class FunctionHint
{
    public $stmtType = "";

    public $name = "";

    public $properties = [];

    public function addProperty($name, $docComment)
    {
        $this->properties[] = ['name'=>$name, 'doc'=>$docComment];
    }
}
