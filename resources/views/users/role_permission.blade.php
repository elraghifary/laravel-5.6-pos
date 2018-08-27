@extends('layouts.master')

@section('title')
    <title>PoS - Role Permission Management</title>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
    <style type="text/css">
        .error { color: #dd4b39 !important; }
        .tab-pane {
            height: 200px;
            overflow-y: scroll;
        }
    </style>
@endpush

@section('content')
    <section class="content-header">
        <h1>Role Permission<small>data</small></h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('user.index') }}"><i class="fa fa-file-text"></i> User</a></li>
            <li class="active">Role Permission</li>
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">
                            <i class="fa fa-plus"></i> Add Permission
                        </button>
                        <div class="modal fade" id="modal-add">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Add Permission</h4>
                                    </div>
                                    <form role="form" id="form-permission" action="{{ route('user.add_permission') }}" method="post">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Permission</label>
                                                <input type="text" 
                                                name="name"
                                                class="form-control" id="name">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <form role="form" action="{{ route('user.roles_permission') }}" method="get">
                            <div class="form-group">
                                <label for="">Roles</label>
                                <div class="input-group">
                                    <select name="role" class="form-control">
                                        @foreach ($roles as $value)
                                            <option value="{{ $value }}" {{ request()->get('role') == $value ? 'selected':'' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <button class="btn btn-danger">Check!</button>
                                    </span>
                                </div>
                            </div>
                        </form>                        
                        @if (!empty($permissions))
                            <form action="{{ route('user.setRolePermission', request()->get('role')) }}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1" data-toggle="tab">Permissions</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1">
                                                @php $no = 1; @endphp
                                                @foreach ($permissions as $key => $row)
                                                    <input type="checkbox" 
                                                        name="permission[]" 
                                                        class="minimal-red" 
                                                        value="{{ $row }}" {{ in_array($row, $hasPermission) ? 'checked':'' }}
                                                        > {{ $row }} <br>
                                                    @if ($no++%4 == 0)
                                                    <br>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-sm">
                                    <i class="fa fa-send"></i> Set Permission
                                </button>
                            </form>
                        @endif
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
            $("#form-permission").validate({
                rules: {
                    name: {
                        required: true
                    }
                }
            });
        });
    </script>
@endpush