@extends('admin.layouts.base')
@section('content')
    @include('admin.layouts.components.header', [
        'title' => __('messages.list', ['name' => trans_choice('content.role', 1)]),
        'breadcrumbs' => Breadcrumbs::render('admin.roles.index'),
        'btn_route' => route('admin.roles.create'),
        'btn_name' => __('messages.create', ['name' => trans_choice('content.role', 1)]),
    ])

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
                                {{-- <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                            data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                                    </div>
                                </th> --}}
                                <th class="min-w-125px">{{ trans_choice('content.number_title', 1) }}</th>
                                <th class="min-w-125px">{{ trans_choice('content.name_title', 1) }}</th>
                                <th class="text-end min-w-100px">{{ trans_choice('content.action_title', 1) }}</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        @foreach ($roles as $key => $role)
                            <tbody class="text-gray-600 fw-bold">
                                <!--begin::Table row-->
                                <!--begin::Table row-->
                                <tr>
                                    <!--begin::Checkbox-->
                                    {{-- <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td> --}}
                                    <!--end::Checkbox-->
                                    <!--begin::IndexRow=-->
                                    <td class="d-flex align-items-center">
                                        <!--begin:: Avatar -->
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <div class="symbol-label fs-3 bg-light-danger text-danger">{{ ++$i }}
                                            </div>
                                        </div>
                                        <!--end::Avatar-->
                                    </td>
                                    <!-- end::IndexRow -->
                                    <!-- begin::role -->
                                    <td>
                                        <!--begin::role details-->
                                        <div class="d-flex flex-column">
                                            <a href="{{ route('admin.roles.show', $role->id) }}"
                                                class="text-gray-800 text-hover-primary mb-1">{{ $role->name }} </a>
                                            <span>{{ $role->name }}</span>
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
                                            <!-- <a class="btn btn-info" href="{{ route('admin.roles.show', $role->id) }}">Show</a> -->
                                            {{-- @can('role-edit') --}}
                                            <div class="menu-item px-3">
                                                <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                    class="menu-link px-3">{{ __('content.edit_title') }}</a>
                                            </div>
                                            {{-- @endcan --}}
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            @can('role-delete')
                                                <div class="menu-item px-3">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['admin.roles.destroy', $role->id]]) !!}
                                                    {!! Form::submit('Delete', [
                                                        'class' => 'menu-link px-3',
                                                        'data-kt-users-table-filter' => 'delete_row',
                                                        'style' => 'border: none; background-color: transparent;',
                                                    ]) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            @endcan
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                    <!--end::Action=-->
                                </tr>
                                <!--end::Table row-->
                            </tbody>
                        @endforeach
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
@endsection
