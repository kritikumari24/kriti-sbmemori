@extends('admin.layouts.app')

@section('content')
    {{-- <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

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
                    action="{{ route('admin.password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3" style="color: #2fa3b6 !important;">{{ __('Reset Password') }}
                            <!--end::Title-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="form-label fs-6 fw-bolder text-dark">{{ trans_choice('content.login.email', 1) }}
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input id="email" type="email"
                            class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror"
                            name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="form-label fs-6 fw-bolder text-dark">{{ __('Password') }}
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input id="password" type="password"
                            class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="form-label fs-6 fw-bolder text-dark">{{ __('Confirm Password') }}
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input id="password-confirm" type="password" class="form-control form-control-lg form-control-solid"
                            name="password_confirmation" required autocomplete="new-password">
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <div class="text-center">
                        <!--begin::Submit button-->
                        {{-- <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                            <span class="indicator-label">Continue</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button> --}}

                        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                            <span class="indicator-label">{{ __('Reset Password') }}</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Submit button-->
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->

            </div>
            <!--end::Wrapper-->
        </div>
    </div>
@endsection
