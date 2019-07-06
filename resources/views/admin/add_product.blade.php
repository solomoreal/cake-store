@extends('layouts.main1')
@section('content')

    <div class="main-content">
    <a href="{{route('categories.index')}}" class="btn btn-success">Create New Category</a>
        <div class="container">
            <div class="row mt-3">
                <div class="col-sm-4">
                <form action="{{route('admin.store')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="productCoverImage">Add Cover Image for Product </label>
                            <input type="file" name="image" class="form-control-file" id="productCoverImage">
                        </div>
            </div>
            
                <div class="form-row mt-3">
                    <div class="form-group col-md-5">
                        <label for="inputEmail4">Cake Name</label>
                        <input type="text" class="form-control" name="title" id="inputEmail4" placeholder="Enter Product Name">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="inputPassword4">Price</label>
                        <input type="text" class="form-control" name="price" id="inputPassword4" placeholder="Enter Product Price">
                    </div>
                </div>
                <div class="form-row mt-3">
                    <div class="form-group col-md-7 mr-1">
                        <label for="category">Category</label>
                        <select id="category" class="form-control" name="category_id">
                            <option selected>No Category Selected</option>
                            @if(count($categories) > 0)
                            @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                            @endif
                        </select>
                <button type="submit" class="btn btn-primary mt-5">Add Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
    
    