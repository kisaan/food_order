@extends('template.master_admin')
@section('title', 'EDIT ITEM | ' . Config::get('app.name'))

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Item</h4>
                    <form action="{{ route('item.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" id="category" name="category_id" required>
                                <option value="" disabled>Select a category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->category }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required>{{ $item->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ $item->price }}" required>
                        </div>

                        <div class="form-group">
                            <label for="image">Item Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <br>
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" style="width: 100px; height: auto;">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Item</button>
                        <a href="{{ route('item.list') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
