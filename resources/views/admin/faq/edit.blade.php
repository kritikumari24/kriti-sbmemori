@extends('admin.layouts.base')
@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('messages.edit', ['name' => trans_choice('content.faq', 1)]),
        'breadcrumbs' => Breadcrumbs::render('admin.faqs.edit'),
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
                    <div class="d-flex flex-column flex-lg-row mb-17">
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid me-0 me-lg-20">

                            <!--begin::Form-->
                            {!! html()->modelForm($faq, 'PATCH', route('admin.faqs.update', $faq->id))->class('form mb-15')->id('form_editor')->attributes([
                                    'enctype' => 'multipart/form-data',
                                    'onsubmit' => 'return checkForm(this);',
                                ])->open() !!}
                            @csrf
                            <input type="hidden" name="id" value="{{ $faq->id }}">
                            @include('admin.faq.form')

                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <a href="{{ route('admin.faqs.index') }}"
                                    class="btn btn-light btn-active-light-primary me-2 text-black">{{ __('content.back_title') }}</a>
                                <button type="submit" id="submitBtn" class="btn btn-primary">Save
                                    Changes</button>
                            </div>
                            <!--end::Actions-->
                            {!! html()->closeModelForm() !!}
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
