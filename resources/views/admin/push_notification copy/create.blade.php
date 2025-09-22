{{-- <div class="grid grid-cols-12 gap-6">

    <div class="col-span-12 lg:col-span-12 xxl:col-span-12">

        <div class="grid grid-cols-12 gap-5">

            <div class="col-span-12">

                <div class="box">

                    <div class="p-5">

                        {!! html()->form('POST', route('admin.pushNotifications.store'))->class('form')->id('PushNotificationForm')->attributes([
                                'enctype' => 'multipart/form-data',
                                // 'onsubmit' => 'return checkForm(this);',
                            ])->open() !!}

                        @include('admin.push_notification.form')

                        <div class="grid grid-cols-12 gap-5 mt-6">
                        </div>

                        <div class="text-right mt-6">
                            <div class="mr-6"><button type="button" id="btnClosePopupAdd"
                                    class="button mr-2 bg-theme-1 text-white">
                                    Close</button>

                                <button id="submit_form" type="submit"
                                    class="button w-24 bg-theme-1 text-white">Save</button>
                            </div>
                        </div>
                        {!! html()->form()->close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="d-flex flex-column flex-lg-row mb-17">
    <!--begin::Content-->
    <div class="flex-lg-row-fluid me-0 me-lg-20">

        <!--begin::Form-->
        {!! html()->form('POST', route('admin.pushNotifications.store'))->class('form')->id('PushNotificationForm')->attributes([
                'enctype' => 'multipart/form-data',
                // 'onsubmit' => 'return checkForm(this);',
            ])->open() !!}

        @include('admin.push_notification.form')
        <!--begin::Separator-->
        <div class="separator mb-8"></div>
        <!--end::Separator-->
        <div class="text-end">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="submit_form" type="submit" class="btn btn-primary">Save</button>
        </div>
        <!-- end::Back  -->
        {!! html()->form()->close() !!}
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>

@push('scripts')
    <script>
        $('.addNewModal').click(function() {
            $('#PushNotificationForm').trigger('reset');
            var src = `{{ blankImageUrl() }}`;
            $('#backImage_image').attr('src', src);
            $('#backImage_icon').attr('src', src);
        });
    </script>
@endpush
