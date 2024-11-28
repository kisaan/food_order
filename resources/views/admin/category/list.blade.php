@extends('template.master_admin')
@section('title', 'CATEGORY LIST | '.Config::get('app.name'))
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="card-title mb-0">Category Table</p>
                        <button type="button" class="btn btn-primary"
                            style="background: #4B49AC; border-color: #4B49AC;" data-bs-toggle="modal"
                            data-bs-target="#categoryModal">
                            Add +
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="display expandable-table" style="width:100%" id="categoryTable">
                                    <thead>
                                        <tr>
                                            <th>C.No#</th>
                                            <th>Category Name</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $category)
                                        <tr>
                                            <td>{{$category->id}}</td>
                                            <td>{{$category->category}}</td>
                                            <td class="text-center">
                                                <a type="button" href="{{ route('category.edit', $category->id) }}"
                                                    class="btn btn-info btn-rounded btn-icon"
                                                    style="padding: 12px 4px 8px 6px;">
                                                    <i class="ti-eye"></i>
                                                </a>
                                                <form action="{{ route('categories.destroy', $category->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-rounded btn-icon"
                                                        onclick="return confirm('Are you sure you want to delete this category?')"
                                                        style="padding: 12px 4px 8px 6px;">
                                                        <i class="ti-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Create -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <form id="categoryForm" class="forms-sample">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category">Category Name</label>
                        <input type="text" class="form-control" id="category" placeholder="Category Name" require>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveCategory">Save</button>
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
    $('#categoryTable').DataTable();
});
</script>
<script>
$(document).ready(function() {
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
    };

    $('#saveCategory').click(function(e) {
        e.preventDefault();

        let categoryName = $('#category').val();

        $.ajax({
            url: "{{ route('categories.store') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                category: categoryName
            },
            success: function(response) {
                toastr.success(response.message, 'Success');
                $('#categoryForm')[0].reset();
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
@endsection
@section('additional-css')
<link href="{{ asset('css/table.css') }}" rel="stylesheet">
@endsection