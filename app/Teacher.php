<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Teacher
 *
 * @property int    $id
 * @property string $name
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Teacher extends Model
{
    const COL_ID   = 'id';
    const COL_NAME = 'name';

    protected $fillable = [
        'name'
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'teacher_id');
    }
}
