<?php

namespace myNamespace;

class Baz
{

    public $bazPublic = "";

    protected $bazProtected = 0;

    private $bazPrivate = "";

    public function bazPublicFunction($param1_1)
    {
        return true;
    }

    protected function bazProtectedFunction($param2_1, $param2_2)
    {
        return true;
    }

    private function bazPrivateFunction()
    {
        return true;
    }
}
