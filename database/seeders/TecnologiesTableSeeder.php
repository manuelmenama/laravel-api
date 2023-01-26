<?php

namespace Database\Seeders;

use App\Models\Tecnology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TecnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['HTML', 'PHP', 'JavaScript', 'VueJs', 'CSS', 'SCSS', 'Bootstrap', 'Laravel', 'VueJs'];

        foreach($data as $data_item){

            $new_tecnologies = new Tecnology();
            $new_tecnologies->name = $data_item;
            $new_tecnologies->slug = Str::slug($data_item);
            $new_tecnologies->save();
        }
    }
}
