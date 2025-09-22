@extends('admin.layouts.base')
@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('messages.detail', ['name' => trans_choice('content.contact_us', 1)]),
        'breadcrumbs' => Breadcrumbs::render('admin.contact-us.show'),
    ])

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">

            <!--begin::Basic info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Content-->
                <div id="kt_account_profile_details">

                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">

                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <div class="row mb-5">
                                <div class="col-md-6 fv-row">
                                    <div class="fs-5 fw-bold mb-2">{{ trans_choice('content.name_title', 1) }}
                                    </div>
                                    <div class="fs-5 text-gray-600">{{ $contact_us->name }}</div>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <div class="fs-5 fw-bold mb-2">{{ trans_choice('content.email_title', 1) }}</div>
                                    <div class="fs-5 text-gray-600">{{ $contact_us->email }}</div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 fv-row">
                                    <div class="fs-5 fw-bold mb-2">{{ trans_choice('content.subject_title', 1) }}</div>
                                    <div class="fs-5 text-gray-600">{!! $contact_us->subject !!}</div>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <div class="fs-5 fw-bold mb-2">{{ trans_choice('content.message', 1) }}</div>
                                    <div class="fs-5 text-gray-600">{!! $contact_us->message !!}</div>
                                </div>
                            </div>
                        </div>
                        <!--end::Input group-->

                    </div>
                    <!--end::Card body-->
                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="button" class="btn btn-primary">
                            <a href="{{ route('admin.contact-us.index') }}"
                                class="text-white">{{ __('content.back_title') }}</a>
                        </button>
                    </div>
                    <!--end::Actions-->

                </div>
                <!--end::Content-->
            </div>
            <!--end::Basic info-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
