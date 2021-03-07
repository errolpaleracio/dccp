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
            'Bachelor of Science in Computer Science',
            'Bachelor of Science in Information Technology',
            'Bachelor of Science in Computer Secretarial',
            'Bachelor of Science in Computer Engineering',
            'Bachelor of Science in Business Administration Major in Human Resource Development Management',
            'Bachelor of Science in Business Administration Major in Operations Management',
            'Bachelor of Science in Business Administration Major in Marketing Management',
            'Bachelor of Science in Business Administration Major in Financial Management',
        ];

        foreach($courses as $course){
            Course::create(['description' => $course]);
        }
    }
}
