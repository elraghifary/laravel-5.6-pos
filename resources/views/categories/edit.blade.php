@extends('layouts.master')

@section('title')
    <title>PoS - Edit Category</title>
@endsection

@push('styles')
    <style type="text/css">
        .error { color: #dd4b39 !important; }
    </style>
@endpush

@section('content')
    <section class="content-header">
        <h1>Category<small>data</small></h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('category.index') }}"><i class="fa fa-file-text"></i> Category</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">  
                        <form role="form" action="{{ route('category.update', $category->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="name">Category</label>
                                <input type="text" 
                                name="name"
                                value="{{ $category->name }}" 
                                class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ $category->description }}</textarea>
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
            $("#category").validate({
                rules: {
                    name: {
                        required: true,
                        lettersonly: true
                    }
                },
                messages: {
                    name: {
                        required: "Kolom ini tidak boleh kosong."
                    }
                }
            });

            jQuery.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            }, "Silahkan masukkan huruf dan spasi saja.");

            $('#category').on('submit', function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('category.store') }}",
                    type: "POST",
                    data: {
                        name: $('#name').val(),
                        description: $('#description').val()
                    },
                    dataType: "json",
                    success: function(result) {
                        $('.alert').show();
                        $('.alert').html(result.success);
                    }
                });
            });
        });
    </script>
@endpush