<?php

namespace Foo;

class Foo
{
    const CONST1 = "blah";
    const CONST2 = 100,
        CONST3 = True;

    private $propPriv1 = "";

    protected $proProt1 = "";

    public $propPub1 = "";

    public $propPub2 = "",
        $propPub3 = "";

    public function pubFunc1($param1, array $param2array)
    {
        return null;
    }
}
