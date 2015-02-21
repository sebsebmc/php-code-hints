<?php


/**
 * The full path and filename of the file. If used inside an include,
 * the name of the included file is returned.
 * Since PHP 4.0.2, <b>__FILE__</b> always contains an
 * absolute path with symlinks resolved whereas in older versions it contained relative path
 * under some circumstances.
 * @link http://php.net/manual/en/language.constants.php
 */
define ('__FILE__', null);

/**
 * The current line number of the file.
 * @link http://php.net/manual/en/language.constants.php
 */
define ('__LINE__', null);

/**
 * The class name. (Added in PHP 4.3.0) As of PHP 5 this constant
 * returns the class name as it was declared (case-sensitive). In PHP
 * 4 its value is always lowercased. The class name includes the namespace
 * it was declared in (e.g. Foo\Bar).
 * Note that as of PHP 5.4 __CLASS__ works also in traits. When used
 * in a trait method, __CLASS__ is the name of the class the trait
 * is used in.
 * @link http://php.net/manual/en/language.constants.php
 */
define ('__CLASS__', "");

/**
 * The function name. (Added in PHP 4.3.0) As of PHP 5 this constant
 * returns the function name as it was declared (case-sensitive). In
 * PHP 4 its value is always lowercased.
 * @link http://php.net/manual/en/language.constants.php
 */
define ('__FUNCTION__', null);

/**
 * The class method name. (Added in PHP 5.0.0) The method name is
 * returned as it was declared (case-sensitive).
 * @link http://php.net/manual/en/language.constants.php
 */
define ('__METHOD__', null);

/**
 * The trait name. (Added in PHP 5.4.0) As of PHP 5.4 this constant
 * returns the trait as it was declared (case-sensitive). The trait name includes the namespace
 * it was declared in (e.g. Foo\Bar).
 * @link http://php.net/manual/en/language.constants.php
 */
define ('__TRAIT__', null);

/**
 * The directory of the file. If used inside an include,
 * the directory of the included file is returned. This is equivalent
 * to dirname(__FILE__). This directory name
 * does not have a trailing slash unless it is the root directory.
 * (Added in PHP 5.3.0.)
 * @link http://php.net/manual/en/language.constants.php
 */
define ('__DIR__', null);

/**
 * The name of the current namespace (case-sensitive). This constant
 * is defined in compile-time (Added in PHP 5.3.0).
 * @link http://php.net/manual/en/language.constants.php
 */
define ('__NAMESPACE__', null);
?>
