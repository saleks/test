@extends('layouts.main')

@section('content')
    <div class="row">
        @include('layouts.nav')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Add product</h1>
            </div>
            <div class="row">
                <div class="col-6">
                    <h3>Product Type {{ $productType->name }}</h3>
                    <form method="post" action="{{ isset($product) ? route('product.update', $product->id) :  route('product.store') }}">
                        @if(isset($product))
                            @method('PUT')
                        @endif
                        @csrf
                        <input type="hidden" name="product_type_id" value="{{ $productType->id }}" required>
                        <div class="form-group">
                            <label for="inputSKU">SKU</label>
                            <input type="text" name="sku" value="{{ isset($product) ? $product->sku : '' }}" class="form-control" id="inputSKU" placeholder="SKU" required>
                        </div>
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input type="text" name="name" value="{{ isset($product) ? $product->name : '' }}" class="form-control" id="inputName" placeholder="Name" required>
                        </div>
                        @if(isset($product))
                            @forelse($product->attributeValues as $item)
                                <div class="form-group">
                                    <label for="{{ 'inputAttr-' . $item->id }}" class="text-uppercase">{{ $item->attribute->name }}</label>
                                    <input type="text" name="{{ 'attributes[' . $item->id . ']' }}" value="{{ $item->value }}" class="form-control" id="{{ 'inputAttr-' . $item->id }}" placeholder="Type {{ $item->attribute->type }}" required>
                                </div>
                            @empty
                                No attribute
                            @endforelse
                        @else
                            @forelse($attributes as $attribute)
                                <div class="form-group">
                                    <label for="{{ 'inputAttr-' . $attribute->id }}" class="text-uppercase">{{ $attribute->name }}</label>
                                    <input type="text" name="{{ 'attributes[' . $attribute->id . ']' }}" class="form-control" id="{{ 'inputAttr-' . $attribute->id }}" placeholder="Type {{ $attribute->type }}" required>
                                </div>
                            @empty
                                No attribute
                            @endforelse
                        @endif
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>

        </main>
    </div>
@endsection