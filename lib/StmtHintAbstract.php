<?php

namespace PhpCodeHints;

abstract class StmtHintAbstract
{


    protected $stmtType = "";

    protected $name = "";

    /**
     * returns the $stmtType value
     */
    abstract public function getStmtType();

    /**
     * Sets the $stmtType to a value
     * @param String $stmtType string value of stmtType
     */
    abstract public function setStmtType($stmtType);

    abstract public function getName();

    abstract public function setName($name);
}
