<?php

namespace myNamespace;

class Bar extends Baz
{

    public $barPublic = "";

    protected $barProtected = 0;

    private $barPrivate = "";

    public $bazPublic = "override";

    public function barPublicFunction($param1_1)
    {
        return true;
    }

    protected function barProtectedFunction($param2_1, $param2_2)
    {
        return true;
    }

    private function barPrivateFunction()
    {
        return true;
    }
}
