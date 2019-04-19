<?php

namespace App\Http\Classes;


class TestClassOne
{

    /**
     * @var string
     */
    protected $key;

    public $testVar = 1;

    public function __construct(?TestClassDep $obj, int $key)
    {
        $this->key = $key;
    }
}