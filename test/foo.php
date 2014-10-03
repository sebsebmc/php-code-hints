<?php

namespace myNamespace;

class Foo extends Bar
{

    public $fooPublic = "";

    protected $fooProtected = 0;

    private $fooPrivate = "";

    public $bazPublic = "override at foo";

    public function fooPublicFunction($param1_1)
    {
        return true;
    }

    protected function fooProtectedFunction($param2_1, $param2_2)
    {
        return true;
    }

    private function fooPrivateFunction()
    {
        return true;
    }
}
