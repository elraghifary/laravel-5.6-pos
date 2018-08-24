@extends('layouts.master')

@section('title')
    <title>PoS - Category Management</title>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
    <style type="text/css">
        .error { color: #dd4b39 !important; }
    </style>
@endpush

@section('content')
    <section class="content-header">
        <h1>Category<small>data</small></h1>
        <ol class="breadcrumb">
            <li class="active"><a href="{{ route('category.index') }}"><i class="fa fa-file-text"></i> Category</a></li>
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
                        <a type="button" class="btn btn-primary" href="{{ route('category.create') }}" id="btn-add"><i class="fa fa-plus"></i> Add Category</a>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-import">
                          Import
                        </button>
                        <div class="modal fade" id="modal-import">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Import Excel</h4>
                                    </div>
                                    <form role="form" id="form-import-category" action="{{ route('category.importExcel') }}" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">File</label>
                                                <input type="file" name="file" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Import</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <table id="category" class="responsive nowrap table table-bordered table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th>Name</th>
                                    <th>Description</th>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
    <script type="text/javascript">
        $( document ).ready(function() {
            var table = $('#category').DataTable({
                ajax: {
                    url: '{{ route('category.getData') }}'
                }
            });

            $("#form-import-category").validate({
                rules: {
                    file: {
                        required: true,
                        extension: "xlsx|xlsm|xltx|xltm|csv"
                    }
                }
            });
        });
    </script>
@endpush