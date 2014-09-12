<?php

namespace Foo\Bar;

class Baz
{
    const CONST1 = "blah";
    const CONST2 = 100,
        CONST3 = True;

    private $propPriv1 = "";

    protected $proProt1 = "";

    public $propPub1 = "";

    public $propPub2 = "",
        $propPub3 = "";

    public function pubFunc1($param1 = 0, array $param2array)
    {
        return null;
    }

    public function protFunc2($param1 = "param 1 string", array $param2array, &$paramByRef, Foo\Bar\Baz $paramTypeHint)
    {
        return null;
    }
}
