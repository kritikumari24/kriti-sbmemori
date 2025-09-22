@extends('admin.layouts.base')

@section('title')
    <title>{{ __('header.edit_setting') }}</title>
@endsection

@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('header.edit_setting'),
        'breadcrumbs' => Breadcrumbs::render(),
    ])

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Careers - Apply-->
            <div class="card">
                <!--begin::Body-->
                <div class="card-body p-lg-17">
                    <!--begin::Hero-->
                    <div class="position-relative mb-17">
                        <!--begin::Overlay-->
                        <div class="overlay overlay-show">
                            <!--begin::Title-->
                            <h3 class="fs-2qx fw-bolder mb-3 m">{{ __('header.edit_setting') }}</h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Overlay-->
                    </div>
                    <!--end::-->
                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-lg-row mb-17">
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid me-0 me-lg-20">
                            <!--begin::Form-->
                            {!! Form::open([
                                'route' => 'admin.settings.update_general',
                                'method' => 'POST',
                                'class' => 'form mb-15',
                                'enctype' => 'multipart/form-data',
                            ]) !!}
                            @csrf
                            @include('admin.setting.form')
                            <!--begin::Submit-->
                            <button type="submit" class="btn btn-primary">{{ __('content.update_title') }}</button>
                            <!-- end::Submit -->
                            {!! Form::close() !!}
                            <!--end::Form-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Layout-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Careers - Apply-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
