<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adopter extends Model
{
    use HasFactory;
    // protected $fillable = ['a_fname', 'a_lname', 'date_adopted', 'address', 'phone'];
    public $timestamps=false;
    protected $guarded = ['id'];

    public function animals()
    {
    	return $this->hasMany('App\Models\Animal');
    }
}
