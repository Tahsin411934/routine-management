<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutineSection extends Model
{
    use HasFactory;

    protected $table = 'routine_section';
public $timestamps = false;
    protected $fillable = [
        'routine_id',
        'section',
        'room',
    ];

    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }

    public function routineTeachers()
    {
        return $this->hasMany(RoutineTeacher::class, 'section_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'routine_teachers', 'section_id', 'teacher_id')
                    ;
    }
}
