<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rescuer extends Model
{
    use HasFactory;
    // protected $fillable = ['r_fname', 'r_lname', 'address', 'phone'];
    public $timestamps=false;
    protected $guarded = ['id'];

    public function animals()
    {
    	return $this->hasMany('App\Models\Animal');
    }
}
