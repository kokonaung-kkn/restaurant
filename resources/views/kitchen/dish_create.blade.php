@extends('layouts.master')

@section('content')
<div class="card">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dish Panel</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6 d-flex justify-content-end">
                        <a href="/dish" class="btn btn-success">Back</a>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                Create New Dish
                            </div>
                            <div class="card-body">
                                <form action="/dish" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}">
                                    </div>
                                    @error('name')
                                        <div class="alert alert-info">{{ $message }}</div>
                                    @enderror

                                    <div class="mb-3">
                                        <select name="category" id="" class="form-control @error('category') is-invalid @enderror" value="{{ old('category') }}">
                                                <option value="">Categories</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category')
                                        <div class="alert alert-info">{{ $message }}</div>
                                    @enderror

                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Image</label> <br>
                                        <input name="dishimage" class="@error('dishimage') is-invalid @enderror" type="file" id="formFile">
                                    </div>
                                    @error('dishimage')
                                        <div class="alert alert-info">{{ $message }}</div>
                                    @enderror

                                    <input class="btn btn-primary" type="submit" value="Create">
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
</div>
@endsection