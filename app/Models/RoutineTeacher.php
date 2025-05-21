<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoutineTeacher extends Model
{
     protected $table = 'routine_teachers';
     public $timestamps = false;
     protected $fillable = [
        'section_id',
        'teacher_id'
    ];
    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }
    public function teacher()
{
    return $this->belongsTo(User::class, 'teacher_id');
}



}
