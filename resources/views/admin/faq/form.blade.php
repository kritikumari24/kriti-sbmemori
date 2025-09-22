<!--begin::Card body-->
<div class="card-body">
    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label
            class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.question_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row">
            {!! html()->text('question', null)->attributes([
                    'class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0',
                    'required' => 'required',
                ])->placeholder(__('placeholder.question_title')) !!}
        </div>

        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label
            class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.answer_title', 1) }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row">
            {!! html()->textarea('answer', null)->attributes([
                    'class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0',
                    'rows' => 15,
                    'placeholder' => __('placeholder.answer_title'),
                ]) !!}
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\FaqRequest', 'form') !!}
@endpush
