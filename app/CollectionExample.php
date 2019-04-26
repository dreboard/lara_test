<?php

namespace App;


use Illuminate\Support\Collection;

class CollectionExample
{
    private $multiNum = [
        ['name' => 'one', 'number' => 1, 'ordinal' => 'first'],
        ['name' => 'two', 'number' => 2, 'ordinal' => 'second'],
        ['name' => 'three', 'number' => 3, 'ordinal' => 'third'],
        ['name' => 'four', 'number' => 4, 'ordinal' => 'fourth'],
        ['name' => 'five', 'number' => 5, 'ordinal' => 'fifth'],
        ['name' => 'six', 'number' => 6, 'ordinal' => 'sixth'],
    ];
    private $asscoNum = [
        'one' => 1,
        'two' => 2,
        'three' => 3,
        'four' => 4,
        'five' => 5,
        'six' => 6,
    ];
    private $nums = [1, 2, 3, 4, 5, 6];
    private $numsStr = [
        'one', 'two', 'three', 'four', 'five', 'six'
    ];

    public function example()
    {
        return response('Hello World', 200)->header('Content-Type', 'text/plain');
        return Collection::make($this->multiNum)->map(function($item){
            return collect($item)->only('name', 'ordinal')->all();
        });
    }
    public function example2()
    {
        $collection = Collection::make($this->multiNum);
        $multiplied = $collection->each(function ($item, $key) {
            return $item * 2;
        });
        //$multiplied->all();	// [2, 4, 6, 8, 10]
        return $multiplied->all();
        return $collection->all();
    }

}