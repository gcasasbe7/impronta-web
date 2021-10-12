<?php

namespace App;


class OrderProduct extends Product
{
    protected $fillable = ['product_id','product_name','quantity','size'];

    public $timestamps = false;
}
