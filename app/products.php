<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['cat_id', 'name', 'description', 'price', 'image', 'quantity'];
}
