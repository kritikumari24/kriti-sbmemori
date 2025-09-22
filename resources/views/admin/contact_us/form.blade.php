<!--begin::Card body-->
<div class="card-body">
    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{ trans_choice('content.user_title', 1) }}</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-10 fv-row">
            {!! html()->select('user_id', $users, isset($contact_us->user_id) ? $contact_us->user_id : null)->attributes([
                    'class' => 'form-control form-control-lg form-control-solid',
                    'data-control' => 'select2',
                    'id' => 'user_id',
                ])->placeholder(__('Select User')) !!}
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.name_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row">
            {!! html()->text('name', null)->attributes([
                    'class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0',
                    'required' => 'required',
                ])->placeholder(__('placeholder.name_title')) !!}
        </div>

        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.email_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row">
            {!! html()->email('email', null)->attributes([
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
        <label class="col-lg-2 col-form-label fw-bold fs-6">
            <span class="required">{{ trans_choice('content.phone_title', 1) }}</span>
            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                title="Phone number must be active"></i>
        </label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row">
            {!! html()->text('mobile_no', null)->attributes([
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
        <label
            class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.subject_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row">
            {!! html()->text('subject', null)->attributes([
                    'class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0',
                    'required' => 'required',
                ])->placeholder(__('placeholder.subject_title')) !!}
        </div>

        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.message', 1) }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row">
            {!! html()->textarea('message', null)->attributes([
                    'class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0',
                    'rows' => 15,
                    'placeholder' => __('placeholder.message'),
                ]) !!}
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\ContactUsRequest', 'form') !!}
@endpush
