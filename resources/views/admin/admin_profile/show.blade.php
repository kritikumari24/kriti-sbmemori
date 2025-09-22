@extends('admin.layouts.base')
@section('content')
    @include('admin.layouts.components.header', [
        'title' => trans_choice('header.profile_details', 1),
        'breadcrumbs' => Breadcrumbs::render('admin.profile'),
    ])

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Navbar-->
            @include('admin.admin_profile.navbar')
            <!--end::Navbar-->
            <!-- begin::Basic Info  -->
            <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                {{-- <!--begin::Card header-->
                <div class="card-header cursor-pointer">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('content.profile_details') }}</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header--> --}}
                <!--begin::Card body-->
                <div class="card-body p-9">
                    <!--begin::Row-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-bold text-muted">{{ trans_choice('content.name_title', 1) }}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-dark">{{ $auth_user->name }}</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-bold text-muted">{{ trans_choice('content.email_title', 1) }}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <span class="fw-bold fs-6">{{ $auth_user->email }}</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-bold text-muted">{{ trans_choice('content.phone_title', 1) }}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 d-flex align-items-center">
                            <span class="fw-bolder fs-6 me-2">{{ $auth_user->mobile_no }}</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-bold text-muted">{{ trans_choice('content.role_title', 1) }}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            @if (!empty($auth_user->getRoleNames()))
                                @foreach ($auth_user->getRoleNames() as $v)
                                    <span class="fw-bolder fs-6 text-dark">{{ $v }}</span>
                                @endforeach
                            @endif
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                </div>
                <!--end::Card body-->
            </div>
            <!-- end:Basic Info  -->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
