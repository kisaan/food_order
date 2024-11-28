@extends('template.master_user')
@section('title', 'HOME | '.Config::get('app.name'))
@section('content')
<div class="restbeef_main_wrapper">
    <div class="restbeef_container">
        <div class="restbeef_content_wrapper restbeef_no_sidebar">
            <!-- Content Inner -->
            <div class="restbeef_content">
                <div class="restbeef_tiny">
                    <!-- Recent Products Block -->
                    <div class="restbeef_block restbeef_js_margin" data-margin="-20px 0 99px 0">
                        <h3 class="align_center restbeef_js_padding" data-padding="0 0 15px 0">
                            <span class="restbeef_up_title">Freshly Taste</span>
                            New n our Menu
                        </h3>
                        <div class="filter_section">
                            <form action="{{ route('items.search') }}" method="GET">
                                <select name="category" onchange="this.form.submit()">
                                    <option value="all">All Categories</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category }}
                                    </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <div class="restbeef_block_inner">
                            <div class="restbeef_recent_products restbeef_grig_3columns">
                                @foreach($items as $item)
                                <div class="restbeef_recent_product">
                                    <div class="restbeef_recent_product_image">
                                        <a href="{{ route('item.details', $item->id) }}">
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{$item->name}}" />
                                        </a>
                                    </div>
                                    <div class="restbeef_recent_product_content">
                                        <div class="restbeef_recent_product_price">
                                            <span>${{$item->price}}</span>
                                        </div>
                                        <h4>
                                            <span class="restbeef_up_title">
                                                {{$item->category->category}}
                                            </span>
                                            <a href="{{ route('item.details', $item->id) }}">{{$item->name}}</a>
                                        </h4>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="pagination">
                                {{ $items->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('additional-scripts')
@endsection
@section('additional-css')
<style>
.filter_section {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding: 10px;
}

.filter_section select {
    padding: 5px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.restbeef_select {
    width: 150px;
}

.select-options {
    width: 150px;
}
</style>
@endsection