<!--begin::Card body-->
<div class="card-body">

    <div class="col-md-12 row">
        <div class="col-md-6">
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-2 col-form-label fw-bold fs-6">{{ trans_choice('content.user_type', 1) }}</label>
                <!--begin::Label-->
                <!--begin::Label-->
                <div class="col-lg-10 fv-row">
                    {!! html()->select('user_type', $roles, isset($userRole) ? $userRole : null)->attributes([
                            'class' => 'form-control form-control-lg form-control-solid',
                            'data-control' => 'select2',
                            'id' => 'user_type',
                        ]) !!}
                </div>
                <!--begin::Label-->
            </div>
            <!--end::Input group-->
        </div>
        <div class="col-md-6">
            <!--begin::Input group-->
            <div class="row mb-6">
                <label class="col-lg-2 col-form-label fw-bold fs-6">{{ trans_choice('content.user_title', 1) }}</label>
                <div class="col-lg-8 fv-row radio-inline">
                    <label class="radio" for="all_user">
                        {!! html()->radio('user', isset($pushNotification->member_type) && $pushNotification->member_type == 1 ? 'checked' : '', 1)->attributes([
                                'id' => 'all_user',
                            ]) !!}
                        All
                        <span></span>
                    </label>&nbsp;
                    <label class="radio" for="individual_user">
                        {!! html()->radio('user', isset($pushNotification->member_type) && $pushNotification->member_type == 0 ? 'checked' : '', 0)->attributes([
                                'id' => 'individual_user',
                            ]) !!}
                        Individual
                        <span></span>
                    </label>
                </div>
            </div>
            <!--end::Input group-->
        </div>
    </div>


    <div class="col-md-12 row">
        <div class="col-md-6">
            <div class="user_select_box">
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label
                        class="col-lg-2 col-form-label fw-bold fs-6">{{ trans_choice('content.select_user', 1) }}</label>
                    <!--begin::Label-->
                    <!--begin::Label-->
                    <div class="col-lg-10 fv-row">
                        {!! html()->select('users[]', [], null)->attributes([
                                'id' => 'user_id',
                                'class' => 'form-control form-control-lg form-control-solid',
                                'data-control' => 'select2',
                                'multiple' => 'multiple',
                                'data-placeholder' => trans_choice('content.select_user', 1),
                            ]) !!}
                    </div>
                    <!--begin::Label-->
                </div>
                <!--end::Input group-->
            </div>
        </div>
        <div class="col-md-6">
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-2 col-form-label fw-bold fs-6">{{ trans_choice('content.link_type', 1) }}</label>
                <!--begin::Label-->
                <!--begin::Label-->
                <div class="col-lg-10 fv-row">
                    {!! html()->select('link_type', $notification_type, null)->attributes([
                            'class' => 'form-control form-control-lg form-control-solid',
                            'data-control' => 'select2',
                        ])->placeholder(__('Select Link Type')) !!}
                </div>
                <!--begin::Label-->
            </div>
            <!--end::Input group-->
        </div>
    </div>

    <div class="col-md-12 row">
        <div class="col-md-6">
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-2 col-form-label fw-bold fs-6">{{ trans_choice('content.title_title', 1) }}</label>
                <!--begin::Label-->
                <!--begin::Label-->
                <div class="col-lg-10 fv-row">
                    {!! html()->text('title', isset($pushNotification->title) ? $pushNotification->title : old('title'))->attributes([
                            'class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0',
                            'id' => 'title',
                            'placeholder' => 'Title',
                            'maxlength' => '40',
                        ]) !!}

                </div>
                <!--begin::Label-->
            </div>
            <!--end::Input group-->
        </div>
        <div class="col-md-6">
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Col-->
                {{-- <div class="col-md-6 fv-row"> --}}
                <!--end::Label-->
                <label
                    class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.direct', 2) }}</label><br>
                <!--end::Label-->
                <div class="col-lg-10 fv-row">
                    {!! html()->checkbox('direct_notification', 1, 1)->attributes([
                            'class' => 'name',
                            'id' => 'direct_notification',
                            'placeholder' => trans_choice('content.direct', 1),
                        ]) !!}
                </div>
                <!--end::Input-->
                {{-- </div> --}}
                <!--end::Col-->
            </div>
            <!--end::Input group-->
        </div>
    </div>

    <div class="col-md-12 row">
        <div class="col-md-6">
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label
                    class="col-lg-2 col-form-label required fw-bold fs-6">{{ trans_choice('content.message', 1) }}</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10 fv-row">
                    {!! html()->textarea('messages', isset($pushNotification->message) ? $pushNotification->message : old('message'))->attributes([
                            'class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0',
                            'id' => 'messages',
                            'placeholder' => 'Messages',
                            'rows' => 15,
                        ]) !!}
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
        </div>
        <div class="col-md-6">
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-2 col-form-label fw-bold fs-6">{{ trans_choice('content.image_title', 1) }}</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-4">
                    @php
                        if (isset($pushNotification->image_url)) {
                            $image = $pushNotification->image_url;
                        } else {
                            $image = blankImageUrl();
                        }
                    @endphp
                    <!--begin::Image input-->
                    <div class="image-input image-input-outline" data-kt-image-input="true"
                        style="background-image: url('{{ $image }}')">
                        <!--begin::Preview existing avatar-->
                        <div class="image-input-wrapper w-125px h-125px"
                            style="background-image: url('{{ $image }}')">
                        </div>
                        <!--end::Preview existing avatar-->
                        <!--begin::Label-->
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                            <i class="bi bi-pencil-fill fs-7"></i>
                            <!--begin::Inputs-->
                            {{-- <input type="file" name="image" accept=".png, .jpg, .jpeg" /> --}}
                            {!! html()->file('image')->attribute('accept', 'image/x-png,image/jpg,image/jpeg,image/png') !!}
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
    </div>

</div>
<!--end::Card body-->

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\PushNotificationRequest', 'form') !!}

    <script>
        $(document).ready(function() {
            console.log($('#user_type').val(), 'asdas');
            // Initialize select2
            var test = $("#user_id").select2({
                ajax: {
                    url: `{{ route('admin.pushNotifications.getByName') }}`,
                    data: function(params) {
                        var query = {
                            search: params.term,
                            user_type: $('#user_type').val(),
                        }

                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    },
                    processResults: function(res) {
                        return {
                            results: $.map(res.data, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.id + ' - ' + obj.text,
                                };
                            })
                        };
                    }
                }
            });
        });
        $(document).on('change', "input[name='user']", function() {
            var user = $(this).val();
            console.log(user);
            if (user == 0) {
                $('.user_select_box').css('display', 'block');
            } else {
                $('.user_select_box').css('display', 'none');
            }
        });
    </script>
@endpush
