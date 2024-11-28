@extends('template.master_admin')
@section('title', 'UPDATE CATEGORY | '.Config::get('app.name'))
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Category</h4>
                    <p class="card-description">
                        Food category
                    </p>
                    <form class="forms-sample" method="post" action="{{ route('category.update',$category->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleInputName1">Category Name</label>
                            <input type="text" name="category" class="form-control" id="exampleInputName1"
                                placeholder="Name" value="{{ $category->category }}" Required>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('additional-scripts')
@endsection
@section('additional-css')
@endsection