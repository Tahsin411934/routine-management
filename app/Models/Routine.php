<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    use HasFactory;

    protected $table = 'routine';
public $timestamps = false;
    protected $fillable = [
        'date',
        'time',
        'course_name',
        'course_code',
        'semester',
        'session',
    ];
// Routine.php
public function routineSections()
{
    return $this->hasMany(RoutineSection::class);
}

// RoutineSection.php


public function routine()
{
    return $this->belongsTo(Routine::class);
}

// RoutineTeacher.php
public function section()
{
    return $this->belongsTo(RoutineSection::class, 'section_id');
}

public function teacher()
{
    return $this->belongsTo(User::class, 'teacher_id');
}

}
