@extends('admin.layouts.base')

@section('title')
<title>{{ __('header.setting.edit_setting') }}</title>
@endsection

@section('content')
@include('admin.layouts.components.header', [
'title' => __('header.setting.edit_setting'),
'breadcrumbs' => Breadcrumbs::render('admin.settings.edit_general'),
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
                        <h3 class="fs-2qx fw-bolder mb-3 m">{{ __('header.setting.edit_setting') }}</h3>
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
                        {{-- {!! Form::open([
                                'route' => 'admin.settings.update_general',
                                'method' => 'POST',
                                'class' => 'form mb-15',
                                'enctype' => 'multipart/form-data',
                            ]) !!} --}}
                        <form method="POST" action="{{ route('admin.settings.update_general') }}" enctype="multipart/form-data" class="form mb-15">
                            @csrf

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-md-4 mb-5 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-5 fw-bold mb-2">{{ trans_choice('content.setting.site_name_title', 1) }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    {{-- {!! Form::text('data[site_name]', isset($settings['site_name']) ? $settings['site_name'] : null, [
                                            'placeholder' => __('placeholder.site_name'),
                                            'class' => 'form-control form-control-solid',
                                        ]) !!} --}}
                                    <input type="text" name="data[site_name]" value="{{ old('data.site_name', isset($settings['site_name']) ? $settings['site_name'] : null) }}" placeholder="{{ __('placeholder.site_name') }}" class="form-control form-control-solid" />
                                    <!--end::Input-->
                                    @if ($errors->has('data.site_name'))
                                    <span style="color:red">{{ $errors->first('data.site_name') }}</span>
                                    @endif
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-md-4 mb-5 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-5 fw-bold mb-2">{{ trans_choice('content.setting.copyright_text_title', 1) }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    {{-- {!! Form::text('data[copyright_text]', isset($settings['copyright_text']) ? $settings['copyright_text'] : null, [
                                            'placeholder' => __('placeholder.copyright_text'),
                                            'class' => 'form-control form-control-solid',
                                        ]) !!} --}}
                                    <input type="text" name="data[copyright_text]" value="{{ old('data.copyright_text', isset($settings['copyright_text']) ? $settings['copyright_text'] : null) }}" placeholder="{{ __('placeholder.copyright_text') }}" class="form-control form-control-solid" />
                                    <!--end::Input-->
                                    @if ($errors->has('data.copyright_text'))
                                    <span style="color:red">{{ $errors->first('data.copyright_text') }}</span>
                                    @endif
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-md-4 mb-5 fv-row" style="display: block">
                                    <!--begin::Label-->
                                    <label class="required fs-5 fw-bold mb-2">{{ trans_choice('content.setting.site_mode_title', 1) }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    {{-- {!! Form::select('data[site_mode]', ['en' => 'English', 'la' => 'ພາສາລາວ'], isset($site_mode['site_mode']) ? $site_mode['site_mode'] : null, ['id' => 'site_mode', 'class' => 'form-select form-select-solid', 'placeholder' => __('placeholder.select_language')]) !!} --}}
                                    {{-- {{ Form::select('data[site_mode]', $site_mode, $settings['site_mode'] ?? '' ?: old($settings['site_mode']), ['id' => 'site_mode', 'class' => 'form-select form-select-solid']) }} --}}
                                    <select name="data[site_mode]" id="site_mode" class="form-select form-select-solid">
                                        @foreach ($site_mode as $key => $value)
                                        <option value="{{ $key }}" {{ old('data.site_mode', $settings['site_mode'] ?? '') == $key ? 'selected' : '' }}>
                                            {{ ucfirst($value) }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                    @if ($errors->has('data.site_mode'))
                                    <span style="color:red">{{ $errors->first('data.site_mode') }}</span>
                                    @endif
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-md-4 mb-5 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-5 fw-bold mb-2">{{ trans_choice('content.setting.home_page_title', 1) }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    {{-- {!! Form::text(
                                            'data[home_page_title]',
                                            isset($settings['home_page_title']) ? $settings['home_page_title'] : null,
                                            ['placeholder' => __('placeholder.home_page_title'), 'class' => 'form-control form-control-solid'],
                                        ) !!} --}}
                                    <input type="text" name="data[home_page_title]" value="{{ old('data.home_page_title', isset($settings['home_page_title']) ? $settings['home_page_title'] : null) }}" placeholder="{{ __('placeholder.home_page_title') }}" class="form-control form-control-solid" />
                                    <!--end::Input-->
                                    @if ($errors->has('data.home_page_title'))
                                    <span style="color:red">{{ $errors->first('data.home_page_title') }}</span>
                                    @endif
                                </div>
                                <!--end::Col-->

                                <!--begin::Separator-->
                                <div class="separator mb-8"></div>
                                <!--end::Separator-->

                                {{-- <!--begin::Col-->
                                <div class="col-md-6 mb-5 fv-row">
                                    <!--begin::Label-->
                                    <label
                                        class="required fs-5 fw-bold mb-2">{{ trans_choice('content.setting.phone_title', 1) }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                {!! Form::text('data[contact_number]', isset($settings['contact_number']) ? $settings['contact_number'] : null, ['placeholder' => __('placeholder.company_contact_number'), 'class' => 'form-control form-control-solid']) !!}
                                <!--end::Input-->
                                @if ($errors->has('data.contact_number'))
                                <span style="color:red">{{ $errors->first('data.contact_number') }}</span>
                                @endif
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-md-12 mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="required fs-5 fw-bold mb-2">{{ trans_choice('content.setting.address_title', 1) }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                {!! Form::textarea('data[address]', isset($settings['address']) ? $settings['address'] : null, ['placeholder' => __('placeholder.company_address'), 'class' => 'form-control form-control-solid', 'rows' => 5, 'cols' => 15]) !!}
                                <!--end::Input-->
                                @if ($errors->has('data.address'))
                                <span style="color:red">{{ $errors->first('data.address') }}</span>
                                @endif
                            </div>
                            <!--end::Col--> --}}

                            <!--begin::Separator-->
                            <div class="separator mb-8"></div>
                            <!--end::Separator-->

                            <!--begin::Col-->
                            <div class="col-md-6 mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="required fs-5 fw-bold mb-2">{{ trans_choice('content.setting.logo', 1) }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(dist/media/avatars/blank.png)">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ $logo_img }}')">
                                        </div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Label-->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="data[logo]" accept=".png, .jpg, .jpeg, .svg, .ico" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Image input-->
                                    <!--begin::Hint-->
                                    <div class="form-text">Allowed file types: png, jpg, jpeg, svg, ico.</div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Col-->
                                <!--end::Input-->
                                @if ($errors->has('data.tax'))
                                <span style="color:red">{{ $errors->first('data.tax') }}</span>
                                @endif
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-md-6 mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="required fs-5 fw-bold mb-2">{{ trans_choice('content.setting.favicon', 1) }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(dist/media/avatars/blank.png)">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ $favicon_img }}')">

                                        </div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Label-->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change favicon">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="data[favicon]" accept=".png, .jpg, .jpeg, .svg, .ico" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Image input-->
                                    <!--begin::Hint-->
                                    <div class="form-text">Allowed file types: png, jpg, jpeg, svg, ico.</div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Col-->

                                @if ($errors->has('data.copyright_text'))
                                <span style="color:red">{{ $errors->first('data.copyright_text') }}</span>
                                @endif
                            </div>
                            <!--end::Col-->

                    </div>
                    <!--end::Input group-->

                    <!--begin::Separator-->
                    <div class="separator mb-8"></div>
                    <!--end::Separator-->



                    <!--begin::Submit-->
                    <button type="submit" class="btn btn-primary">{{ __('content.update_title') }}</button>
                    <!-- end::Submit -->
                    {{-- {!! Form::close() !!} --}}
                    </form>
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

@push('scripts')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Admin\SettingRequest', 'form') !!}
@endpush