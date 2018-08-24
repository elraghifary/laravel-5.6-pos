@extends('layouts.master')

@section('title')
    <title>PoS - User Management</title>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
    <style type="text/css">
        .error { color: #dd4b39 !important; }
    </style>
@endpush

@section('content')
    <section class="content-header">
        <h1>User<small>data</small></h1>
        <ol class="breadcrumb">
            <li class="active"><a href="{{ route('user.index') }}"><i class="fa fa-file-text"></i> User</a></li>
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
                        <a type="button" class="btn btn-primary" href="{{ route('user.create') }}" id="btn-add"><i class="fa fa-plus"></i> Add User</a>
                        <hr>
                        <table id="user" class="responsive nowrap table table-bordered table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
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
            var table = $('#user').DataTable({
                ajax: {
                    url: '{{ route('user.getData') }}'
                }
            });
        });
    </script>
@endpush