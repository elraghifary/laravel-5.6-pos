@extends('layouts.master')

@section('title')
    <title>PoS - Show User</title>
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
            <li class="active">Show</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <form role="form" id="form-show-user">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <p class="form-control">{{ $user->name }}</p>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <p class="form-control">{{ $user->email }}</p>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                @foreach ($user->getRoleNames() as $role)
                                    <p class="form-control">{{ $role }}</p>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <p class="form-control">
                                    @if ($user->created_at)
                                        Active
                                    @else
                                        Inactive
                                    @endif
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="created_at">Created At</label>
                                <p class="form-control">{{ $user->created_at }}</p>
                            </div>
                            <div class="form-group">
                                <label for="updated_at">Updated At</label>
                                <p class="form-control">{{ $user->updated_at }}</p>
                            </div>
                            <div class="form-group">
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