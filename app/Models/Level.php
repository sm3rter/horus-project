<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = ['name'];

    public function courses()
    {
        return $this->hasMany(Course::class, 'course_level', 'name');
    }
    public function getRouteKeyName()
    {
        return 'name';
    }
}
