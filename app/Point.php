<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $table = "points";
    protected $fillable = ['point', 'person_id', 'subject_id'];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function person(){
        return $this->belongsTo('App\Person');
    }
    public function subject()
    {
        return $this->belongsTo('App\Subject', 'subject_id');
    }
}
