@extends('admin.layouts.base')
@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('messages.edit', ['name' => trans_choice('content.user', 1)]),
        'breadcrumbs' => Breadcrumbs::render('admin.users.edit'),
    ])

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Navbar-->
            @include('admin.user.navbar')
            <!--end::Navbar-->
            <!--begin::Basic info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_profile_details" aria-expanded="true"
                    aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.edit', ['name' => trans_choice('content.user', 1)]) }}
                        </h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_profile_details" class="collapse show">
                    <!--begin::Form-->
                    {!! Form::model($user, [
                        'method' => 'PATCH',
                        'route' => ['admin.users.update', $user->id],
                        'class' => 'form mb-15',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    @include('admin.user.form')

                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <a href="{{ route('admin.users.index') }}"
                            class="btn btn-light btn-active-light-primary me-2 text-black">{{ __('content.back_title') }}</a>
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save
                            Changes</button>
                    </div>
                    <!--end::Actions-->
                    {!! Form::close() !!}
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
