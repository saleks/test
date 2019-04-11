@extends('layouts.main')

@section('content')
    <div class="row">
        @include('layouts.nav')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Attributes</h1>
            </div>
            <h2>Attributes List</h2>
            <div class="row">
                <div class="col-8">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Symbol</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($attributes as $attribute)
                                <tr>
                                    <td>{{ $attribute->id }}</td>
                                    <td>{{ $attribute->name }}</td>
                                    <td>{{ $attribute->type }}</td>
                                    <td>{{ $attribute->symbol }}</td>
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
                    <h3>Add New Attribute</h3>
                    <form method="post" action="{{ route('attribute.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <label for="selectType">Type</label>
                            <select name="type" class="form-control" id="selectType">
                                <option value="string">String</option>
                                <option value="integer">Integer</option>
                                <option value="float">Float</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputSymbol">Symbol</label>
                            <input type="text" name="symbol" class="form-control" id="inputSymbol" placeholder="Symbol for attribute" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>

        </main>
    </div>
@endsection