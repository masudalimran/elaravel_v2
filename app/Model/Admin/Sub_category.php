<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Sub_category extends Model
{
    //
    protected $fillable = [
        'category_id', 'sub_category_name'
    ];
}
