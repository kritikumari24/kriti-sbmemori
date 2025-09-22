@extends('admin.layouts.base')
@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('messages.detail', ['name' => trans_choice('content.role', 1)]),
        'breadcrumbs' => Breadcrumbs::render('admin.roles.show'),
    ])

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">

            <!--begin::Basic info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_profile_details" aria-expanded="true"
                    aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">
                            {{ __('messages.detail', ['name' => trans_choice('content.role_title', 1)]) }}</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form id="kt_account_profile_details_form" class="form">
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">

                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label
                                    class="col-lg-4 col-form-label required fw-bold fs-6">{{ trans_choice('content.name_title', 1) }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <label
                                        class="col-lg-4 col-form-label fw-bold fs-6 form-control-lg form-control-solid">{{ $role->name }}</label>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label
                                    class="col-lg-4 col-form-label fw-bold fs-6">{{ trans_choice('content.permission_title', 1) }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    @if (!empty($rolePermissions))
                                        @foreach ($rolePermissions as $v)
                                            <label
                                                class="col-lg-4 col-form-label fw-bold badge badge-light fs-6 form-control-lg form-control-solid">{{ $v->name }}</label>
                                        @endforeach
                                    @endif
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                        </div>
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="button" class="btn btn-primary">
                                <a href="{{ route('admin.roles.index') }}"
                                    class="text-white">{{ __('content.back_title') }}</a>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Basic info-->


        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
