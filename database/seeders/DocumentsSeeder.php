<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Document;

class DocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $documents = [
            ['description' => 'Diploma/Certificate', 'price' => '100'],
            ['description' => 'Transcript of Record', 'price' => '150'],
            ['description' => 'Transfer Credential/Honorable Dismissal', 'price' => '200'],
            ['description' => 'Certification of Good Moral Character', 'price' => '250'],
            ['description' => 'Certificate of Enrollment', 'price' => '300'],
            ['description' => 'Certification of Grades', 'price' => '350']
        ];
        
        Document::insert($documents);
    }
}
