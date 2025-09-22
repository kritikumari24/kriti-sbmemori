@extends('admin.layouts.base')
@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('messages.list', ['name' => trans_choice('content.type', 1)]),
        'breadcrumbs' => Breadcrumbs::render('admin.types.index'),
        'create_modal' => [
            'status' => true,
            'id' => 'addNewModal',
            'name' => trans_choice('content.type', 1),
        ],
    ])

    @php
        $add_data = view('admin.type.create');
    @endphp

    @include('admin.layouts.components.manager_modal.create_form', [
        'modal_form_html' => $add_data,
        'modal_id' => 'addNewModal',
    ])

    @include('admin.layouts.components.manager_modal.edit_form', [
        'modal_id' => 'editDataModal',
        'edit_form_blade' => 'admin.type.edit',
    ])
    @include('admin.layouts.components.manager_modal.details', [
        'modal_id' => 'viewDataModal',
    ])

@include('admin.layouts.components.datatable_header', [
    'data' => [
        ['classname' => '', 'title' => trans_choice('content.id_title', 1)],
        ['classname' => 'min-w-125px', 'title' => trans_choice('content.name_title', 1)],
        ['classname' => 'min-w-125px', 'title' => trans_choice('content.status_title', 1)],
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
                oLanguage: {
                    sLengthMenu: "Show _MENU_",
                },
                createdRow: function(row, data, dataIndex) {
                    // Set the data-status attribute, and add a class
                    $(row).attr('role', 'row');
                    $(row).find("td").last().addClass('text-danger');

                },
                ajax: "{{ route('admin.types.index') }}",
                //     dom: `<"top pull-right"f>lt<"botttom">
            // <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_emailr'p>>`,
                columnDefs: [{
                    targets: [],
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
                        data: 'is_active',
                        name: 'is_active',
                        render: function(data, type, row, meta) {
                            console.log(data);
                            var attr = `data-id="${ row['id'] }" data-status="${ data }"`;
                            var avtive_data = actionActiveButton(data, attr);
                            return avtive_data;
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        // visible:false,
                        render: function(data, type, row, meta) {
                            let attr = `data-id="${ row['id'] }" `;
                            var edit_data = actionEditWithModal(attr);
                            var show_data = actionShowWithModal(attr);
                            var del_data = actionDeleteButton(row['id']);

                          
                            return `<div class="flex justify-left items-center">
                             ${show_data} ${edit_data} ${del_data}</div>`;

                        }
                    },
                ],
            });
        });

        $(document).on('click', '.clsdelete', function() {
            var id = $(this).attr('data-id');
            var e = $(this).parent().parent();
            var url = `{{ url('/') }}/admin/types/` + id;
            tableDeleteRow(url, oTable);
        });

        $(document).on('click', '.clsstatus', function() {
            var id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
            console.log(status);
            var url = `{{ url('/') }}/admin/types/status/` + id + `/` + status;
            tableChnageStatus(url, oTable);
        });

        $(document).on('click', '.clsEditModal', function() {
            var id = $(this).attr('data-id');
            var url = `{{ url('/') }}/admin/types/` + id + `/edit`;
            getModalEditData(id, url);
        });
        $(document).on('click', '.clsShowModal', function() {
            var id = $(this).attr('data-id');
            var url = `{{ url('/') }}/admin/types/` + id + `?tab=details`;
            getModalShowData(id, url);
        });
    </script>
     <script>
        $('#TypeForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.types.store') }}",
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
        $(document).on('submit', '#TypeFormUpdate', function(e) {
            e.preventDefault();
            var id = $('#modal_id').val();
            let formData = new FormData(this);
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `{{ url('/') }}/admin/types/` + id,
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
                error:function(xhr, status, error) {
                        var form = $("#TypeFormUpdate");
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
@endpush
