<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use DateTime;

class GachaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('gachas')->insert([
                'name' => 'アイテム１',
                'image_url' => 'https://res.cloudinary.com/dttichlms/image/upload/v1726826244/cld-sample.jpg',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                
         ]); 

            DB::table('gachas')->insert([
                'name' => 'アイテム２',
                'image_url' => 'https://res.cloudinary.com/dttichlms/image/upload/v1726826244/cld-sample-2.jpg',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                
         ]);    
         
            DB::table('gachas')->insert([
                'name' => 'アイテム３',
                'image_url' => 'https://res.cloudinary.com/dttichlms/image/upload/v1726826244/cld-sample-3.jpg',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                
         ]);    

            DB::table('gachas')->insert([
                'name' => 'アイテム４',
                'image_url' => 'https://res.cloudinary.com/dttichlms/image/upload/v1726826244/cld-sample-4.jpg',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                
         ]);    
         
            DB::table('gachas')->insert([
                'name' => 'アイテム５',
                'image_url' => 'https://res.cloudinary.com/dttichlms/image/upload/v1726826245/cld-sample-5.jpg',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                
         ]);    
    }
}
