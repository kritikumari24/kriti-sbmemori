@extends('admin.layouts.app')

@section('content')
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-column-fluid position-x-center bgi-no-repeat bgi-size-cover bgi-attachment-fixed"
        style="background-size1: 100% 50%; background-image: url({{ asset('admin/dist/media/illustrations/bg-login.jpg') }})">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
            <a href="javascript:void(0)" class="mb-12">
                <img alt="Logo"
                    src="{{ isset($global_setting_data['logo']) ? asset('files/settings/' . $global_setting_data['logo'] . '') : asset('admin/dist/media/logos/favicon.ico') }}"
                    class="h-55px logo" />
            </a>
            <!--end::Logo-->
            <!--begin::Wrapper-->
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                {{-- @dd(session()->all()) --}}
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('errors'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('errors') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger text-center">{{ session()->get('error') }}</div>
                @endif
                @if (session()->has('warning'))
                    <div class="alert alert-danger text-center">{{ session()->get('error') }}</div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success text-center">{{ session()->get('success') }}</div>
                @endif
                <!--begin::Form-->
                <form class="form w-100" novalidate="novalidate" method="POST"
                    action="{{ route('admin.password.email') }}">
                    @csrf
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3" style="color: #2fa3b6 !important;">Forget Password
                            <!--end::Title-->
                            <!--begin::Link-->
                            {{-- <div class="text-gray-400 fw-bold fs-4">New Here?
                        <a href="{{ route('register') }}" class="link-primary fw-bolder">Create an Account</a>
                    </div> --}}
                            <!--end::Link-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="form-label fs-6 fw-bolder text-dark">{{ trans_choice('content.login.email', 1) }}
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-lg form-control-solid" type="text" name="email"
                            autocomplete="on" value="admin@gmail.com" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <div class="text-center">
                        <!--begin::Submit button-->
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                            <span class="indicator-label">Continue</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Submit button-->
                        {{-- <!--begin::Separator-->
                    <div class="text-center text-muted text-uppercase fw-bolder mb-5">or</div>
                    <!--end::Separator-->
                    <!--begin::Google link-->
                    <a href="javascript:void(0)" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
                        <img alt="Logo" src="{{ asset('admin/dist/media/svg/brand-logos/google-icon.svg') }}"
                            class="h-20px me-3" />Continue
                        with Google</a>
                    <!--end::Google link-->
                    <!--begin::Google link-->
                    <a href="javascript:void(0)" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
                        <img alt="Logo" src="{{ asset('admin/dist/media/svg/brand-logos/facebook-4.svg') }}"
                            class="h-20px me-3" />Continue with Facebook</a>
                    <!--end::Google link-->
                    <!--begin::Google link-->
                    <a href="javascript:void(0)" class="btn btn-flex flex-center btn-light btn-lg w-100">
                        <img alt="Logo" src="{{ asset('admin/dist/media/svg/brand-logos/apple-black.svg') }}"
                            class="h-20px me-3" />Continue with Apple</a>
                    <!--end::Google link--> --}}
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->

            </div>
            <!--end::Wrapper-->
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\LoginRequest', 'form') !!}
@endpush
