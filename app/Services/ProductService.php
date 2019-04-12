<?php

namespace App\Services;


use App\Models\AttributeValue;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductService
{
    protected $product;

    /**
     * ProductService constructor.
     */
    public function __construct()
    {
        $this->product = new Product();
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $productValues = [];
        $this->product->fill($request->except(['_token', 'attributes']));
        $this->product->save();
        foreach ($request->get('attributes') as $key => $value) {
            $attribute = new AttributeValue();
            $attribute['attribute_id'] = $key;
            $attribute['value'] = $value;
            $productValues[] = $attribute;
        }

        $this->product->attributeValues()->saveMany($productValues);
        return;
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $this->product = Product::with('attributeValues')->find($id);
        $this->product->update($request->except(['_token', 'attributes', '_method']));

        if ($request->has('attributes')) {
            foreach ($request->get('attributes') as $id => $attribute) {
                AttributeValue::find($id)->update(['value' => $attribute]);
            }
        }

        return;
    }

    public function delete($id)
    {
        $this->product = Product::find($id);
        $this->product->delete();
        return;
    }
}