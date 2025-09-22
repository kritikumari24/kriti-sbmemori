<!--begin::Post-->
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
        <div class="intro-y box p-5">
            <div>
                <label class="text-gray-500 font-medium leading-none mt-3">User type
                    : </label>
                @if (isset($pushNotification->user_type))
                    @if ($pushNotification->user_type == 'user')
                        Customer
                    @else
                        Guruji
                    @endif
                    @else
                    Na
                @endif
            </div>
        </div>
    </div>
    <div class="intro-y col-span-12 lg:col-span-6">
        <div class="intro-y box p-5">
            <div>
                <label class="text-gray-500 font-medium leading-none mt-3">User
                    : </label>
                @if (isset($pushNotification->members))
                    @if ($pushNotification->members == 1)
                        All
                    @else
                    Individual
                    @endif
                @endif
            </div>
        </div>
    </div>
    <div class="intro-y col-span-12 lg:col-span-6">
        <div class="intro-y box p-5">
            <div>
                <label class="text-gray-500 font-medium leading-none mt-3">Title
                    : </label>
                    {{ isset($pushNotification->title) ? $pushNotification->title : 'N/A' }}
            </div>
        </div>
    </div>
    <div class="intro-y col-span-12 lg:col-span-6">
        <div class="intro-y box p-5">
            <div>
                <label class="text-gray-500 font-medium leading-none mt-3">Message
                    : </label>
                    {{ isset($pushNotification->messages) ? $pushNotification->messages : 'N/A' }}
            </div>
        </div>
    </div>
    <div class="intro-y col-span-12 lg:col-span-6">
        <div class="intro-y box p-5">
            <div>
                <label class="text-gray-500 font-medium leading-none mt-3">Link type
                    : </label>
                    {{ isset($pushNotification->link_type) ? $pushNotification->link_type : 'N/A' }}
            </div>
        </div>
    </div>
    {{-- <div class="intro-y col-span-12 lg:col-span-6">
        <div class="intro-y box p-5">
            <div>
                <label class="text-gray-500 font-medium leading-none mt-3">Link id
                    : </label>
                {{ isset($pushNotification->link_id) ? $pushNotification->link_id : 'N/A' }}
            </div>
        </div>
    </div> --}}
    <div class="intro-y col-span-12 lg:col-span-6">
        <div class="intro-y box p-5">
            <div>
                <label class="text-gray-500 font-medium leading-none mt-3">{{ trans_choice('content.image', 1) }}
                    :   <a href="{{ isset($pushNotification->image) ? getImageUrl($pushNotification->image) : imageNotFoundUrl() }}"> <img id="backImage_image" width="80px" height="80px" src="{{ isset($pushNotification->image) ? getImageUrl($pushNotification->image) : imageNotFoundUrl() }}" title="Image"></a></label>
            </div>
        </div>
    </div>
    {{-- <div class="intro-y col-span-12 lg:col-span-6">
        <div class="intro-y box p-5">
            <div>
                <label class="text-gray-500 font-medium leading-none mt-3">Icon
                    :   <a href="{{ isset($pushNotification->icon) ? getImageUrl($pushNotification->icon) : imageNotFoundUrl() }}"> <img id="backImage_image" width="80px" height="80px" src="{{ isset($pushNotification->icon) ? getImageUrl($pushNotification->icon) : imageNotFoundUrl() }}" title="Image"></a></label>
            </div>
        </div>
    </div> --}}
</div>
