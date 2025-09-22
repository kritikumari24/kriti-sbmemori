<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.header', [
        'title' => __('messages.detail', ['name' => trans_choice('content.permission', 1)]),
        'breadcrumbs' => Breadcrumbs::render('admin.permissions.show'),
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">

            <!--begin::Basic info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_profile_details" aria-expanded="true"
                    aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0"><?php echo e(__('messages.list', ['name' => 'Permission'])); ?></h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form id="kt_account_profile_details_form" class="form">
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">

                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label
                                    class="col-lg-4 col-form-label required fw-bold fs-6"><?php echo e(trans_choice('content.name_title', 1)); ?></label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <label
                                        class="col-lg-4 col-form-label required fw-bold fs-6 form-control-lg form-control-solid"><?php echo e($permission->name); ?></label>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                        </div>
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="button" class="btn btn-primary">
                                <a href="<?php echo e(route('admin.permissions.index')); ?>"
                                    class="text-white"><?php echo e(__('content.back_title')); ?></a>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Basic info-->


        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Herd\sbmemori\resources\views/admin/permissions/details.blade.php ENDPATH**/ ?>