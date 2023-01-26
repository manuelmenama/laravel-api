<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = ['HTML+CSS', 'VueJS', 'Laravel', 'PHP', 'JavaScript', 'Full-Stack'];

        foreach($data as $data_item){
            $new_type = new Type();
            $new_type->name = $data_item;
            $new_type->slug = Str::slug($data_item);
            $new_type->save();
        }

    }
}
