<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Good extends Model {
    public $timestamps = false;
    public $primaryKey = 'good_id';
    protected $fillable = ['title', 'price'];

    public function orderPositions()
    {
        return $this->hasMany('App\Models\OrderPosition', 'good_id');
    }
}
