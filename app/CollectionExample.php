<?php

namespace App;


class CollectionExample
{

    public function example()
    {
        $collection = collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $chunks = $collection->split(3);

        return $chunks->toArray();
    }

}