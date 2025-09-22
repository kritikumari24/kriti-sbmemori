<!--begin::Card body-->
<div class="card-body">

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.name_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-4 fv-row">
            {{-- {!! Form::text('name', null, [
                'placeholder' => 'Name',
                'value' => 'Max',
                'class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0',
            ]) !!} --}}

            {!! html()->text('name', old('name'))->attributes([
                    'placeholder' => 'Name',
                    'class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0',
                ]) !!}

        </div>
        <!--end::Col-->
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.email_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-4 fv-row">
            {{-- {!! Form::email('email', null, [
                'placeholder' => 'Email',
                'class' => 'form-control form-control-lg form-control-solid',
            ]) !!} --}}
            {!! html()->email('email', old('email'))->attributes([
                    'placeholder' => 'Email',
                    'class' => 'form-control form-control-lg form-control-solid',
                ]) !!}
        </div>
        <!--end::Col-->

    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.password_title', 1) }}
        </label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-4 fv-row">
            {!! html()->password('password', null)->attributes([
                    'placeholder' => 'Password',
                    'class' => 'form-control form-control form-control-solid',
                ]) !!}

        </div>
        <!--end::Col-->
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">
            <span class="required">{{ trans_choice('content.phone_title', 1) }}</span>
            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                title="Phone number must be active"></i>
        </label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-4 fv-row">
            {{-- {!! Form::tel('mobile_no', null, [
                'placeholder' => 'Contact Number',
                'class' => 'form-control form-control-lg form-control-solid',
            ]) !!} --}}
            {!! html()->text('mobile_no', old('mobile_no'))->attributes([
                    'placeholder' => 'Contact Number',
                    'class' => 'form-control form-control-lg form-control-solid only_number',
                ]) !!}
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{ trans_choice('content.image_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-4">
            @php
                if (isset($customer->image)) {
                    $image = $customer->image;
                } else {
                    $image = blankUserUrl();
                }
            @endphp
            <!--begin::Image input-->
            <div class="image-input image-input-outline" data-kt-image-input="true"
                style="background-image: url('{{ $image }}')">
                <!--begin::Preview existing avatar-->
                <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ $image }}')">
                </div>
                <!--end::Preview existing avatar-->
                <!--begin::Label-->
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                    <i class="bi bi-pencil-fill fs-7"></i>
                    <!--begin::Inputs-->
                    <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                    <!--end::Inputs-->
                </label>
                <!--end::Label-->
            </div>
            <!--end::Image input-->
            <!--begin::Hint-->
            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
            <!--end::Hint-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\CustomerRequest', 'form') !!}
@endpush
