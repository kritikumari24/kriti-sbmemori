@if (isset($pushNotification))
    <input type="hidden" id="modal_id" name="id" value="{{ $pushNotification->id }}">
    <input type="hidden" id="method" name="method" value="PUT">
@endif
@php
    $notification_type = [
        'loginScreen' => 'LoginScreen',
        'profileDetailScreen' => 'ProfileDetailScreen',
        'referCodeScreen' => 'ReferCodeScreen',
        'homeScreen' => 'HomeScreen',
        'stoneScreen' => 'StoneScreen',
        'numberScreen' => 'NumberScreen',
        'colorScreen' => 'ColorScreen',
        'chakraScreen' => 'ChakraScreen',
        'kundliScreen' => 'KundliScreen',
        'gocharScreen' => 'GocharScreen',
        'showPlanetryScreen' => 'ShowPlanetryScreen',
        'gurujiScreen' => 'GurujiScreen',
        'gurujiProfileScreen' => 'GurujiProfileScreen',
        'chatScreen' => 'ChatScreen',
        'reviewAndRatingScreen' => 'ReviewAndRatingScreen',
        'chatHistoryScreen' => 'ChatHistoryScreen',
        'milestoneScreen' => 'MilestoneScreen',
        'rewardPointsScreen' => 'RewardPointsScreen',
        'referralHistoryScreen' => 'ReferralHistoryScreen',
        'settingScreen' => 'SettingScreen',
        'pageContentScreen' => 'PageContentScreen',
        'notificationScreen' => 'NotificationScreen',
        'tarotScreen' => 'TarotScreen',
        'tarotReadingScreen' => 'TarotReadingScreen',
        'walletScreen' => 'WalletScreen',
    ];
    $roles = Spatie\Permission\Models\Role::whereNotIn('name', ['Admin', 'Admin'])->pluck('name', 'name');
    $userRole = $auth_user->roles->pluck('name', 'name');
@endphp
<div class="grid grid-cols-12 gap-5 mt-5">
    <div class="col-span-12 form-group xl:col-span-6">
        <label class="required">{{ trans_choice('content.user_type', 1) }}</label>
        {!! html()->select('user_type', $roles, isset($userRole) ? $userRole : [])->attributes([
                'class' => 'input w-full border bg-gray-100 mt-2',
                'data-control' => 'select2',
                'id' => 'user_type',
                'placeholder' => trans_choice('content.user_type', 1),
            ]) !!}
    </div>
    <div class="col-span-12 form-group xl:col-span-6">
        <label class="required">{{ trans_choice('content.user_title', 1) }}</label>
        <div class="flex flex-col sm:flex-row mt-2">
            <div class="form-check mr-2">
                {{-- {!! Form::radio('user', 1, null, ['id' => 'all_user', 'class' => 'form-check-input']) !!} --}}

                {!! html()->radio('user', 1, null)->attributes([
                        'id' => 'all_user',
                        'class' => 'form-check-input',
                    ]) !!}
                <label class="form-check-label mr-3" for="all_user">All</label>

                {{-- {!! Form::radio('user', 0, null, ['id' => 'individual_user', 'class' => 'form-check-input', 'checked' => true]) !!} --}}

                {!! html()->radio('user', 0, null)->attributes([
                        'id' => 'individual_user',
                        'class' => 'form-check-input',
                        'checked' => true,
                    ]) !!}
                <label class="form-check-label" for="individual_user">Individual</label>
            </div>
        </div>
    </div>
    <div class="col-span-12 user_select_box form-group xl:col-span-6" style="display: block">
        <label class="required">{{ trans_choice('content.select_user', 1) }}</label>
        <div class="col-span-12 xl:col-span-6">
            {{-- {!! Form::select('users[]', [], null, [
                'id' => 'user_id',
                'class' => 'input w-full border bg-gray-100 mt-2 select2',
                'multiple' => 'multiple',
                'data-placeholder' => trans_choice('content.select_user', 1),
            ]) !!} --}}

            {!! html()->select('users[]', [], null)->attributes([
                    'id' => 'user_id',
                    'class' => 'input w-full border bg-gray-100 mt-2 select2',
                    'multiple' => 'multiple',
                    'data-placeholder' => trans_choice('content.select_user', 1),
                ]) !!}
            <div class="mt-2">
                @if ($errors->has('users'))
                    <div class="pristine-error text-theme-6 mt-2">{{ $errors->first('users') }}</div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-span-12 xl:col-span-6">
        <label>Link Type</label>
        {{-- {!! Form::select('link_type', $notification_type, null, [
            'class' => 'input w-full border bg-gray-100 mt-2',
            'id' => 'link_type',
            'placeholder' => __('Select Link Type'),
        ]) !!} --}}
        {!! html()->select('link_type', $notification_type, null)->attributes([
                'class' => 'input w-full border bg-gray-100 mt-2',
                'id' => 'link_type',
                'placeholder' => __('Select Link Type'),
            ]) !!}
        @if ($errors->has('image'))
            <div class="pristine-error text-theme-6 mt-2">{{ $errors->first('image') }}</div>
        @endif
    </div>
    {{-- <div class="col-span-12 xl:col-span-6">
        <label>Link Id</label>

        {!! Form::select('link_id', [], null, [
            'class' => 'input w-full border bg-gray-100 mt-2',
            'id' => 'link_id',
            'placeholder' => __('Select Link Id'),
        ]) !!}
        @if ($errors->has('link_id'))
            <div class="pristine-error text-theme-6 mt-2">
                {{ $errors->first('link_id') }}
            </div>
        @endif
    </div> --}}
    <div class="col-span-12 form-group xl:col-span-6 position: relative">
        <label class="required">{{ trans_choice('content.title', 1) }}</label>
        {{-- {!! Form::text('title', isset($pushNotification) ? $pushNotification->title : old('title'), [
            'class' => 'input w-full border bg-gray-100 mt-2',
            'id' => 'title',
            'placeholder' => 'Title',
            'maxlength' => '40',
        ]) !!} --}}

        {!! html()->text('title', isset($pushNotification) ? $pushNotification->title : old('title'))->attributes([
                'class' => 'input w-full border bg-gray-100 mt-2',
                'id' => 'title',
                'placeholder' => 'Title',
                'maxlength' => '40',
            ]) !!}
    </div>
    {{-- <div class="col-span-12 form-group xl:col-span-4">
        <label class="">{{ trans_choice('content.notification_time', 1) }}</label>
        {{ Form::input('dateTime-local', 'notification_time', null, ['id' => 'notification_time', 'class' => 'input w-full border bg-gray-100 mt-2']) }}
    </div> --}}
    <div class="col-span-12 hidden form-group xl:col-span-2">
        <label class="">{{ trans_choice('content.direct', 1) }}</label>
        {{-- {!! Form::checkbox('direct_notification', 1, 1, [
            'class' => 'input w-full border bg-gray-100 mt-2 ',
            'id' => 'direct_notification',
            'placeholder' => trans_choice('content.direct', 1),
        ]) !!} --}}

        {!! html()->checkbox('direct_notification', 1, 1)->attributes([
                'class' => 'input w-full border bg-gray-100 mt-2 ',
                'id' => 'direct_notification',
                'placeholder' => trans_choice('content.direct', 1),
            ]) !!}
    </div>
    <div class="col-span-12 form-group xl:col-span-6">
        <label class="required">{{ trans_choice('content.message', 1) }} </label>
        {{-- {!! Form::textarea('messages', isset($pushNotification) ? $pushNotification->messages : old('messages'), [
            'class' => 'input w-full border bg-gray-100 mt-2',
            'id' => 'messages',
            'placeholder' => 'Messages',
            'rows' => '3',
        ]) !!} --}}

        {!! html()->textarea('messages', isset($pushNotification) ? $pushNotification->messages : old('messages'))->attributes([
                'class' => 'input w-full border bg-gray-100 mt-2',
                'id' => 'messages',
                'placeholder' => 'Messages',
                'rows' => '3',
            ]) !!}

    </div>
</div>
<div class="grid grid-cols-12 gap-5 mt-5">

    <div class="col-span-12 xl:col-span-4">
        <label class="">Image</label>
        {{-- {!! Form::file('image', [
            'class' => 'input w-full border bg-gray-100 mt-2',
            'id' => 'image',
            'onchange' => 'readURL(this, image);',
            'accept' => 'image/x-png,image/jpg,image/jpeg,image/png',
            'placeholder' => __('Upload Image '),
        ]) !!} --}}

        {!! html()->file('image')->class('input w-full border bg-gray-100 mt-2')->id('image')->attribute('onchange', 'readURL(this, image);')->attribute('accept', 'image/x-png,image/jpg,image/jpeg,image/png') !!}
    </div>
    <div class="col-span-12 xl:col-span-2 mt-4">
        @if (isset($pushNotification->image))
            <img id="backImage_image" height="100px" width="100px" src="{{ $pushNotification->image }}" title="Image">
        @else
            <img id="backImage_image" height="100px" width="100px" src="{{ blankImageUrl() }}" title="Image">
        @endif
    </div>
    {{-- <div class="col-span-12 xl:col-span-4">
            <label class="">Icon</label>
            {!! Form::file('icon', [
                'class' => 'input w-full border bg-gray-100 mt-2',
                'id' => 'icon',
                'onchange' => 'readURL(this, icon);',
                'accept' => 'image/x-png,image/jpg,image/jpeg,image/png',
                'placeholder' => __('Upload Icon '),
            ]) !!}
        </div>
        <div class="col-span-12 xl:col-span-2 mt-4">
            @if (isset($pushNotification->icon))
                <img id="backImage_icon" height="100px" width="100px"
                    src="{{ $pushNotification->icon }}" title="icon">
            @else
                <img id="backImage_icon" height="100px" width="100px" src="{{ blankImageUrl() }}"
                    title="Image">
            @endif
        </div> --}}
</div>

<!--begin::Card body-->
<div class="card-body border-top p-9">
    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label fw-bold fs-6">{{ trans_choice('content.user_type', 1) }}</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8 fv-row">
            {!! html()->select('user_type', $roles, isset($userRole) ? $userRole : [])->attributes([
                    'class' => 'input w-full border bg-gray-100 mt-2',
                    'data-control' => 'select2',
                    'id' => 'user_type',
                    'placeholder' => trans_choice('content.user_type', 1),
                ]) !!}
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label fw-bold fs-6">{{ trans_choice('content.user_title', 1) }}</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8 fv-row">
            {!! html()->radio('user', 1, null)->attributes([
                    'id' => 'all_user',
                    'class' => 'form-check-input',
                ]) !!}
            <label class="form-check-label mr-3" for="all_user">All</label>
            {!! html()->radio('user', 0, null)->attributes([
                    'id' => 'individual_user',
                    'class' => 'form-check-input',
                    'checked' => true,
                ]) !!}
            <label class="form-check-label" for="individual_user">Individual</label>
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label fw-bold fs-6">{{ trans_choice('content.user_type', 1) }}</label>
        <!--begin::Label-->
        <div class="col-lg-8 fv-row">
            {!! html()->select('user_type', $roles, isset($userRole) ? $userRole : [])->attributes([
                    'class' => 'input w-full border bg-gray-100 mt-2',
                    'data-control' => 'select2',
                    'id' => 'user_type',
                    'placeholder' => trans_choice('content.user_type', 1),
                ]) !!}
        </div>
    </div>
    <!--end::Input group-->
</div>
<!--end::Card body-->


@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\PushNotificationRequest', 'form') !!}

    <script>
        $(document).ready(function() {
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
            if (user == 0) {
                $('.user_select_box').css('display', 'block');
            } else {
                $('.user_select_box').css('display', 'none');
            }
        });
    </script>
@endpush
