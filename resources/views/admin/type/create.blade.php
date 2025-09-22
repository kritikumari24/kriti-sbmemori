<div class="card-body">
    <!--begin::Layout-->
    <div class="d-flex flex-column flex-lg-row mb-17">
        <!--begin::Content-->
        <div class="flex-lg-row-fluid me-0 me-lg-20" style="margin-right: 0px !important;">

            <!--begin::Form-->
            {!! html()->form('POST', route('admin.types.store'))->class('form mb-15')->id('TypeForm')->attributes(['enctype' => 'multipart/form-data'])->open() !!}

            @include('admin.type.form')
            <!--begin::Submit-->
            <button type="submit" class="btn btn-primary">{{ __('content.create_title') }}</button>
            <!-- end::Submit -->
            <!-- begin::Back  -->
            <button type="button" class="btn btn-primary" id="btnClosePopupAdd">
                {{ __('content.back_title') }}
            </button>
            <!-- end::Back  -->
            {!! html()->form()->close() !!}
            <!--end::Form-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Layout-->
</div>
