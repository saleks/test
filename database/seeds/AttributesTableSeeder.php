<?php

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'price', 'type' => 'float', 'symbol' => '$'],
            ['name' => 'width', 'type' => 'integer', 'symbol' => 'mm.'],
            ['name' => 'height', 'type' => 'integer', 'symbol' => 'mm.']
        ];

        Attribute::insert($data);
    }
}
