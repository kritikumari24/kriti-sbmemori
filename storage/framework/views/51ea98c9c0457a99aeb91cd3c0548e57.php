<?php $__env->startSection('admin_filter_form'); ?>
    <?php echo html()->form('POST', route('admin.users.download'))->class('form mb-15')->id('filter_data')->open(); ?>

    <!--begin::Card body-->
    <div class="card-body border-top p-9">
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-bold fs-6"><?php echo e(trans_choice('content.name_title', 1)); ?></label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                <?php echo html()->text('name', null)->attributes([
                        'placeholder' => 'Name',
                        'class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0',
                    ]); ?>

            </div>
            <!--end::Col-->

        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-bold fs-6"><?php echo e(trans_choice('content.email_title', 1)); ?></label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                <?php echo html()->email('email', null)->attributes([
                        'placeholder' => 'Email',
                        'class' => 'form-control form-control-lg form-control-solid',
                    ]); ?>

            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label fw-bold fs-6">
                <span class="required"><?php echo e(trans_choice('content.phone_title', 1)); ?></span>
                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                    title="Phone number must be active"></i>
            </label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                <?php echo html()->text('mobile_no', null)->attributes([
                        'placeholder' => 'Contact Number',
                        'class' => 'form-control form-control-lg form-control-solid only_number',
                    ]); ?>

            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-bold fs-6"><?php echo e(trans_choice('content.user_id', 1)); ?></label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                <?php echo html()->text('customer_id', null)->attributes([
                        'placeholder' => __('placeholder.customer_id'),
                        'class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0',
                    ]); ?>

            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label fw-bold fs-6"><?php echo e(trans_choice('content.role', 1)); ?></label>
            <!--begin::Label-->
            <!--begin::Label-->
            <div class="col-lg-8 fv-row">
                
                <?php echo html()->select('role', $roles, null)->attributes([
                        'class' => 'form-control form-control-lg form-control-solid',
                        'data-control' => 'select2',
                    ])->placeholder(__('placeholder.role')); ?>

            </div>
            <!--begin::Label-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label fw-bold fs-6"><?php echo e(trans_choice('content.status_title', 1)); ?></label>
            <!--end::Label-->
            <!--begin::Input-->
            <div class="col-lg-8 fv-row">
                <select class="form-control form-control-lg form-control-solid" data-control="select2" name="status">
                    <option value=""><?php echo e(trans_choice('content.please_select', 1)); ?></option>
                    <option value="1"><?php echo e(trans_choice('content.active_title', 1)); ?></option>
                    <option value="0"><?php echo e(trans_choice('content.inactive_title', 1)); ?></option>
                </select>
            </div>
            <!--end::Input-->
        </div>
        <!--end::Input group-->
        <!--end::Input group-->
    </div>
    <!--end::Card body-->

    <!--begin::Actions-->
    <div class="d-flex justify-content-end">
        <button type="reset" class="btn btn-sm btn-white btn-active-light-primary me-2" id="searchReset"
            data-kt-menu-dismiss="true"><?php echo e(trans_choice('content.reset', 1)); ?></button>
        <button type="button" class="btn btn-sm btn-primary me-2" id="extraSearch"
            data-kt-menu-dismiss="true"><?php echo e(__('content.search_title')); ?></button>
        <button type="submit" class="btn btn-sm btn-info"
            data-kt-menu-dismiss="true"><?php echo e(__('content.download_title')); ?></button>
    </div>
    <!--end::Actions-->
    <?php echo html()->form()->close(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.header', [
        'title' => __('messages.list', ['name' => trans_choice('content.user', 2)]),
        'breadcrumbs' => Breadcrumbs::render('admin.users.index'),
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Left Side Heading-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <h4><?php echo e(__('messages.list', ['name' => trans_choice('content.user', 2)])); ?></h4>
                        </div>
                        <!--end::Left Side Heading-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <!--begin::Filter-->
                            <button type="button" class="btn btn-light-primary me-3" id="kt_drawer_filter_button">
                                <!--begin::Svg Icon | path: icons/duotone/Text/Filter.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                </span>
                                <!--end::Svg Icon--><?php echo e(trans_choice('content.filter', 1)); ?>

                            </button>
                            <!--end::Filter-->

                            <!--begin::Add user-->
                            <a href="<?php echo e(route('admin.users.create')); ?> " type="button" class="btn btn-primary">
                                <!--begin::Svg Icon | path: icons/duotone/Navigation/Plus.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1" />
                                        <rect fill="#000000" opacity="0.5"
                                            transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)"
                                            x="4" y="11" width="16" height="2" rx="1" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon--><?php echo e(__('messages.create', ['name' => trans_choice('content.user', 2)])); ?>

                            </a>
                            <!--end::Add user-->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table id="kt_table_1" class="table align-middle table-row-dashed fs-6 gy-5">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th class=""><?php echo e(trans_choice('content.id_title', 1)); ?></th>
                                <th class=" min-w-125px"><?php echo e(trans_choice('content.name_title', 1)); ?></th>
                                <th class="min-w-125px"><?php echo e(trans_choice('content.email_title', 1)); ?></th>
                                <th class=" min-w-125px"><?php echo e(trans_choice('content.role_title', 1)); ?></th>
                                <th class=" min-w-125px"><?php echo e(trans_choice('content.two_step_title', 1)); ?></th>
                                <th class=" min-w-125px"><?php echo e(trans_choice('content.joined_date_title', 1)); ?></th>
                                <th class="min-w-100px"><?php echo e(trans_choice('content.action_title', 1)); ?></th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-bold"></tbody>
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

<?php $__env->startPush('scripts'); ?>
    <script>
        var oTable;
        $(document).ready(function() {
            oTable = $('#kt_table_1').DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                order: [
                    [0, 'desc']
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search...",
                },
                oLanguage: {
                    sLengthMenu: "Show _MENU_",
                    sEmptyTable: "No Records Found.",
                    infoEmpty: "No entries to show.",
                },
                createdRow: function(row, data, dataIndex) {
                    // Set the data-status attribute, and add a class
                    $(row).attr('role', 'row');
                    $(row).find("td").last().addClass('text-danger');

                },
                ajax: {
                    "url": "<?php echo e(route('admin.users.index')); ?>",
                    data: function(d) {
                        d.name = $('input[name=name]').val();
                        d.email = $('input[name=email]').val();
                        d.user_id = $('input[name=user_id]').val();
                        d.mobile_no = $('input[name=mobile_no]').val();
                        d.status = $('select[name=status]').val();
                        d.role = $('select[name=role]').val();
                    },
                },
                dom: `<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                      "<'row'<'col-sm-12'tr>>" +
                      "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>`,
                columnDefs: [{
                    targets: [6],
                    orderable: false,
                    searchable: false,
                    // className: 'mdl-data-table__cell--non-numeric'
                }],
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return data;
                            // return "#" + serialNumberShow(meta);
                        }
                    },

                    {
                        data: 'name',
                        name: 'name',
                        render: function(data, type, row, meta) {
                            var show_url = `<?php echo e(url('/')); ?>/admin/users/` + row['id'] +
                                `?tab=details`;
                            return ` <a href="${show_url}">
                                        <div class="font-medium whitespace-no-wrap">${data}</div>
                                    </a>`;
                        }
                    },
                    {
                        data: 'email',
                        name: 'email',
                        render: function(data, type, row, meta) {
                            return `<div class="font-medium whitespace-no-wrap">${data}</div>`;
                        }
                    },
                    {
                        data: 'email',
                        name: 'email',
                        render: function(data, type, row, meta) {
                            return `<div class="font-medium whitespace-no-wrap">${row['roles'][0]['name']}</div>`;
                        }
                    },
                    {
                        data: 'is_active',
                        name: 'is_active',
                        render: function(data, type, row, meta) {
                            var attr = `data-id="${ row['id'] }" data-status="${ data }"`;
                            var avtive_data = actionActiveButton(data, attr);
                            return avtive_data;
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row, meta) {
                            return getDateTimeByFormat(data);
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        // visible:false,
                        render: function(data, type, row, meta) {

                            var edit_url = `<?php echo e(url('/')); ?>/admin/users/` + row['id'] +
                                `/edit/?tab=edit`;
                            var show_url = `<?php echo e(url('/')); ?>/admin/users/` + row['id'] +
                                `?tab=details`;
                            var button = actionButton(edit_url, row['id']);
                            // var edit_data = actionEditButton(edit_url, row['id']);
                            // var show_data = actionShowButton(show_url);
                            // // var show_home = actionHomeButton(row['id']);

                            // var del_data = actionDeleteButton(row['id']);
                            // return `<div class="flex justify-left items-center"> ${show_data} ${edit_data} ${del_data} </div>`;
                            // return `<div class="flex justify-left items-center"> ${button} </div>`;
                            return button;

                        }
                    },
                ],
            });
        });

        $(document).on('click', '.clsdelete', function() {
            var id = $(this).attr('data-id');
            var e = $(this).parent().parent();
            var url = `<?php echo e(url('/')); ?>/admin/users/` + id;
            tableDeleteRow(url, oTable);
        });

        $(document).on('click', '.clsstatus', function() {
            var id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
            var url = `<?php echo e(url('/')); ?>/admin/users/status/` + id + `/` + status;
            tableChnageStatus(url, oTable);
        });
    </script>


    <script>
        $('#extraSearch').on('click', function() {
            //extraSearch is id of search button....
            oTable.draw();
            toggleFilterDrawerManually();
        });

        $(document).on('click', '#searchReset', function(e) {
            //alert('success');
            $('#filter_data').trigger("reset");
            e.preventDefault();
            oTable.draw();
        });

        $(document).on('click', '.drawerReset', function(e) {
            $('#filter_data').trigger("reset");
            e.preventDefault();
            oTable.draw();
        });

        $(document).ready(function() {
            $('#filter_data').trigger("reset");
            // oTable.draw();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Herd\sbmemori\resources\views/admin/user/index.blade.php ENDPATH**/ ?>