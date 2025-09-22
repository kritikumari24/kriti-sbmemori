<div class="card-body border-top p-9">

   <!--begin::Input group-->
   <div class="row mb-5">
    <div class="col-md-6 fv-row">
        <div class="fs-5 fw-bold mb-2">{{ trans_choice('content.name_title', 1) }}
        </div>
        <div class="fs-5 text-gray-600">{{ isset($type->name) ? $type->name : 'Na' }}</div>
    </div>
    <div class="col-md-6 fv-row">
        <div class="fs-5 fw-bold mb-2">{{ trans_choice('content.status_title', 1) }}</div>
        <div class="fs-5 text-gray-600">{{ isset($type->is_active) ? getDataStatus($type->is_active) : 'Na' }}</div>
    </div>
</div>
<!--end::Input group-->
</div>
<!--end::Card body-->
<!--begin::Actions-->
<div class="card-footer d-flex justify-content-end py-6 px-9">
    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
        {{ __('content.back_title') }}
    </button>
</div>
<!--end::Actions-->
