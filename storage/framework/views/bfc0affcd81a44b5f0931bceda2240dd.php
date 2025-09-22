<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.header', [
        'title' => __('messages.list', ['name' => trans_choice('content.permission', 1)]),
        'breadcrumbs' => Breadcrumbs::render('admin.permissions.index'),
        'btn_route' => route('admin.permissions.create'),
        'btn_name' => __('messages.create', ['name' => trans_choice('content.permission', 1)]),
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Tables Widget 10-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1"><?php echo e(trans_choice('content.permission', 2)); ?>

                            <?php echo e(isset($global_setting_data['site_name']) ? $global_setting_data['site_name'] : ''); ?> </span>
                    </h3>
                    <!-- Menu Bar -->
                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div class="card-body pt-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table id="kt_table_1" class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="border-0">
                                    <th class="p-0"><?php echo e(trans_choice('content.id_title', 1)); ?></th>
                                    <th class="p-0 min-w-150px"><?php echo e(trans_choice('content.name_title', 1)); ?></th>
                                    <th class="p-0 min-w-100px"><?php echo e(trans_choice('content.action_title', 1)); ?>

                                    </th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>

                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Tables Widget 10-->
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
                oLanguage: {
                    sLengthMenu: "Show _MENU_",
                },
                createdRow: function(row, data, dataIndex) {
                    // Set the data-status attribute, and add a class
                    $(row).attr('role', 'row');
                    $(row).find("td").last().addClass('text-danger');

                },
                ajax: "<?php echo e(route('admin.permissions.index')); ?>",
                //     dom: `<"top pull-right"f>lt<"botttom">
            // <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_emailr'p>>`,
                dom: `<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                      "<'row'<'col-sm-12'tr>>" +
                      "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>`,
                columnDefs: [{
                    targets: [2],
                    orderable: false,
                    searchable: false,
                    // className: 'mdl-data-table__cell--non-numeric'
                }],
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return data;
                        }
                    },

                    {
                        data: 'name',
                        name: 'name',
                        render: function(data, type, row, meta) {
                            return `<div class="font-medium whitespace-no-wrap">${data}</div>`;
                            // return "#" + serialNumberShow(meta);
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        // visible:false,
                        render: function(data, type, row, meta) {

                            var edit_url = `<?php echo e(url('/')); ?>/admin/permissions/` + row['id'] +
                                `/edit/`;
                            var show_url = `<?php echo e(url('/')); ?>/admin/permissions/` + row['id'] +
                                ``;

                            var edit_data = actionEditButton(edit_url, row['id']);
                            var show_data = actionShowButton(show_url);
                            // var show_home = actionHomeButton(row['id']);

                            var del_data = actionDeleteButton(row['id']);
                            return `<div class="flex justify-left items-center">
                         ${show_data}
                         <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permissions-edit')): ?>
                             ${edit_data}
                         <?php endif; ?>
                          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permissions-delete')): ?>
                              ${del_data}
                          <?php endif; ?>
                          </div>`;

                        }
                    },
                ],
            });
        });

        $(document).on('click', '.clsdelete', function() {
            var id = $(this).attr('data-id');
            var e = $(this).parent().parent();
            var url = `<?php echo e(url('/')); ?>/admin/permissions/` + id;
            tableDeleteRow(url, oTable);
        });

        $(document).on('click', '.clsstatus', function() {
            var id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
            var url = `<?php echo e(url('/')); ?>/admin/permissions/status/` + id + `/` + status;
            tableChnageStatus(url, oTable);
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Herd\sbmemori\resources\views/admin/permissions/index.blade.php ENDPATH**/ ?>