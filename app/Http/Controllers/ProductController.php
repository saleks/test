<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productList = Product::with('productType', 'attributeValues', 'attributeValues.attribute')->get();
        $typeList = ProductType::all();

        return view('product', compact('productList', 'typeList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!request()->exists('productType') || request()->get('productType') == 0) {
            return back();
        }
        $productType = ProductType::with('attributes')->find(request()->get('productType'));
        $attributes = $productType->attributes;
        return view('productForm', compact('attributes', 'productType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param ProductService $service
     * @return void
     */
    public function store(Request $request, ProductService $service)
    {
        $service->store($request);
        return redirect()->route('product.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with(['productType', 'attributeValues'])->find($id);
        $productType = ProductType::with('attributes')->find($product->productType->id);
        $attributes = $productType->attributes;
        return view('productForm', compact('product','attributes', 'productType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @param ProductService $service
     * @return void
     */
    public function update(Request $request, $id, ProductService $service)
    {
        $service->update($request, $id);
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param ProductService $service
     * @return void
     */
    public function destroy($id, ProductService $service)
    {
        $service->delete($id);
        return redirect()->route('product.index');
    }
}
