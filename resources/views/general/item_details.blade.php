@extends('template.master_user')
@section('title', 'ITEM DETAILS | '.Config::get('app.name'))
@section('content')
<div class="restbeef_main_wrapper">
    <div class="restbeef_container">
        <div class="restbeef_content_wrapper restbeef_no_sidebar">

            <div class="restbeef_content">
                <div class="restbeef_tiny">

                    <div class="restbeef_block restbeef_poduct_summary restbeef_js_margin" data-margin="0 0 80px 0">
                        <div class="restbeef_block_inner">
                            <div class="row">
                                <div class="col-6">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{$item->name}}" />
                                </div>
                                <div class="col-6">
                                    <div class="restbeef_poduct_summary_content align_center">
                                        <h2>
                                            <span class="restbeef_up_title">{{$item->category->category}}</span>
                                            Item Info
                                        </h2>
                                        <div class="restbeef_poduct_description">
                                            <h5>{{$item->name}}</h5>
                                            <p> {{$item->description}}</p>
                                            <h6> ${{$item->price}}<h6>
                                        </div>
                                    </div>
                                </div>
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
@endsection