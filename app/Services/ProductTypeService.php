<?php
/**
 * Created by PhpStorm.
 * User: salex
 * Date: 11.04.19
 * Time: 17:24
 */

namespace App\Services;


use App\Models\AttributeValue;
use App\Models\Product;
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
        $attributes = $request->get('attributes');
        $this->productType = ProductType::find($id);
        $cur_attr_ids = $this->productType->attributes()->pluck('id')->toArray();
        $dell_ids = array_diff($cur_attr_ids, $attributes);

        $this->productType->update($request->only('name'));
        $this->productType->attributes()->sync($attributes);

        $products = Product::with('attributeValues')->where('product_type_id', $id)->get();
        $products->map(function ($item) use ($attributes, $dell_ids) {
            $this->addAttributeValue($item, $attributes);
            $this->deleteAttributeValue($item, $dell_ids);
        });

        return;
    }

    public function delete($id)
    {
        $this->productType = ProductType::find($id);
        $this->productType->delete();
        return;
    }

    /**
     *  Add null value if added new attribute
     * @param $item
     * @param $attributes
     */
    protected function addAttributeValue($item, $attributes): void
    {
        foreach ($attributes as $attribute_id) {
            if (!$item->attributeValues->contains('attribute_id', $attribute_id)) {
                AttributeValue::create([
                    'product_id' => $item->id,
                    'attribute_id' => $attribute_id,
                ]);
            }
        }
    }

    /**
     *  remove attribute
     * @param $item
     * @param $dell_ids
     */
    protected function deleteAttributeValue($item, $dell_ids): void
    {
        foreach ($dell_ids as $del_attribute_id) {
            if ($item->attributeValues->contains('attribute_id', $del_attribute_id)) {
                $item->attributeValues()->where('attribute_id', $del_attribute_id)->delete();
            }
        }
    }
}