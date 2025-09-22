@extends('admin.layouts.base')
@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('messages.list', [
            'name' => trans_choice('content.push_notification', 2),
        ]),
        'breadcrumbs' => Breadcrumbs::render('admin.pushNotifications.index'),
        'create_modal' => [
            'status' => true,
            'id' => 'addNewModal',
            'name' => 'PushNotification',
        ],
    ])
    @php
        $add_data = view('admin.push_notification.create');
    @endphp
    @include('admin.layouts.components.modals.create_form', [
        'modal_form_html' => $add_data,
        'modal_id' => 'addNewModal',
    ])
    @include('admin.layouts.components.modals.edit_form', [
        'modal_id' => 'editDataModal',
        'edit_form_blade' => 'admin.push_notification.edit',
    ])
    @include('admin.layouts.components.modals.details', [
        'modal_id' => 'viewDataModal',
    ])

    @include('admin.layouts.components.datatable_header', [
        'data' => [
            ['classname' => '', 'title' => trans_choice('content.id_title', 1)],
            ['classname' => 'min-w-125px', 'title' => trans_choice('content.title_title', 1)],
            ['classname' => 'min-w-125px', 'title' => trans_choice('content.message', 1)],
            ['classname' => 'min-w-125px', 'title' => trans_choice('content.status', 1)],
            ['classname' => 'min-w-125px', 'title' => trans_choice('content.created_at', 1)],
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
                    [4, 'desc']
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
                    $(row).find("td").last().addClass('table-report__action w-56');
                },
                ajax: {
                    "url": "{{ route('admin.pushNotifications.index') }}",
                    data: function(d) {},
                },
                dom: `<'row datatable_header'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                      "<'row'<'col-sm-12'tr>>" +
                      "<'row datatable_footer'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>`,
                columnDefs: [{
                    targets: [0, 5],
                    orderable: false,
                    searchable: false,
                    // className: 'mdl-data-table__cell--non-numeric'
                }],
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            // return data;
                            return "#" + serialNumberShow(meta);
                        }
                    },

                    {
                        data: 'title',
                        name: 'title',
                        render: function(data, type, row, meta) {
                            return `<div class="font-medium whitespace-no-wrap">${setStringLength(data,25)}</div>`;

                        }
                    },

                    {
                        data: 'messages',
                        name: 'messages',
                        render: function(data, type, row, meta) {
                            return `<div class="flex items-center justify-left">${setStringLength(data,25)}</div>`;

                        }
                    },

                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row, meta) {
                            var attr = `data-id="${ row['id'] }" data-status="${ !row['status'] }"`;
                            var avtive_data = actionActiveButton(data, attr);
                            return avtive_data;
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row, meta) {
                            return getDateByFormat(data);
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            let attr = `data-id="${ row['id'] }" `;
                            var edit_data = actionEditWithModal(attr);
                            var show_data = actionShowWithModal(attr);
                            var del_data = actionDeleteButton(row['id']);
                            return `<div class="flex items-center">
                                ${show_data} ${del_data}</div>`;

                        }
                    },
                ],
            });
        });

        $(document).on('click', '.clsdelete', function() {
            var id = $(this).attr('data-id');
            var e = $(this).parent().parent();
            var url = `{{ url('/') }}/admin/pushNotifications/` + id;
            tableDeleteRow(url, oTable);
        });

        $(document).on('click', '.clsstatus', function() {
            var id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
            var url = `{{ url('/') }}/admin/pushNotifications/status/` + id + `/` + status;
            tableChnageStatus(url, oTable);
        });

        $(document).on('click', '.clsShowModal', function() {
            var id = $(this).attr('data-id');
            var url = `{{ url('/') }}/admin/pushNotifications/` + id + `?tab=details`;
            getModalShowData(id, url);
        });

        $(document).on('click', '.clsEditModal', function() {
            var id = $(this).attr('data-id');
            var url = `{{ url('/') }}/admin/pushNotifications/` + id + `/edit`;
            getModalEditData(id, url);
        });
    </script>
    <script>
        $('#PushNotificationForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.pushNotifications.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#submit_form').html('Loading...');
                    $('#submit_form').addClass('disabled');
                    $('#submit_form').attr('disabled', true);
                },
                success: (response) => {
                    if (response.status == 1) {
                        this.reset();
                        $('#addNewModal').modal("hide");
                        oTable.draw();
                        $('#submit_form').html('Save');
                        $('#submit_form').removeClass('disabled');
                        $('#submit_form').attr('disabled', false);
                        Swal.fire('Created!', 'Form submit successfull.', 'success');
                    } else {
                        Swal.fire('Oops...', 'Something went wrong with ajax !',
                            'error');
                        $('#submit_form').html('Save');
                        $('#submit_form').removeClass('disabled');
                        $('#submit_form').attr('disabled', false);

                    }
                },
                error: function() {
                    $('#submit_form').html('Save');
                    $('#submit_form').removeClass('disabled');
                    $('#submit_form').attr('disabled', false);
                },
            });
        });
    </script>
    <script>
        $(document).on('submit', '#PushNotificationFormUpdate', function(e) {
            e.preventDefault();
            var id = $('#modal_id').val();
            let formData = new FormData(this);
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `{{ url('/') }}/pushNotifications/gems/` + id,
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#update_form').html('Loading...');
                    $('#update_form').addClass('disabled');
                    $('#update_form').attr('disabled', true);
                },
                success: (response) => {
                    if (response.status == 1) {
                        this.reset();
                        $('#editDataModal').modal("hide");
                        oTable.draw();
                        Swal.fire('Updated!', 'Form Update successfull.', 'success');
                    } else {
                        Swal.fire('Oops...', 'Something went wrong with ajax !',
                            'error');
                        $('#update_form').html('Update');
                        $('#update_form').removeClass('disabled');
                        $('#update_form').attr('disabled', false);
                    }
                },
                error: function(xhr, status, error) {
                    var form = $("#PushNotificationFormUpdate");
                    if (xhr.status == 422) {
                        var errors = JSON.parse(xhr.responseText).errors;
                        $('#update_form').html('Update');
                        $('#update_form').removeClass('disabled');
                        $('#update_form').attr('disabled', false);
                        customFnErrors(form, errors);
                    } else {
                        $('#update_form').html('Update');
                        $('#update_form').removeClass('disabled');
                        $('#update_form').attr('disabled', false);
                        Swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                    }
                },
            });
        });
    </script>
    <script>
        $("#btnClosePopupAdd").click(function() {
            $("#PushNotificationForm").trigger("reset");
            $("#addNewModal").modal("hide");
        });
    </script>
@endpush
