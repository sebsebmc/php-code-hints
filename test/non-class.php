<?php

define ("PHP_SESSION_DISABLED", 0);

define("CONSTDEFINE1", "string 1");

define("CONSTDEFINE2", 7E-10);

const CONSTCONST1 = "string 1";

const CONSTCONST2_1 = 21,
      CONSTCONST2_2 = 22;

function function1($param1 = 0)
{
    echo "foo";
}

function function2(&$param1, $param2 = "default value param2")
{
    echo "bar";
}
