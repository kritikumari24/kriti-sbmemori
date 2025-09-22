<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>
        <?php echo e($page_title ?? ''); ?>

    </title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="description" content="it's the common setup project." />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    
    <link rel="shortcut icon" href="<?php echo e($favicon_img ?? ''); ?>" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="<?php echo e(asset('admin/dist/plugins/custom/datatables/datatables.bundle.css')); ?>" rel="stylesheet"
        type="text/css" />
    <!--end::Page Vendor Stylesheets-->

    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="<?php echo e(asset('admin/dist/plugins/global/plugins.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('admin/dist/css/style.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!--end::Global Stylesheets Bundle-->
    <!--end::Custom Stylesheet Bundle-->
    <link rel="stylesheet" href="<?php echo e(asset('/admin/dist/css/custom.css')); ?>" />
    <!--end::Custom Stylesheet Bundle-->
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
    style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">

    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <?php echo $__env->make('admin.layouts.components.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" style="" class="header align-items-stretch">
                    <!--begin::Container-->
                    <div class="container-fluid d-flex align-items-stretch justify-content-between">
                        <!--begin::Aside mobile toggle-->
                        <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
                            <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                                id="kt_aside_mobile_toggle">
                                <!--begin::Svg Icon | path: icons/duotone/Text/Menu.svg-->
                                <span class="svg-icon svg-icon-2x mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <rect fill="#000000" x="4" y="5" width="16" height="3"
                                                rx="1.5" />
                                            <path
                                                d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L18.5,10 C19.3284271,10 20,10.6715729 20,11.5 C20,12.3284271 19.3284271,13 18.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z"
                                                fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                        </div>
                        <!--end::Aside mobile toggle-->
                        <!--begin::Mobile logo-->
                        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                            <a href="javascript:void(0)" class="d-lg-none">
                                <img alt="Logo" src="<?php echo e($logo_img); ?>" class="h-30px" />
                            </a>
                        </div>
                        <!--end::Mobile logo-->
                        <!--begin::Wrapper-->
                        <?php echo $__env->make('admin.layouts.components.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <?php echo $__env->make('admin.layouts.partials.flash', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
                <!--end::Content-->

                <!--begin::Footer-->
                <?php echo $__env->make('admin.layouts.components.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->

        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->
    <?php echo $__env->make('admin.layouts.components.filter_drawer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
<!--end::Body-->

<?php echo $__env->make('admin.layouts.core-js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->yieldPushContent('scripts'); ?>

<?php echo $__env->make('admin.layouts.dynamic-htmjs', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</html>
<?php /**PATH D:\Herd\sbmemori\resources\views/admin/layouts/base.blade.php ENDPATH**/ ?>