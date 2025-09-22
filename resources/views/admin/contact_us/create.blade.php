@extends('admin.layouts.base')
@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('messages.create', ['name' => trans_choice('content.contact_us', 1)]),
        'breadcrumbs' => Breadcrumbs::render('admin.contact-us.create'),
    ])

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Careers - Apply-->
            <div class="card">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-lg-row">
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid me-0 me-lg-20">

                            <!--begin::Form-->

                            {!! html()->form('POST', route('admin.contact-us.store'))->class('form')->attributes([
                                    'enctype' => 'multipart/form-data',
                                    'onsubmit' => 'return checkForm(this);',
                                ])->open() !!}

                            @include('admin.contact_us.form')
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <a href="{{ route('admin.contact-us.index') }}"
                                    class="btn btn-light btn-active-light-primary me-2 text-black">{{ __('content.back_title') }}</a>
                                <button type="submit" id="submitBtn"
                                    class="btn btn-primary">{{ __('content.create_title') }}</button>
                            </div>
                            <!--end::Actions-->

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
