@extends('layouts.main')

@section('content')
    <div class="row">
        @include('layouts.nav')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Products</h1>
            </div>
            <h2 class="d-inline-block">Products List</h2>
            <form action="{{ route('product.create') }}" class="form-inline">
                <div class="input-group">
                    <select name="productType" class="custom-select" required>
                        <option selected value="0">Choose Product Type</option>
                        @forelse($typeList as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @empty
                            <option value="0">No data</option>
                        @endforelse
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit">Create</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>SKU</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Attributes</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($productList as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->productType->name }}</td>
                                    <td>
                                        @forelse( $product->attributeValues as $item)
                                            <span class="badge badge-info">{{ $item->attribute->name }}: {{ $item->value }} {{ $item->attribute->symbol }}</span>
                                        @empty
                                            No data
                                        @endforelse
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-success btn-sm">Edit</a>
                                        <form method="post" action="{{ route('product.destroy', $product->id) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Empty</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection