<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class StudentMark
 *
 * @property int    $id
 * @property int    $student_id
 * @property int    $term_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class StudentTerm extends Model
{
    const COL_ID         = 'id';
    const COL_STUDENT_ID = 'student_id';
    const COL_TERM_ID    = 'term_id';

    protected $casts = [
        'student_id' => 'int',
        'term_id'    => 'int',
    ];

    protected $fillable = [
        'student_id',
        'term_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id');
    }

    public function student_marks()
    {
        return $this->hasMany(StudentMark::class, 'student_term_id');
    }

    /**
     * Loads all students mark list.
     *
     * @param StudentMark $allStudentsMark
     *
     * @return array
     */
    public static function getAllMarkList($allStudentsMark)
    {
        $responseArray = [];

        foreach ($allStudentsMark as $data)
        {
            $responseArray[$data->student_id][$data->term_id]['id']         = $data->id ?? '';
            $responseArray[$data->student_id][$data->term_id]['name']       = $data->student->name ?? '';
            $responseArray[$data->student_id][$data->term_id]['term_name']  = $data->term->name ?? '';
            $responseArray[$data->student_id][$data->term_id]['subject'][]  = $data->mark ?? 0;
            $responseArray[$data->student_id][$data->term_id]['created_at'] = $data->created_at;
        }

        return $responseArray;
    }


}