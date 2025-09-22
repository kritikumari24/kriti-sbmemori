    <!--begin::View component-->
    <div id="kt_drawer_filter" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true"
        data-kt-drawer-toggle="#kt_drawer_filter_button" data-kt-drawer-close="#kt_drawer_filter_close"
        data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'md': '500px'}">
        <!--begin::Filter Body-->
        <div class="card w-100 rounded-0">
            <!--begin::Card header-->
            <div class=" card-header pe-5" id="kt_drawer_filter_header">
                <!--begin::Title-->
                <div class="card-title">
                    <!--begin::User-->
                    <div class="d-flex justify-content-center flex-column me-3">
                        <span
                            class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">{{ trans_choice('content.filter_options', 1) }}</span>
                    </div>
                    <!--end::User-->
                </div>
                <!--end::Title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Menu-->
                    <div class="me-2">
                    </div>
                    <!--end::Menu-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-light-primary drawerReset" id="kt_drawer_filter_close">
                        <!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                    fill="#000000">
                                    <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
                                    <rect fill="#000000" opacity="0.5"
                                        transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                        x="0" y="7" width="16" height="2" rx="1" />
                                </g>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body" id="kt_drawer_filter_body">
                @yield('admin_filter_form')
            </div>
            <!--end::Card body-->
            <!--begin::Card footer-->
            <!--begin::Dismiss button-->
            <button class="btn btn-light-danger drawerReset" data-kt-drawer-dismiss="true">Dismiss Filter
                drawer</button>
            <!--end::Dismiss button-->
            {{-- <div class="card-footer pt-4" id="kt_drawer_chat_footer">
                <!--begin::Input-->
                <textarea class="form-control form-control-flush mb-3" rows="1" data-kt-element="input"
                    placeholder="Type a message"></textarea>
                <!--end::Input-->
                <!--begin:Toolbar-->
                <div class="d-flex flex-stack">
                    <!--begin::Actions-->
                    <div class="d-flex align-items-center me-2">
                        <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button"
                            data-bs-toggle="tooltip" title="Coming soon">
                            <i class="bi bi-paperclip fs-3"></i>
                        </button>
                        <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button"
                            data-bs-toggle="tooltip" title="Coming soon">
                            <i class="bi bi-upload fs-3"></i>
                        </button>
                    </div>
                    <!--end::Actions-->
                    <!--begin::Send-->
                    <button class="btn btn-primary" type="button" id="kt_drawer_chat_close">Send</button>
                    <!--end::Send-->
                </div>
                <!--end::Toolbar-->
            </div> --}}
            <!--end::Card footer-->

        </div>
        <!--end::Filter Body-->
    </div>
    <!--end::View component-->
