<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.header', [
        'title' => __('messages.list', ['name' => trans_choice('content.role', 1)]),
        'breadcrumbs' => Breadcrumbs::render('admin.roles.index'),
        'btn_route' => route('admin.roles.create'),
        'btn_name' => __('messages.create', ['name' => trans_choice('content.role', 1)]),
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->

                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                
                                <th class="min-w-125px"><?php echo e(trans_choice('content.number_title', 1)); ?></th>
                                <th class="min-w-125px"><?php echo e(trans_choice('content.name_title', 1)); ?></th>
                                <th class="text-end min-w-100px"><?php echo e(trans_choice('content.action_title', 1)); ?></th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tbody class="text-gray-600 fw-bold">
                                <!--begin::Table row-->
                                <!--begin::Table row-->
                                <tr>
                                    <!--begin::Checkbox-->
                                    
                                    <!--end::Checkbox-->
                                    <!--begin::IndexRow=-->
                                    <td class="d-flex align-items-center">
                                        <!--begin:: Avatar -->
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <div class="symbol-label fs-3 bg-light-danger text-danger"><?php echo e(++$i); ?>

                                            </div>
                                        </div>
                                        <!--end::Avatar-->
                                    </td>
                                    <!-- end::IndexRow -->
                                    <!-- begin::role -->
                                    <td>
                                        <!--begin::role details-->
                                        <div class="d-flex flex-column">
                                            <a href="<?php echo e(route('admin.roles.show', $role->id)); ?>"
                                                class="text-gray-800 text-hover-primary mb-1"><?php echo e($role->name); ?> </a>
                                            <span><?php echo e($role->name); ?></span>
                                        </div>
                                        <!--end::User details-->
                                    </td>
                                    <!--end::Role=-->
                                    <!--begin::Action=-->
                                    <td class="text-end">
                                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                            data-kt-menu-flip="top-end">Actions
                                            <!--begin::Svg Icon | path: icons/duotone/Navigation/Angle-down.svg-->
                                            <span class="svg-icon svg-icon-5 m-0">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24" />
                                                        <path
                                                            d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z"
                                                            fill="#000000" fill-rule="nonzero"
                                                            transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)" />
                                                    </g>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                                            data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <!-- <a class="btn btn-info" href="<?php echo e(route('admin.roles.show', $role->id)); ?>">Show</a> -->
                                            
                                            <div class="menu-item px-3">
                                                <a href="<?php echo e(route('admin.roles.edit', $role->id)); ?>"
                                                    class="menu-link px-3"><?php echo e(__('content.edit_title')); ?></a>
                                            </div>
                                            
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-delete')): ?>
                                                <div class="menu-item px-3">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['admin.roles.destroy', $role->id]]); ?>

                                                    <?php echo Form::submit('Delete', [
                                                        'class' => 'menu-link px-3',
                                                        'data-kt-users-table-filter' => 'delete_row',
                                                        'style' => 'border: none; background-color: transparent;',
                                                    ]); ?>

                                                    <?php echo Form::close(); ?>

                                                </div>
                                            <?php endif; ?>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                    <!--end::Action=-->
                                </tr>
                                <!--end::Table row-->
                            </tbody>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Herd\sbmemori\resources\views/admin/roles/index.blade.php ENDPATH**/ ?>