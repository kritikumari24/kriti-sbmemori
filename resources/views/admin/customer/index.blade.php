@extends('admin.layouts.base')

@section('admin_filter_form')
    {!! html()->form('POST', route('admin.customers.download'))->class('form')->id('filter_data')->open() !!}
    <!--begin::Card body-->
    <div class="card-body">
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ trans_choice('content.name_title', 1) }}</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                {!! html()->text('name', null)->attributes([
                        'placeholder' => 'Name',
                        'class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0',
                    ]) !!}
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ trans_choice('content.email_title', 1) }}</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                {!! html()->email('email', old('email'))->attributes([
                        'placeholder' => 'Email',
                        'class' => 'form-control form-control-lg form-control-solid',
                    ]) !!}
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label fw-bold fs-6">
                <span class="required">{{ trans_choice('content.phone_title', 1) }}</span>
                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                    title="Phone number must be active"></i>
            </label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                {!! html()->text('mobile_no', null)->attributes([
                        'placeholder' => 'Contact Number',
                        'class' => 'form-control form-control-lg form-control-solid only_number',
                    ]) !!}
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label
                class="col-lg-4 col-form-label required fw-bold fs-6">{{ trans_choice('content.customer_id', 1) }}</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
                {!! html()->text('customer_id', old('customer_id'))->attributes([
                        'placeholder' => __('placeholder.customer_id'),
                        'class' => 'form-control form-control-lg form-control-solid mb-3 mb-lg-0',
                    ]) !!}
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label fw-bold fs-6">{{ trans_choice('content.status_title', 1) }}</label>
            <!--end::Label-->
            <!--begin::Input-->
            <div class="col-lg-8 fv-row">
                <select class="form-control form-control-lg form-control-solid" data-control="select2" name="status">
                    <option value="">{{ trans_choice('content.please_select', 1) }}</option>
                    <option value="1">{{ trans_choice('content.active_title', 1) }}</option>
                    <option value="0">{{ trans_choice('content.inactive_title', 1) }}</option>
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
            data-kt-menu-dismiss="true">{{ trans_choice('content.reset', 1) }}</button>
        <button type="button" class="btn btn-sm btn-primary me-2" id="extraSearch"
            data-kt-menu-dismiss="true">{{ __('content.search_title') }}</button>
        <button type="submit" class="btn btn-sm btn-info"
            data-kt-menu-dismiss="true">{{ __('content.download_title') }}</button>
    </div>
    <!--end::Actions-->
    {!! html()->form()->close() !!}
@endsection

@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('messages.list', [
            'name' => trans_choice('content.customer', 2),
        ]),
        'breadcrumbs' => Breadcrumbs::render('admin.customers.index'),
        'filter' => true,
        'create_btn' => [
            'status' => true,
            'route' => route('admin.customers.create'),
            'name' => __('messages.create', [
                'name' => trans_choice('content.customer', 2),
            ]),
        ],
        'export' => [
            'status' => true,
            'route' => route('admin.customers.getdownload'),
        ],
    ])
    @include('admin.layouts.components.datatable_header', [
        'data' => [
            ['classname' => '', 'title' => trans_choice('content.id_title', 1)],
            ['classname' => 'min-w-125px', 'title' => trans_choice('content.name_title', 1)],
            ['classname' => 'min-w-125px', 'title' => trans_choice('content.email_title', 1)],
            ['classname' => 'min-w-125px', 'title' => trans_choice('content.status_title', 1)],
            ['classname' => 'min-w-125px', 'title' => trans_choice('content.joined_date_title', 1)],
            ['classname' => 'min-w-100px', 'title' => trans_choice('content.action_title', 1)],
        ],
    ])
@endsection

@push('scripts')
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
                    "url": "{{ route('admin.customers.index') }}",
                    data: function(d) {
                        d.name = $('input[name=name]').val();
                        d.email = $('input[name=email]').val();
                        d.customer_id = $('input[name=customer_id]').val();
                        d.mobile_no = $('input[name=mobile_no]').val();
                        d.status = $('select[name=status]').val();
                    },
                },
                dom: `<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                      "<'row'<'col-sm-12'tr>>" +
                      "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>`,
                columnDefs: [{
                    targets: [5],
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
                            var show_url = `{{ url('/') }}/admin/customers/` + row['id'] +
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

                            var edit_url = `{{ url('/') }}/admin/customers/` + row['id'] +
                                `/edit/?tab=edit`;
                            var show_url = `{{ url('/') }}/admin/customers/` + row['id'] +
                                `?tab=details`;
                            var button = actionButton(edit_url, row['id']);
                            var edit_data = actionEditButton(edit_url, row['id']);
                            var show_data = actionShowButton(show_url);
                            // var show_home = actionHomeButton(row['id']);

                            var del_data = actionDeleteButton(row['id']);
                            return `<div class="flex justify-left items-center"> ${show_data} ${edit_data} ${del_data} </div>`;
                            // return `<div class="flex justify-left items-center"> ${button} </div>`;

                        }
                    },
                ],
            });
        });

        $(document).on('click', '.clsdelete', function() {
            var id = $(this).attr('data-id');
            var e = $(this).parent().parent();
            var url = `{{ url('/') }}/admin/customers/` + id;
            tableDeleteRow(url, oTable);
        });

        $(document).on('click', '.clsstatus', function() {
            var id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
            var url = `{{ url('/') }}/admin/customers/status/` + id + `/` + status;
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
@endpush
