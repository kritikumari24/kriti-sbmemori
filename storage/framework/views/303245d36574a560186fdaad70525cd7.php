<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.header', [
        'title' => __('messages.create', ['name' => trans_choice('content.user', 1)]),
        'breadcrumbs' => Breadcrumbs::render('admin.users.create'),
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Careers - Apply-->
            <div class="card">
                <!--begin::Body-->
                <div class="card-body p-lg-17">
                    <!--begin::Hero-->
                    <div class="position-relative mb-17">
                        <!--begin::Overlay-->
                        <div class="overlay overlay-show">
                            <!--begin::Title-->
                            <h3 class="fs-2qx fw-bolder mb-3 m">
                                <?php echo e(__('messages.create', ['name' => trans_choice('content.user', 1)])); ?></h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Overlay-->
                    </div>
                    <!--end::-->
                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-lg-row mb-17">
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid me-0 me-lg-20">

                            <!--begin::Form-->
                            <?php echo html()->form('POST', route('admin.users.store'))->class('form mb-15')->attributes(['enctype' => 'multipart/form-data'])->open(); ?>

                            <?php echo $__env->make('admin.user.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <!--begin::Separator-->
                            <div class="separator mb-8"></div>
                            <!--end::Separator-->
                            <!--begin::Submit-->
                            <button type="submit" class="btn btn-primary"><?php echo e(__('content.create_title')); ?></button>
                            <!-- end::Submit -->
                            <!-- begin::Back  -->
                            <button type="button" class="btn btn-primary">
                                <a href="<?php echo e(route('admin.users.index')); ?>"
                                    class="text-white"><?php echo e(__('content.back_title')); ?></a>
                            </button>
                            <!-- end::Back  -->
                            <?php echo html()->form()->close(); ?>

                            <!--end::Form-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Layout-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Careers - Apply-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Herd\sbmemori\resources\views/admin/user/create.blade.php ENDPATH**/ ?>