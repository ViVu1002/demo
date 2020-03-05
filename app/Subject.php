<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'description'];

    protected $primaryKey = 'id';

    public function persons(){
        return $this->belongsToMany('App\Person','points')->withPivot('person_id','subject_id','point');
    }
}
