<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiseaseInjury extends Model
{
    use HasFactory;
    // protected $fillable = ['type', 'dis_inj', 'description'];
    public $timestamps=false;
    protected $guarded = ['id'];

    public function animals()
    {
    	return $this->belongsToMany('App\Models\Animals');
    }
}
