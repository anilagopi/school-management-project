<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subject
 *
 * @property int    $id
 * @property string $name
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Subject extends Model
{
    const COL_ID   = 'id';
    const COL_NAME = 'name';

    protected $fillable = [
        'name'
    ];

    public function student_marks()
    {
        return $this->hasMany(StudentMark::class, 'subject_id');
    }
}