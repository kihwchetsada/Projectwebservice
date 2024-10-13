<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; 
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(); // สร้างตัวอย่าง Faker

        for ($i = 0; $i < 100; $i++) {
            Product::create([
                'name' => $faker->word, // สุ่มชื่อสินค้า
                'description' => $faker->sentence, // สุ่มคำบรรยายสินค้า
                'price' => $faker->randomFloat(2, 10, 500), // สุ่มราคา (ทศนิยม 2 ตำแหน่งระหว่าง 10 ถึง 500)
                'created_at' => now(), // ใช้เวลาปัจจุบัน
                'updated_at' => now(), // ใช้เวลาปัจจุบัน
            ]);
        }
    }
}
