<?php

namespace App\Observers;

use App\Models\Course;
use Illuminate\Support\Str;

class CourseObserver
{
    /**
     * Handle the Course "created" event.
     *
     * @param  \App\Models\Course  $course
     * @return void
     */
    public function creating(Course $course)
    {
        // antes de criar o Curso, cria um valor para o 'uuid'
        $course->uuid = (string) Str::uuid();
    }
}
