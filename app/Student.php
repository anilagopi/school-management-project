<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Student
 *
 * @property int    $id
 * @property string $name
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 *
 * @package App\Models
 */
class Student extends Model
{
    use SoftDeletes;

    const COL_ID         = 'id';
    const COL_NAME       = 'name';
    const COL_TEACHER_ID = 'teacher_id';
    const COL_AGE        = 'age';
    const COL_GENDER     = 'gender';

    protected $casts = [
        'teacher_id' => 'int',
        'age'        => 'int',
    ];

    protected $fillable = [
        'name',
        'teacher_id',
        'age',
        'gender'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function student_marks()
    {
        return $this->hasMany(StudentMark::class, 'student_id');
    }
}
