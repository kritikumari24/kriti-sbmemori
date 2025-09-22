    @php
        if (!function_exists('checkActiveSideBar')) {
            function checkActiveSideBar(array $links)
            {
                foreach ($links as $link) {
                    if (request()->is('*admin/' . $link . '*')) {
                        return true;
                    }
                }
                return false;
            }
        }
    @endphp

    <!--begin::Aside-->
    <div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
        data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
        data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
        data-kt-drawer-toggle="#kt_aside_mobile_toggle">
        <!--begin::Brand-->
        <div class="aside-logo flex-column-auto" id="kt_aside_logo">
            <!--begin::Logo-->
            @if (file_exists(public_path('files/settings/' . $global_setting_data['logo'])))
                <a href="javascript:void(0)">
                    <img alt="Logo"
                        src="{{ isset($global_setting_data['logo']) ? asset('files/settings/' . $global_setting_data['logo'] . '') : asset('admin/dist/media/logos/favicon.ico') }}"
                        class="h-55px logo" />
                </a>
            @endif
            <!--end::Logo-->
            <!--begin::Aside toggler-->
            <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
                data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                data-kt-toggle-name="aside-minimize">
                <!--begin::Svg Icon | path: icons/duotone/Navigation/Angle-double-left.svg-->
                <span class="svg-icon svg-icon-1 rotate-180">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path
                                d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                fill="#000000" fill-rule="nonzero"
                                transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                            <path
                                d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.5"
                                transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                        </g>
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
            <!--end::Aside toggler-->
        </div>
        <!--end::Brand-->
        <!--begin::Aside menu-->
        <div class="aside-menu flex-column-fluid">
            <!--begin::Aside Menu-->
            <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
                data-kt-scroll-offset="0">
                <!--begin::Menu-->
                <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                    id="#kt_aside_menu" data-kt-menu="true">
                    <div class="menu-item">
                        <div class="menu-content pb-2">
                            <span
                                class="menu-section text-muted text-uppercase fs-8 ls-1">{{ trans_choice('content.sidebar.dashboard', 1) }}</span>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ checkActiveSideBar(['dashboard']) ? 'menu-item active' : '' }}"
                            href="{{ route('admin.dashboard') }} ">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotone/Design/PenAndRuller.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                        viewBox="0 0 24 24" version="1.1">
                                        <path
                                            d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                                            fill="#000000" opacity="0.3" />
                                        <path
                                            d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                                            fill="#000000" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ trans_choice('content.sidebar.dashboard', 1) }}</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <div class="menu-content pt-8 pb-2">
                            <span
                                class="menu-section text-muted text-uppercase fs-8 ls-1">{{ trans_choice('content.sidebar.dashboard', 1) }}</span>
                        </div>
                    </div>
                    {{-- @canany(['role-list' || 'permission-list' || 'user-list']) --}}
                    {{-- Start::User Management Section --}}
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ checkActiveSideBar(['users', 'roles', 'permissions']) ? 'hover show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotone/General/Shield-protected.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M14.5,11 C15.0522847,11 15.5,11.4477153 15.5,12 L15.5,15 C15.5,15.5522847 15.0522847,16 14.5,16 L9.5,16 C8.94771525,16 8.5,15.5522847 8.5,15 L8.5,12 C8.5,11.4477153 8.94771525,11 9.5,11 L9.5,10.5 C9.5,9.11928813 10.6192881,8 12,8 C13.3807119,8 14.5,9.11928813 14.5,10.5 L14.5,11 Z M12,9 C11.1715729,9 10.5,9.67157288 10.5,10.5 L10.5,11 L13.5,11 L13.5,10.5 C13.5,9.67157288 12.8284271,9 12,9 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ trans_choice('content.sidebar.user_management', 1) }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            {{-- @can('user-list') --}}
                            {{-- Start::User Section --}}
                            <div class="menu-item">
                                <a class="menu-link {{ checkActiveSideBar(['users']) ? 'active' : '' }}"
                                    href="{{ route('admin.users.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ trans_choice('content.sidebar.user', 1) }}</span>
                                </a>
                            </div>
                            {{-- End::User Section --}}
                            {{-- @endcan --}}
                            {{-- @can('role-list') --}}
                            {{-- Start::Role Section --}}
                            <div class="menu-item">
                                <a class="menu-link {{ checkActiveSideBar(['roles']) ? 'active' : '' }}"
                                    href="{{ route('admin.roles.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ trans_choice('content.sidebar.role', 1) }}</span>
                                </a>
                            </div>
                            {{-- End::Role Section --}}
                            {{-- @endcan --}}
                            {{-- @can('permission-list') --}}
                            {{-- Start::Permission Section --}}
                            <div class="menu-item">
                                <a class="menu-link {{ checkActiveSideBar(['permissions']) ? 'active' : '' }}"
                                    href="{{ route('admin.permissions.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span
                                        class="menu-title">{{ trans_choice('content.sidebar.permission', 1) }}</span>
                                </a>
                            </div>
                            {{-- End::Permission Section --}}
                            {{-- @endcan --}}
                        </div>
                    </div>
                    {{-- End::User Management Section --}}
                    {{-- @endcanany --}}
                    {{-- @can('customer-list') --}}
                    {{-- Start::Customer Section --}}
                    <div class="menu-item">
                        <a class="menu-link {{ checkActiveSideBar(['customers']) ? 'menu-item active' : '' }}"
                            href="{{ route('admin.customers.index') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotone/General/User.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24" />
                                            <path
                                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <path
                                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                                fill="#000000" fill-rule="nonzero" />
                                        </g>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ trans_choice('content.sidebar.customer', 2) }}</span>
                        </a>
                    </div>
                    {{-- End::Customer Section --}}
                    {{-- @endcan --}}
                    {{-- @can('product-list') --}}
                    {{-- Start::Product Section --}}
                    <div class="menu-item">
                        <a class="menu-link {{ checkActiveSideBar(['products']) ? 'menu-item active' : '' }}"
                            href="{{ route('admin.products.index') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotone/General/User.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Shopping/Bag2.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M5.94290508,4 L18.0570949,4 C18.5865712,4 19.0242774,4.41271535 19.0553693,4.94127798 L19.8754445,18.882556 C19.940307,19.9852194 19.0990032,20.9316862 17.9963398,20.9965487 C17.957234,20.9988491 17.9180691,21 17.8788957,21 L6.12110428,21 C5.01653478,21 4.12110428,20.1045695 4.12110428,19 C4.12110428,18.9608266 4.12225519,18.9216617 4.12455553,18.882556 L4.94463071,4.94127798 C4.97572263,4.41271535 5.41342877,4 5.94290508,4 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M7,7 L9,7 C9,8.65685425 10.3431458,10 12,10 C13.6568542,10 15,8.65685425 15,7 L17,7 C17,9.76142375 14.7614237,12 12,12 C9.23857625,12 7,9.76142375 7,7 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ trans_choice('content.sidebar.product', 2) }}</span>
                        </a>
                    </div>
                    {{-- End::Product Section --}}
                    {{-- @endcan --}}
                    {{-- @can('page_content-list') --}}
                    {{-- Start::Page Content Section --}}
                    <div class="menu-item">
                        <a class="menu-link {{ checkActiveSideBar(['page-contents']) ? 'menu-item active' : '' }}"
                            href="{{ route('admin.page-contents.index') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotone/General/User.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Shopping/Bag2.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M5.94290508,4 L18.0570949,4 C18.5865712,4 19.0242774,4.41271535 19.0553693,4.94127798 L19.8754445,18.882556 C19.940307,19.9852194 19.0990032,20.9316862 17.9963398,20.9965487 C17.957234,20.9988491 17.9180691,21 17.8788957,21 L6.12110428,21 C5.01653478,21 4.12110428,20.1045695 4.12110428,19 C4.12110428,18.9608266 4.12225519,18.9216617 4.12455553,18.882556 L4.94463071,4.94127798 C4.97572263,4.41271535 5.41342877,4 5.94290508,4 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M7,7 L9,7 C9,8.65685425 10.3431458,10 12,10 C13.6568542,10 15,8.65685425 15,7 L17,7 C17,9.76142375 14.7614237,12 12,12 C9.23857625,12 7,9.76142375 7,7 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ trans_choice('content.sidebar.page_content', 2) }}</span>
                        </a>
                    </div>
                    {{-- End::Page Content Section --}}
                    {{-- @endcan --}}
                    @can('faq-list')
                        {{-- Start::Faq Section --}}
                        <div class="menu-item">
                            <a class="menu-link {{ checkActiveSideBar(['faqs']) ? 'menu-item active' : '' }}"
                                href="{{ route('admin.faqs.index') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotone/General/User.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Shopping/Bag2.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M5.94290508,4 L18.0570949,4 C18.5865712,4 19.0242774,4.41271535 19.0553693,4.94127798 L19.8754445,18.882556 C19.940307,19.9852194 19.0990032,20.9316862 17.9963398,20.9965487 C17.957234,20.9988491 17.9180691,21 17.8788957,21 L6.12110428,21 C5.01653478,21 4.12110428,20.1045695 4.12110428,19 C4.12110428,18.9608266 4.12225519,18.9216617 4.12455553,18.882556 L4.94463071,4.94127798 C4.97572263,4.41271535 5.41342877,4 5.94290508,4 Z"
                                                    fill="#000000" opacity="0.3" />
                                                <path
                                                    d="M7,7 L9,7 C9,8.65685425 10.3431458,10 12,10 C13.6568542,10 15,8.65685425 15,7 L17,7 C17,9.76142375 14.7614237,12 12,12 C9.23857625,12 7,9.76142375 7,7 Z"
                                                    fill="#000000" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">{{ trans_choice('content.sidebar.faq', 2) }}</span>
                            </a>
                        </div>
                        {{-- End::Faq Section --}}
                    @endcan
                    {{-- Start::Push Notification Section --}}
                    <div class="menu-item">
                        <a class="menu-link {{ checkActiveSideBar(['pushNotifications']) ? 'menu-item active' : '' }}"
                            href="{{ route('admin.pushNotifications.index') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotone/General/User.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Shopping/Bag2.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M5.94290508,4 L18.0570949,4 C18.5865712,4 19.0242774,4.41271535 19.0553693,4.94127798 L19.8754445,18.882556 C19.940307,19.9852194 19.0990032,20.9316862 17.9963398,20.9965487 C17.957234,20.9988491 17.9180691,21 17.8788957,21 L6.12110428,21 C5.01653478,21 4.12110428,20.1045695 4.12110428,19 C4.12110428,18.9608266 4.12225519,18.9216617 4.12455553,18.882556 L4.94463071,4.94127798 C4.97572263,4.41271535 5.41342877,4 5.94290508,4 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M7,7 L9,7 C9,8.65685425 10.3431458,10 12,10 C13.6568542,10 15,8.65685425 15,7 L17,7 C17,9.76142375 14.7614237,12 12,12 C9.23857625,12 7,9.76142375 7,7 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ trans_choice('content.sidebar.push_notification', 2) }}</span>
                        </a>
                    </div>
                    {{-- End::Push Notification Section --}}

                    {{-- @can('contact_us-list') --}}
                    {{-- Start::Contact Us Section --}}
                    <div class="menu-item">
                        <a class="menu-link {{ checkActiveSideBar(['contact-us']) ? 'menu-item active' : '' }}"
                            href="{{ route('admin.contact-us.index') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotone/General/User.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Shopping/Bag2.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M5.94290508,4 L18.0570949,4 C18.5865712,4 19.0242774,4.41271535 19.0553693,4.94127798 L19.8754445,18.882556 C19.940307,19.9852194 19.0990032,20.9316862 17.9963398,20.9965487 C17.957234,20.9988491 17.9180691,21 17.8788957,21 L6.12110428,21 C5.01653478,21 4.12110428,20.1045695 4.12110428,19 C4.12110428,18.9608266 4.12225519,18.9216617 4.12455553,18.882556 L4.94463071,4.94127798 C4.97572263,4.41271535 5.41342877,4 5.94290508,4 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M7,7 L9,7 C9,8.65685425 10.3431458,10 12,10 C13.6568542,10 15,8.65685425 15,7 L17,7 C17,9.76142375 14.7614237,12 12,12 C9.23857625,12 7,9.76142375 7,7 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ trans_choice('content.sidebar.contact_us', 2) }}</span>
                        </a>
                    </div>
                    {{-- End::Contact Us Section --}}
                    {{-- @endcan --}}
                    {{-- Start::Type Section --}}
                    <div class="menu-item">
                        <a class="menu-link {{ checkActiveSideBar(['types']) ? 'menu-item active' : '' }}"
                            href="{{ route('admin.types.index') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotone/General/User.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Shopping/Bag2.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M5.94290508,4 L18.0570949,4 C18.5865712,4 19.0242774,4.41271535 19.0553693,4.94127798 L19.8754445,18.882556 C19.940307,19.9852194 19.0990032,20.9316862 17.9963398,20.9965487 C17.957234,20.9988491 17.9180691,21 17.8788957,21 L6.12110428,21 C5.01653478,21 4.12110428,20.1045695 4.12110428,19 C4.12110428,18.9608266 4.12225519,18.9216617 4.12455553,18.882556 L4.94463071,4.94127798 C4.97572263,4.41271535 5.41342877,4 5.94290508,4 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M7,7 L9,7 C9,8.65685425 10.3431458,10 12,10 C13.6568542,10 15,8.65685425 15,7 L17,7 C17,9.76142375 14.7614237,12 12,12 C9.23857625,12 7,9.76142375 7,7 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ trans_choice('content.sidebar.type', 2) }}</span>
                        </a>
                    </div>
                    {{-- End::Type Section --}}
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Aside Menu-->
        </div>
        <!--end::Aside menu-->
    </div>
    <!--end::Aside-->
