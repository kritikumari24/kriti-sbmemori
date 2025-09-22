@extends('admin.layouts.base')

@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('messages.list', [
            'name' => trans_choice('content.page_content', 2),
        ]),
        'breadcrumbs' => Breadcrumbs::render('admin.page-contents.index'),
        'filter' => false,
        'create_btn' => [
            'status' => true,
            'route' => route('admin.page-contents.create'),
            'name' => __('messages.create', [
                'name' => trans_choice('content.page_content', 2),
            ]),
        ],
        // 'export' => [
        //     'status' => true,
        //     'route' => route('admin.page-contents.getdownload'),
        // ],
    ])
    @include('admin.layouts.components.datatable_header', [
        'data' => [
            ['classname' => '', 'title' => trans_choice('content.id_title', 1)],
            ['classname' => 'min-w-125px', 'title' => trans_choice('content.name_title', 1)],
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
                    "url": "{{ route('admin.page-contents.index') }}",
                    data: function(d) {
                        d.name = $('input[name=name]').val();
                        d.status = $('select[name=status]').val();
                    },
                },
                dom: `<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                      "<'row'<'col-sm-12'tr>>" +
                      "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>`,
                columnDefs: [{
                    targets: [4],
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
                        data: 'title',
                        name: 'title',
                        render: function(data, type, row, meta) {
                            var show_url = `{{ url('/') }}/admin/page-contents/` + row['id'] +
                                `?tab=details`;
                            return ` <a href="${show_url}">
                                    <div class="font-medium whitespace-no-wrap">${data}</div>
                                </a>`;
                            // return actionTitleButton(data, show_url);
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

                            var edit_url = `{{ url('/') }}/admin/page-contents/` + row['id'] +
                                `/edit/?tab=edit`;
                            var show_url = `{{ url('/') }}/admin/page-contents/` + row['id'] +
                                `?tab=details`;
                            var edit_data = actionEditButton(edit_url, row['id']);
                            var show_data = actionShowButton(show_url);
                            return `<div class="flex justify-left items-center"> ${edit_data} </div>`;

                        }
                    },
                ],
            });
        });

        $(document).on('click', '.clsstatus', function() {
            var id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
            var url = `{{ url('/') }}/admin/page-contents/status/` + id + `/` + status;
            tableChnageStatus(url, oTable);
        });
    </script>


    <script>
        $('#extraSearch').on('click', function() {
            //extraSearch is id of search button....
            oTable.draw();
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
            oTable.draw();
        });
    </script>
@endpush
