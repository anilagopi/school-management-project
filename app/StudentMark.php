<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentMark
 *
 * @property int    $id
 * @property int    $subject_id
 * @property int    $student_term_id
 * @property string $mark
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 *
 * @package App\Models
 */
class StudentMark extends Model
{
    const COL_ID              = 'id';
    const COL_STUDENT_TERM_ID = 'student_term_id';
    const COL_SUBJECT_ID      = 'subject_id';
    const COL_MARK            = 'mark';

    protected $casts = [
        'student_term_id' => 'int',
        'subject_id'      => 'int',
    ];

    protected $fillable = [
        'subject_id',
        'student_term_id',
        'mark'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function student_term()
    {
        return $this->belongsTo(StudentTerm::class, 'student_term_id');
    }
}