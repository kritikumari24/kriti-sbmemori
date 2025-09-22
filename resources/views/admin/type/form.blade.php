<!--begin::Input group-->
<div class="row mb-5">
    <!--begin::Col-->
    <div class="col-md-6 fv-row">
        <!--begin::Label-->
        <label class="required fs-5 fw-bold mb-2">{{ trans_choice('content.name_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Input-->
        {!! html()->text('name', null)->attributes([
            'placeholder' => trans_choice('content.name_title', 1),
            'class' => 'form-control form-control-lg form-control-solid',
        ]) !!}
        <!--end::Input-->
        @if ($errors->has('name'))
            <span style="color:red">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-md-6 fv-row">
        <!--begin::Label-->
        <label class="required fs-5 fw-bold mb-2">{{ trans_choice('content.is_active', 1) }}</label>
        <!--end::Label-->
        <!--begin::Input-->
        {!! html()->select('is_active', getDataStatus(), isset($type->is_active) ? $type->is_active : [])->attributes([
            'class' => 'form-control form-control-lg form-control-solid',
        ]) !!}
        <!--end::Input-->
        @if ($errors->has('is_active'))
            <span style="color:red">{{ $errors->first('is_active') }}</span>
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
    {!! JsValidator::formRequest('App\Http\Requests\Admin\TypeRequest', 'form') !!}
@endpush
