<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = ['name', 'description'];

    protected $primaryKey = 'id';

    public function students(){
        return $this->hasMany(Person::class);
    }

}
