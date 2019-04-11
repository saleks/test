@extends('layouts.main')

@section('content')
    <div class="row">
        @include('layouts.nav')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Product Types</h1>
            </div>
            <h2>Product Type</h2>
            <div class="row">
                <div class="col-8">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Attributes</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($productTypeList as $productType)
                                <tr>
                                    <td>{{ $productType->id }}</td>
                                    <td>{{ $productType->name }}</td>
                                    <td>
                                        @forelse( $productType->attributes as $attribute)
                                            <span class="badge badge-info">{{ $attribute->name }}</span>
                                        @empty
                                            No data
                                        @endforelse
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('product-type.edit', $productType->id) }}" class="btn btn-success btn-sm">Edit</a>
                                        <form method="post" action="{{ route('product-type.destroy', $productType->id) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Empty</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-4">
                    <h3>Add New Product Type</h3>
                    <form method="post" action="{{ route('product-type.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <label for="selectAttributes">Attributes</label>
                            <select name="attributes[]" multiple class="form-control" id="selectAttributes">
                                @forelse($attributeList as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @empty
                                    <option value="">No data</option>
                                @endforelse
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
@endsection