@extends('layouts.master')

@section('title')
    <title>PoS - Create Product</title>
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
            <li class="active">Create</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <form role="form" id="form-product" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="code">Product Code</label>
                                <input type="text" name="code" id="code" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" cols="5" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="text" name="stock" id="stock" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" name="price" id="price" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($categories as $row)
                                        <option value="{{ $row->id }}">{{ ucfirst($row->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input type="file" name="photo" class="form-control">
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
                    },
                    photo: {
                        required: true,
                        extension: "jpg|jpeg|png"
                    }
                }
            });
        });
    </script>
@endpush