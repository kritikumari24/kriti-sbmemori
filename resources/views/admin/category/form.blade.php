<!--begin::Input group-->
<div class="row mb-5">
    <!--begin::Col-->
    <div class="col-md-6 fv-row">
        <!--begin::Label-->
        <label class="required fs-5 fw-bold mb-2">{{ trans_choice('content.name_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Input-->
        {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control form-control-solid']) !!}
        <!--end::Input-->
        @if ($errors->has('name'))
            <span style="color:red">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-md-6 fv-row">
        <!--end::Label-->
        <label class="required fs-5 fw-bold mb-2">{{ trans_choice('content.description_title', 1) }}</label>
        <!--end::Label-->
        <!--end::Input-->
        {!! Form::textarea('description', null, [
            'placeholder' => 'Description',
            'class' => 'form-control form-control-solid',
            'rows' => 2,
            'cols' => 40,
        ]) !!}
        <!--end::Input-->
    </div>
    <!--end::Col-->

</div>
<!--end::Input group-->

<!--begin::Input group-->
<div class="d-flex flex-column mb-5 fv-row">
    <!--begin::Label-->
    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
        <span class="required">{{ trans_choice('content.image_title', 1) }}</span>
        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Select Category Image"></i>
    </label>
    <!--end::Label-->
    <!--begin::Select-->
    {!! Form::file('image', null, ['placeholder' => 'Upload Image', 'class' => 'form-control form-control-solid']) !!}
    <!--end::Select-->
</div>
<!--end::Input group-->

<!--begin::Separator-->
<div class="separator mb-8"></div>
<!--end::Separator-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\CategoryRequest', 'form') !!}
@endpush
