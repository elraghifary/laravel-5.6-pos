@extends('layouts.master')

@section('title')
    <title>PoS - Edit User</title>
@endsection

@push('styles')
    <style type="text/css">
        .error { color: #dd4b39 !important; }
    </style>
@endpush

@section('content')
    <section class="content-header">
        <h1>User<small>data</small></h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('user.index') }}"><i class="fa fa-file-text"></i> User</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <form role="form" id="form-user" action="{{ route('user.update', $user->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                                <p class="text-info">Leave empty, if you don't want to change password</p>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('user.index') }}" class="btn btn-default">Back</a>
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
            $("#form-user").validate({
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    }
                }
            });
        });
    </script>
@endpush