<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShelterPersonnel extends Model
{
    use HasFactory;
    // protected $fillable = ['p_fname', 'p_lname', 'job_description', 'address', 'phone'];
    public $timestamps=false;
    protected $guarded = ['id'];

    public function animals()
    {
    	return $this->hasMany('App\Models\Animal');
    }
}
