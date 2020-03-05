<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Person extends Model
{
    const FINISH = '1';
    const UN_FINISH = '2';
    const FINISH_UN = '0';
    protected $table = "persons";
    protected $fillable = [
        'name', 'email', 'address', 'gender', 'phone', 'faculty_id', 'date', 'image'
    ];

    protected $primaryKey = 'id';

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'points')->withPivot('person_id', 'subject_id', 'point');
    }

    public function faculty()
    {
        return $this->belongsTo('App\Faculty', 'faculty_id');
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
