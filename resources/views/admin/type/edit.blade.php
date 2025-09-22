<div class="card">
    <!--begin::Body-->
    <div class="card-body p-lg-17">
        <!--begin::Layout-->
        <div class="d-flex flex-column flex-lg-row mb-17">
            <!--begin::Content-->
            <div class="flex-lg-row-fluid me-0 me-lg-20">

                <!--begin::Form-->
                {!! html()->modelForm($type, 'PATCH', route('admin.types.update', $type->id))->class('form mb-15')->id('TypeFormUpdate')->attributes(['enctype' => 'multipart/form-data'])->open() !!}
                @csrf
                <input type="hidden" id="modal_id" name="id" value="{{ $type->id }}">
                @include('admin.type.form')
                <!--begin::Submit-->
                <button type="submit" class="btn btn-primary" id="update_form">{{ __('content.update_title') }}</button>
                <!-- end::Submit -->
                <!-- begin::Back  -->
                <button type="button" class="btn btn-primary" id="btnClosePopupEdit">

                    {{ __('content.back_title') }}
                </button>
                <!-- end::Back  -->
                {!! html()->closeModelForm() !!}
                <!--end::Form-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Layout-->
    </div>
    <!--end::Body-->
</div>
<!--end::Careers - Apply-->
