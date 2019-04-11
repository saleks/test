<?php

use App\Models\Attribute;
use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Phone'],
            ['name' => 'Pad'],
            ['name' => 'Laptop'],
        ];

        ProductType::insert($data);

        $productTypes = ProductType::all();

        $productTypes->map(function ($item) {
            $attribute = Attribute::all();
            $item->attributes()->saveMany($attribute->random(2));
        });
    }
}
