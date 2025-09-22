<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>
        <?php echo e($page_title); ?>

    </title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />

    <link rel="shortcut icon" href="<?php echo e($favicon_img); ?>" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="<?php echo e(asset('admin/dist/plugins/global/plugins.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('admin/dist/css/style.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    <!--end::Custom Stylesheet Bundle-->
    <link rel="stylesheet" href="<?php echo e(asset('/admin/dist/css/custom.css')); ?>" />
    <!--end::Custom Stylesheet Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-dark">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <?php echo $__env->make('admin.layouts.partials.flash', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <!--end::Main-->
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="<?php echo e(asset('admin/dist/js/scripts.bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/dist/plugins/global/plugins.bundle.js')); ?>"></script>
    <!--end::Global Javascript Bundle-->
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
<?php /**PATH D:\Herd\kriti-sbmemori\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>