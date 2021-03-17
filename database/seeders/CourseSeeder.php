<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            'Bachelor of Science in Information Technology',
            'Bachelor of Science in Criminology',
            'Bachelor of Elementary Education',
            'Bachelor of Science in Business Administration Major in Marketing Management',
            'Bachelor of Science in Business Administration Major in Financial Management',
        ];

        foreach($courses as $course){
            Course::create(['description' => $course]);
        }
    }
}
