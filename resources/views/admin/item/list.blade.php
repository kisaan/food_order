@extends('template.master_admin')
@section('title', 'ITEM LIST | '.Config::get('app.name'))
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="card-title mb-0">Items Table</p>
                        <button type="button" class="btn btn-primary"
                            style="background: #4B49AC; border-color: #4B49AC;" data-bs-toggle="modal"
                            data-bs-target="#itemModal">
                            Add +
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="display expandable-table" style="width:100%" id="categoryTable">
                                    <thead>
                                        <tr>
                                            <th>I.No#</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <body>
                                        @foreach($items as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $item->image) }}"
                                                    alt="{{ $item->name }}" style="width: 100px; height: 50px; object-fit: contain;">
                                            </td>

                                            <td>{{$item->category->category}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->description}}</td>
                                            <td>{{$item->price}}</td>
                                            <td>
                                                <a type="button" href="{{ route('item.edit', $item->id) }}" class="btn btn-info btn-rounded btn-icon"
                                                    style="padding: 12px 4px 8px 6px;">
                                                    <i class="ti-eye"></i>
                                                </a>
                                                <form action="{{ route('items.destroy', $item->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-rounded btn-icon"
                                                        onclick="return confirm('Are you sure you want to delete this item?')"
                                                        style="padding: 12px 4px 8px 6px;">
                                                        <i class="ti-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <form id="itemForm" class="forms-sample" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category_id" required>
                            <option value="" disabled selected>Select a category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description"
                            placeholder="Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Price" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Item Image</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="saveItem" class="btn btn-primary">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
@section('additional-scripts')
<script src="{{ asset('js/table.js') }}" defer></script>
<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#saveItem').on('click', function(e) {
        e.preventDefault();

        let formData = new FormData($('#itemForm')[0]);

        $.ajax({
            url: "{{ route('items.store') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                toastr.success(response.message, 'Success');
                $('#itemForm')[0].reset();
                location.reload();
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        toastr.error(value[0], 'Error');
                    });
                } else {
                    toastr.error('Something went wrong. Please try again.', 'Error');
                }
            }
        });
    });
});
</script>
<script>
$(document).ready(function() {
    $('#categoryTable').DataTable();
});
</script>
@endsection
@section('additional-css')
<link href="{{ asset('css/table.css') }}" rel="stylesheet">
@endsection