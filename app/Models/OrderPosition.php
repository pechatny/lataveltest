<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPosition extends Model {

    public $timestamps = false;
    public $primaryKey = 'id';
    protected $fillable = ['order_id','good_id'];

}
