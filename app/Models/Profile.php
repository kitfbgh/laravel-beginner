<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id',
        'name',
        'email',
        'github',
    ];

    /**
     * @return string
     */
    public function getGithubUrlAttribute(): string
    {
        return "https://github.com/{$this->github}";
    }

    public function student()
    {
        return $this->belongsTo(
            Student::class,
            'student_id'
        );
    }
}
