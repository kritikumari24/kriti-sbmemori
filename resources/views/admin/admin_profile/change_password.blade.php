@extends('admin.layouts.base')
@section('content')
    @include('admin.layouts.components.header', [
        'title' => trans_choice('content.change_password', 1),
        'breadcrumbs' => Breadcrumbs::render('admin.change-password'),
    ])

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Navbar-->
            @include('admin.admin_profile.navbar')
            <!--end::Navbar-->
            <!-- begin::Basic Info  -->
            <!--begin::Careers - Apply-->
            <div class="card">
                <!--begin::Body-->
                <div class="card-body p-lg-17">
                    <!--begin::Hero-->
                    {{-- <div class="position-relative mb-17">
                        <!--begin::Overlay-->
                        <div class="overlay overlay-show">
                            <!--begin::Title-->
                            <h3 class="fs-2qx fw-bolder mb-3 m">
                                {{ trans_choice('content.change_password', 1) }}
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Overlay-->
                    </div> --}}
                    <!--end::-->
                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-lg-row mb-17">
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid me-0 me-lg-20">

                            <!--begin::Form-->
                            {!! html()->modelForm([], 'PUT', route('admin.update.password', ['user' => $auth_user->id]))->class('form mb-15')->attributes([
                                    'enctype' => 'multipart/form-data',
                                    'files' => true,
                                    'role' => 'form',
                                    'id' => 'adminForm',
                                ])->open() !!}
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-md-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-5 fw-bold mb-2">{{ __('content.old_password_title') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    {!! html()->password('old_password', null)->attributes([
                                            'placeholder' => __('placeholder.enter_old_password'),
                                            'class' => 'form-control',
                                            'id' => 'old_password',
                                        ]) !!}
                                    @if ($errors->has('old_password'))
                                        <span
                                            class="error invalid-feedback d-block">{{ $errors->first('old_password') }}</span>
                                    @endif
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-md-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-5 fw-bold mb-2">{{ __('content.password_title') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    {!! html()->password('password', null)->attributes([
                                            'placeholder' => __('placeholder.enter_new_password'),
                                            'class' => 'form-control',
                                            'id' => 'password',
                                        ]) !!}
                                    @if ($errors->has('password'))
                                        <span class="error invalid-feedback d-block">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-8 fv-row">
                                    <!--begin::Label-->
                                    <label
                                        class="required fs-5 fw-bold mb-2">{{ __('content.confirm_password_title') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    {!! html()->password('confirm_password', null)->attributes([
                                            'placeholder' => __('placeholder.enter_confirm_password'),
                                            'class' => 'form-control',
                                            'id' => 'confirm_password',
                                        ]) !!}
                                    @if ($errors->has('confirm_password'))
                                        <span
                                            class="error invalid-feedback d-block">{{ $errors->first('confirm_password') }}</span>
                                    @endif
                                </div>
                            </div>

                            <!--end::Input group-->
                            <!--begin::Submit-->
                            <button type="submit" class="btn btn-primary">{{ __('content.create_title') }}</button>
                            <!-- end::Submit -->
                            <!-- begin::Back  -->
                            <button type="button" class="btn btn-primary">
                                <a href="{{ route('admin.dashboard') }}"
                                    class="text-white">{{ __('content.back_title') }}</a>
                            </button>
                            <!-- end::Back  -->
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
            <!-- end:Basic Info  -->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\AdminChangePasswordRequest', 'form') !!}
@endpush
