<?php

namespace Ht7\Test\Tests\Utility\Traits;

use \Ht7\Test\Utility\Traits\ValidationBase;

/**
 * Description of ValidationBase
 *
 * @author 1stthomas
 */
class ValidationBaseHelper
{

    use ValidationBase;

    protected $arr = [];
    protected $boolean;
    protected $float;
    protected $integer;
    protected $object;
    protected $string;

    public function __construct()
    {
        ;
    }

    public function getProperties()
    {
        return [
            'arr' => $this->arr,
            'boolean' => $this->boolean,
            'float' => $this->float,
            'integer' => $this->integer,
            'object' => $this->object,
            'string' => $this->string,
        ];
    }

    public function getArray()
    {
        return $this->arr;
    }

    public function setArray($arr)
    {
        $e = $this->validateDatatype($arr, ['array'], 'array');

        if ($e === true) {
            $this->arr = $arr;
        } else {
            return $e;
        }
    }

    public function setBoolean($bool)
    {
        $this->validateDatatype($bool, ['boolean'], 'boolean');

        $this->boolean = $bool;
    }

    public function setFloat($float)
    {
        $this->validateDatatype($float, ['double'], 'double');

        $this->float = $float;
    }

    public function setInteger($int)
    {
        $this->validateDatatype($int, ['integer'], 'integer');

        $this->integer = $int;
    }

    public function setObject($obj)
    {
        $this->validateDatatype($obj, ['object'], 'object');

        $this->object = $obj;
    }

    public function setString($str)
    {
        $this->validateDatatype($str, ['string'], 'string');

        $this->string = $str;
    }

    public function setNotEmptyArray($arr)
    {
        $e = $this->validateNotEmpty($arr, 'array');

        if ($e === true) {
            $e = $this->setArray($arr);
        } else {
            return $e;
        }
    }

}
