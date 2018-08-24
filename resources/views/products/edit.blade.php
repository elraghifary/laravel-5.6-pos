@extends('layouts.master')

@section('title')
    <title>PoS - Edit Product</title>
@endsection

@push('styles')
    <style type="text/css">
        .error { color: #dd4b39 !important; }
    </style>
@endpush

@section('content')
    <section class="content-header">
        <h1>Product<small>data</small></h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('product.index') }}"><i class="fa fa-file-text"></i> Product</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <form role="form" id="form-product" action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="code">Product Code</label>
                                <input type="text" name="code" id="code" class="form-control" value="{{ $product->code }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ $product->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="text" name="stock" id="stock" class="form-control" value="{{ $product->stock }}">
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" name="price" id="price" class="form-control" value="{{ $product->price }}">
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($categories as $row)
                                        <option value="{{ $row->id }}" {{ $row->id == $product->category_id ? 'selected' : '' }}>{{ ucfirst($row->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input type="file" name="photo" class="form-control">
                                @if (!empty($product->photo))
                                    <hr>
                                    <img src="{{ asset('uploads/product/' . $product->photo) }}" 
                                        alt="{{ $product->name }}"
                                        width="150px" height="150px">
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ route('category.index') }}" class="btn btn-default">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
    <script type="text/javascript">
        $( document ).ready(function() {
            $("#form-product").validate({
                rules: {
                    code: {
                        required: true
                    },
                    name: {
                        required: true
                    },
                    stock: {
                        required: true,
                        digits: true
                    },
                    price: {
                        required: true,
                        digits: true
                    },
                    category_id: {
                        required: true
                    }
                }
            });
        });
    </script>
@endpush