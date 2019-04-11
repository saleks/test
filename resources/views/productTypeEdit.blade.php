@extends('layouts.main')

@section('content')
    <div class="row">
        @include('layouts.nav')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Product Types</h1>
            </div>
            <h2>Product Type Edit - {{ $productType->name }}</h2>
            <div class="row">
                <div class="col-4">
                    <h3>Edit Product Type</h3>
                    <form method="post" action="{{ route('product-type.update', $productType->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" required value="{{ $productType->name }}">
                        </div>
                        <div class="form-group">
                            <label for="selectAttributes">Attributes</label>
                            <select name="attributes[]" multiple class="form-control" id="selectAttributes">
                                @forelse($attributeList as $item)
                                    <option value="{{ $item->id }}" {{ $productType->attributes->contains('id', $item->id) ? 'selected': '' }}>{{ $item->name }}</option>
                                @empty
                                    <option value="">No data</option>
                                @endforelse
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('product-type.index') }}" class="btn btn-warning">Back</a>
                    </form>
                </div>
            </div>

        </main>
    </div>
@endsection