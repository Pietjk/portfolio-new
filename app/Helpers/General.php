<?php

namespace App\Helpers;

class General
{
    /**
     * Determine the order of integers.
     *
     * @param  $isEven
     * @param  $index
     * @return $order
     */
    public static function createOrder($isEven, $index)
    {
        $order = [];
        if($isEven) {
            $order = [2+$index,2+$index,1+$index,1+$index];
        }else{
            $order = [1+$index,2+$index,2+$index,1+$index];
        }

        return $order;
    }
}
