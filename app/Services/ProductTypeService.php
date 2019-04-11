<?php
/**
 * Created by PhpStorm.
 * User: salex
 * Date: 11.04.19
 * Time: 17:24
 */

namespace App\Services;


use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeService
{
    protected $productType;

    public function __construct()
    {
        $this->productType = new ProductType();
    }

    public function store(Request $request)
    {
        $this->productType->fill($request->only('name'));
        $this->productType->save();
        $this->productType->attributes()->attach($request->get('attributes'));
        return;
    }

    public function update(Request $request, $id)
    {
        $this->productType = ProductType::find($id);
        $this->productType->update($request->only('name'));
        $this->productType->attributes()->sync($request->get('attributes'));
        return;
    }

    public function delete($id)
    {
        $this->productType = ProductType::find($id);
        $this->productType->delete();
        return;
    }
}