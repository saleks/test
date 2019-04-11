<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\ProductType;
use App\Services\ProductTypeService;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productTypeList = ProductType::with('attributes')->get();
        $attributeList = Attribute::all();

        return view('productType', compact('productTypeList', 'attributeList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param ProductTypeService $service
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ProductTypeService $service)
    {
        $service->store($request);
        return back();
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
        $productType = ProductType::with('attributes')->find($id);
        $attributeList = Attribute::all();

//        dd($productType);

        return view('productTypeEdit', compact('productType', 'attributeList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @param ProductTypeService $service
     * @return void
     */
    public function update(Request $request, $id, ProductTypeService $service)
    {
        $service->update($request, $id);
        return redirect()->route('product-type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, ProductTypeService $service)
    {
        $service->delete($id);
        return redirect()->route('product-type.index');
    }
}
