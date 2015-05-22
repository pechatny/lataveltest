<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model {
    public $primaryKey = 'request_id';
    public $timestamps = false;
    protected $fillable = ['time', 'url', 'params'];
}
