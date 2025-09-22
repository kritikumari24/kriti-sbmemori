@extends('admin.layouts.base')
@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('messages.create', ['name' => trans_choice('content.role', 1)]),
        'breadcrumbs' => Breadcrumbs::render('admin.roles.create'),
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
                            <h3 class="fs-2qx fw-bolder mb-3 m">{{ __('messages.list', ['name' => 'Role']) }}</h3>
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
                            {!! html()->form('POST', route('admin.roles.store'))->class('form mb-15')->open() !!}
                            @include('admin.roles.form')
                            <!--begin::Submit-->
                            <button type="submit" class="btn btn-primary">{{ __('content.create_title') }}</button>
                            <!-- end::Submit -->
                            <!-- begin::Back  -->
                            <button type="button" class="btn btn-primary">
                                <a href="{{ route('admin.roles.index') }}"
                                    class="text-white">{{ __('content.back_title') }}</a>
                            </button>
                            <!-- end::Back  -->
                            {!! html()->form()->close() !!}
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
