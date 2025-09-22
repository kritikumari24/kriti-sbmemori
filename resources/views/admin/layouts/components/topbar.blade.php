<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
    <!--begin::Navbar-->
    <div class="d-flex align-items-stretch" id="kt_header_nav">
        <!--begin::Menu wrapper-->
        <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu"
            data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
            data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end"
            data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend"
            data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
            <!--begin::Menu-->
            <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch"
                id="#kt_header_menu" data-kt-menu="true">
                <div class="menu-item me-lg-1">
                    <a class="menu-link active py-3" href="{{ route('admin.dashboard') }}">
                        <span class="menu-title">{{ $site_name }}</span>
                    </a>
                </div>
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::Navbar-->
    <!--begin::Topbar-->
    <div class="d-flex align-items-stretch flex-shrink-0">
        <!--begin::Toolbar wrapper-->
        <div class="d-flex align-items-stretch flex-shrink-0">

            <!--begin::User-->
            <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                <!--begin::Menu wrapper-->
                <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click"
                    data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                    <img src="{{ isset($auth_user->image) ? $auth_user->image : asset('admin/dist/media/avatars/150-26.jpg') }}"
                        alt="common_setup_user_image" />
                </div>
                <!--begin::Menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                    data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">
                            <!--begin::Avatar-->
                            @if (file_exists(public_path('files/settings/' . $global_setting_data['logo'])))
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo" src="{{ $logo_img }}" />
                                </div>
                            @endif
                            <!--end::Avatar-->
                            <!--begin::Username-->
                            <div class="d-flex flex-column">
                                <div class="fw-bolder d-flex align-items-center fs-5">
                                    {{ isset($auth_user->name) ? $auth_user->name : 'Guest' }}
                                    {{-- <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Pro</span> --}}
                                </div>
                                <a href="javascript:void(0)"
                                    class="fw-bold text-muted text-hover-primary fs-7">{{ isset($auth_user->email) ? $auth_user->email : '' }}</a>
                            </div>
                            <!--end::Username-->
                        </div>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                        <a href="{{ route('admin.profile') }}"
                            class="menu-link px-5">{{ trans_choice('content.topbar.my_profile', 1) }}</a>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start"
                        data-kt-menu-flip="bottom, top">
                        <a href="javascript:void(0)" class="menu-link px-5">
                            @if (session()->get('locale') == 'en')
                                <span
                                    class="menu-title position-relative">{{ trans_choice('content.topbar.language', 1) }}
                                    <span
                                        class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">English
                                        <img class="w-15px h-15px rounded-1 ms-2"
                                            src="{{ asset('admin/dist/media/flags/united-states.svg') }}"
                                            alt="common_setup" />
                                    </span>
                                </span>
                            @elseif(session()->get('locale') == 'gr')
                                <span
                                    class="menu-title position-relative">{{ trans_choice('content.topbar.language', 1) }}
                                    <span
                                        class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">Germany
                                        <img class="w-15px h-15px rounded-1 ms-2"
                                            src="{{ asset('admin/dist/media/flags/germany.svg') }}"
                                            alt="common_setup" />
                                    </span>
                                </span>
                            @else
                                <span
                                    class="menu-title position-relative">{{ trans_choice('content.topbar.language', 1) }}
                                    <span
                                        class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">English
                                        <img class="w-15px h-15px rounded-1 ms-2"
                                            src="{{ asset('admin/dist/media/flags/united-states.svg') }}"
                                            alt="common_setup" />
                                    </span>
                                </span>
                            @endif


                        </a>
                        <!--begin::Menu sub-->
                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)"
                                    class="menu-link d-flex px-5 {{ session()->get('locale') == 'en' ? 'active' : '' }}"
                                    id="lang_english">
                                    <span class="symbol symbol-20px me-4">
                                        <img class="rounded-1"
                                            src="{{ asset('admin/dist/media/flags/united-states.svg') }}"
                                            alt="common_setup" />
                                    </span>English
                                </a>

                                <span style="display: none" id="auth_user_id"
                                    user_id="{{ $auth_user->id }}">{{ $auth_user->id }}</span>
                                {{-- <span class="menu-link d-flex px-5 active">English</span> --}}
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" id="lang_german"
                                    class="menu-link d-flex px-5 {{ session()->get('locale') == 'gr' ? 'active' : '' }}">
                                    <span class="symbol symbol-20px me-4">
                                        <img class="rounded-1" src="{{ asset('admin/dist/media/flags/germany.svg') }}"
                                            alt="common_setup" />
                                    </span>German
                                </a>
                            </div>
                            <!--end::Menu item-->

                        </div>
                        <!--end::Menu sub-->
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5 my-1">
                        <a href="{{ route('admin.settings.edit_general') }}" class="menu-link px-5">Account
                            Settings</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <!-- <button type="submit" class="menu-link px-5">Logout</button> -->
                            <a class="menu-link px-5"
                                onclick='signout()'>{{ trans_choice('messages.sign_out', 1) }}</a>
                        </form>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    {{-- <div class="separator my-2"></div> --}}
                    <!--end::Menu separator-->
                </div>
                <!--end::Menu-->
                <!--end::Menu wrapper-->
            </div>
            <!--end::User -->
            <!--begin::Heaeder menu toggle-->
            <div class="d-flex align-items-center d-lg-none ms-2 me-n3" title="Show header menu">
                <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                    id="kt_header_menu_mobile_toggle">
                    <!--begin::Svg Icon | path: icons/duotone/Text/Toggle-Right.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M22 11.5C22 12.3284 21.3284 13 20.5 13H3.5C2.6716 13 2 12.3284 2 11.5C2 10.6716 2.6716 10 3.5 10H20.5C21.3284 10 22 10.6716 22 11.5Z"
                                    fill="black" />
                                <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M14.5 20C15.3284 20 16 19.3284 16 18.5C16 17.6716 15.3284 17 14.5 17H3.5C2.6716 17 2 17.6716 2 18.5C2 19.3284 2.6716 20 3.5 20H14.5ZM8.5 6C9.3284 6 10 5.32843 10 4.5C10 3.67157 9.3284 3 8.5 3H3.5C2.6716 3 2 3.67157 2 4.5C2 5.32843 2.6716 6 3.5 6H8.5Z"
                                    fill="black" />
                            </g>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
            </div>
            <!--end::Heaeder menu toggle-->
        </div>
        <!--end::Toolbar wrapper-->
    </div>
    <!--end::Topbar-->
</div>

@push('scripts')
    <script>
        function signout() {
            document.getElementById('logout-form').submit();
        }
        $(document).ready(function() {

            $('#lang_english').on('click', function() {
                // e.preventDefault();
                var id = $('#auth_user_id').attr('user_id');
                var language = 'en';
                console.log(id, language);
                updateLanguage(id, language);
            });

            $('#lang_german').on('click', function() {
                // e.preventDefault();
                var id = $('#auth_user_id').attr('user_id');
                var language = 'gr';
                console.log(id, language);
                updateLanguage(id, language);
            });

            function updateLanguage(id, language) {
                $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: `{{ url('/') }}/admin/update_language/` + id + `/` + language,
                        type: 'GET',
                        dataType: 'json'
                    })
                    .done(function(response) {
                        if (response.status == 1) {
                            location.reload();
                            // Swal.fire('Updated!', response.message, 'success');
                        } else {
                            Swal.fire('Info!', response.message, 'info');
                        }
                    })
                    .fail(function(data) {
                        console.log(data.status);
                        if (data.status == 403) {
                            Swal.fire('Oops...', 'You dont have the right permissions to change the language',
                                'error');
                        } else {
                            Swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                        }
                    });
            }

        });
    </script>
@endpush
