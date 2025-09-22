@php
$title = isset($title) ? $title : __('content.download_title');
@endphp
<a href="javascript:void(0)" class="btn btn-light btn-active-light-info btn-sm" data-kt-menu-trigger="click"
    data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
    <!--begin::Svg Icon-->
    <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
        <i class="fas fa-download fw-bold-3"></i>
    </span>
    <!--end::Svg Icon-->{{ $title }}
</a>
<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-info fw-bold fs-7 w-125px py-4"
    data-kt-menu="true">
    <input type="hidden" id="export_type" name="export" value="">
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        @include(
            'admin.layouts.components.buttons.hovers.secondary_btn',
            [
                'id' => 'search_filter_excel_download',
                'class' => 'menu-link px-3',
                'title' => __('content.excel_title'),
                'attr' => 'data-type=excel title=Excel',
            ]
        )
    </div>
    <!--end::Menu item-->
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        @include(
            'admin.layouts.components.buttons.hovers.secondary_btn',
            [
                'id' => 'search_filter_excel_download',
                'class' => 'menu-link px-3',
                'title' => __('content.csv_title'),
                'attr' => 'data-type=csv title=CSV',
            ]
        )
    </div>
    <!--end::Menu item-->
</div>
<!--end::Menu-->
