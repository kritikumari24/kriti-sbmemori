<!--begin::Input group-->
<div class="row mb-5">
    <!--begin::Col-->
    <div class="col-md-6 mb-5 fv-row">
        <!--begin::Label-->
        <label class="required fs-5 fw-bold mb-2">{{ trans_choice('content.company_name_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Input-->
        {!! Form::text('data[company_full_name]', isset($company['company_full_name']) ? $company['company_full_name'] : null, ['placeholder' => __('placeholder.company_full_name'), 'class' => 'form-control form-control-solid']) !!}
        <!--end::Input-->
        @if ($errors->has('data.company_full_name'))
            <span style="color:red">{{ $errors->first('data.company_full_name') }}</span>
        @endif
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-md-6 mb-5 fv-row">
        <!--begin::Label-->
        <label class="required fs-5 fw-bold mb-2">{{ trans_choice('content.phone_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Input-->
        {!! Form::text('data[contact_number]', isset($company['contact_number']) ? $company['contact_number'] : null, ['placeholder' => __('placeholder.company_contact_number'), 'class' => 'form-control form-control-solid']) !!}
        <!--end::Input-->
        @if ($errors->has('data.contact_number'))
            <span style="color:red">{{ $errors->first('data.contact_number') }}</span>
        @endif
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-md-12 mb-5 fv-row">
        <!--begin::Label-->
        <label class="required fs-5 fw-bold mb-2">{{ trans_choice('content.address_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Input-->
        {!! Form::textarea('data[address]', isset($company['address']) ? $company['address'] : null, ['placeholder' => __('placeholder.company_address'), 'class' => 'form-control form-control-solid', 'rows' => 5, 'cols' => 15]) !!}
        <!--end::Input-->
        @if ($errors->has('data.address'))
            <span style="color:red">{{ $errors->first('data.address') }}</span>
        @endif
    </div>
    <!--end::Col-->

</div>
<!--end::Input group-->

<!--begin::Separator-->
<div class="separator mb-8"></div>
<!--end::Separator-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\SettingRequest', 'form') !!}
@endpush
