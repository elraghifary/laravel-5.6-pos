@extends('layouts.master')

@section('title')
    <title>PoS - Product Management</title>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
    <section class="content-header">
        <h1>Product<small>data</small></h1>
        <ol class="breadcrumb">
            <li class="active"><a href="{{ route('product.index') }}"><i class="fa fa-file-text"></i> Product</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        {!! session('success') !!}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        {!! session('error') !!}
                    </div>
                @endif
                <div class="box">
                    <div class="box-body">
                        <a type="button" class="btn btn-primary" href="{{ route('product.create') }}" id="btn-add"><i class="fa fa-plus"></i> Add Product</a><hr>         
                        <table id="product" class="responsive nowrap table table-bordered table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Updated At</th>
                                    <th style="width: 5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $( document ).ready(function() {
            var table = $('#product').DataTable({
                ajax: {
                    url: '{{ route('product.getData') }}'
                }
            });
        });
    </script>
@endpush