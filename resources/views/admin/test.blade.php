@extends('admin.layouts.base')
@section('content')
    @include('admin.layouts.components.header', [
        'title' => trans_choice('content.dashboard', 1),
        'breadcrumbs' => Breadcrumbs::render('admin.dashboard'),
    ])

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">
                <!--begin::Sidebar-->
                @include('admin.user.oldnavbarsidebar')
                <!--end::Sidebar-->
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-15">
                    <!--begin:::Tabs-->
                    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                href="#kt_user_view_overview_tab">Overview</a>
                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab"
                                href="#kt_user_view_overview_security">Security</a>
                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                href="#kt_user_view_overview_events_and_logs_tab">Events &amp; Logs</a>
                        </li>
                        <!--end:::Tab item-->
                    </ul>
                    <!--end:::Tabs-->
                    <!--begin:::Tab content-->
                    <div class="tab-content" id="myTabContent">
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_user_view_overview_tab" role="tabpanel">
                            <!--begin::Card-->
                            <div class="card card-flush mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header mt-6">
                                    <!--begin::Card title-->
                                    <div class="card-title flex-column">
                                        <h2 class="mb-1">User's Schedule</h2>
                                        <div class="fs-6 fw-bold text-muted">2 upcoming meetings</div>
                                    </div>
                                    <!--end::Card title-->
                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <button type="button" class="btn btn-light-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_add_schedule">
                                            <!--begin::Svg Icon | path: icons/duotone/Interface/Insert.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.25"
                                                        d="M4 4H20V19C20 20.6569 18.6569 22 17 22H7C5.34315 22 4 20.6569 4 19V4Z"
                                                        fill="#12131A" />
                                                    <path
                                                        d="M12.7071 7.29289C12.3166 6.90237 11.6834 6.90237 11.2929 7.29289L8.29289 10.2929C7.90237 10.6834 7.90237 11.3166 8.29289 11.7071C8.68342 12.0976 9.31658 12.0976 9.70711 11.7071L11 10.4142V17C11 17.5523 11.4477 18 12 18C12.5523 18 13 17.5523 13 17V10.4142L14.2929 11.7071C14.6834 12.0976 15.3166 12.0976 15.7071 11.7071C16.0976 11.3166 16.0976 10.6834 15.7071 10.2929L12.7071 7.29289Z"
                                                        fill="#12131A" />
                                                    <path
                                                        d="M2 3C2 2.44772 2.44772 2 3 2H21C21.5523 2 22 2.44772 22 3V3C22 3.55228 21.5523 4 21 4H3C2.44772 4 2 3.55228 2 3V3Z"
                                                        fill="#12131A" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->Add Schedule
                                        </button>
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body p-9 pt-4">
                                    <!--begin::Dates-->
                                    <ul class="nav nav-pills d-flex flex-nowrap hover-scroll-x py-2">
                                        <!--begin::Date-->
                                        <li class="nav-item me-1">
                                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary"
                                                data-bs-toggle="tab" href="#kt_schedule_day_0">
                                                <span class="opacity-50 fs-7 fw-bold">Su</span>
                                                <span class="fs-6 fw-boldest">21</span>
                                            </a>
                                        </li>
                                        <!--end::Date-->
                                        <!--begin::Date-->
                                        <li class="nav-item me-1">
                                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary active"
                                                data-bs-toggle="tab" href="#kt_schedule_day_1">
                                                <span class="opacity-50 fs-7 fw-bold">Mo</span>
                                                <span class="fs-6 fw-boldest">22</span>
                                            </a>
                                        </li>
                                        <!--end::Date-->
                                        <!--begin::Date-->
                                        <li class="nav-item me-1">
                                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary"
                                                data-bs-toggle="tab" href="#kt_schedule_day_2">
                                                <span class="opacity-50 fs-7 fw-bold">Tu</span>
                                                <span class="fs-6 fw-boldest">23</span>
                                            </a>
                                        </li>
                                        <!--end::Date-->
                                        <!--begin::Date-->
                                        <li class="nav-item me-1">
                                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary"
                                                data-bs-toggle="tab" href="#kt_schedule_day_3">
                                                <span class="opacity-50 fs-7 fw-bold">We</span>
                                                <span class="fs-6 fw-boldest">24</span>
                                            </a>
                                        </li>
                                        <!--end::Date-->
                                        <!--begin::Date-->
                                        <li class="nav-item me-1">
                                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary"
                                                data-bs-toggle="tab" href="#kt_schedule_day_4">
                                                <span class="opacity-50 fs-7 fw-bold">Th</span>
                                                <span class="fs-6 fw-boldest">25</span>
                                            </a>
                                        </li>
                                        <!--end::Date-->
                                        <!--begin::Date-->
                                        <li class="nav-item me-1">
                                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary"
                                                data-bs-toggle="tab" href="#kt_schedule_day_5">
                                                <span class="opacity-50 fs-7 fw-bold">Fr</span>
                                                <span class="fs-6 fw-boldest">26</span>
                                            </a>
                                        </li>
                                        <!--end::Date-->
                                        <!--begin::Date-->
                                        <li class="nav-item me-1">
                                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary"
                                                data-bs-toggle="tab" href="#kt_schedule_day_6">
                                                <span class="opacity-50 fs-7 fw-bold">Sa</span>
                                                <span class="fs-6 fw-boldest">27</span>
                                            </a>
                                        </li>
                                        <!--end::Date-->
                                        <!--begin::Date-->
                                        <li class="nav-item me-1">
                                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary"
                                                data-bs-toggle="tab" href="#kt_schedule_day_7">
                                                <span class="opacity-50 fs-7 fw-bold">Su</span>
                                                <span class="fs-6 fw-boldest">28</span>
                                            </a>
                                        </li>
                                        <!--end::Date-->
                                        <!--begin::Date-->
                                        <li class="nav-item me-1">
                                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary"
                                                data-bs-toggle="tab" href="#kt_schedule_day_8">
                                                <span class="opacity-50 fs-7 fw-bold">Mo</span>
                                                <span class="fs-6 fw-boldest">29</span>
                                            </a>
                                        </li>
                                        <!--end::Date-->
                                        <!--begin::Date-->
                                        <li class="nav-item me-1">
                                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary"
                                                data-bs-toggle="tab" href="#kt_schedule_day_9">
                                                <span class="opacity-50 fs-7 fw-bold">Tu</span>
                                                <span class="fs-6 fw-boldest">30</span>
                                            </a>
                                        </li>
                                        <!--end::Date-->
                                        <!--begin::Date-->
                                        <li class="nav-item me-1">
                                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary"
                                                data-bs-toggle="tab" href="#kt_schedule_day_10">
                                                <span class="opacity-50 fs-7 fw-bold">We</span>
                                                <span class="fs-6 fw-boldest">31</span>
                                            </a>
                                        </li>
                                        <!--end::Date-->
                                    </ul>
                                    <!--end::Dates-->
                                    <!--begin::Tab Content-->
                                    <div class="tab-content">
                                        <!--begin::Day-->
                                        <div id="kt_schedule_day_0" class="tab-pane fade show">
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">11:00 - 11:45
                                                        <span class="fs-7 text-muted text-uppercase">am</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Project
                                                        Review &amp; Testing</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Kendell Trevor</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">12:00 - 13:00
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Development
                                                        Team Capacity Review</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Walter White</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">13:00 - 14:00
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Weekly
                                                        Team Stand-Up</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Peter Marcus</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">9:00 - 10:00
                                                        <span class="fs-7 text-muted text-uppercase">am</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Dashboard
                                                        UI/UX Design Review</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Walter White</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                        </div>
                                        <!--end::Day-->
                                        <!--begin::Day-->
                                        <div id="kt_schedule_day_1" class="tab-pane fade show active">
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">16:30 - 17:30
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Creative
                                                        Content Initiative</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Bob Harris</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">11:00 - 11:45
                                                        <span class="fs-7 text-muted text-uppercase">am</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Dashboard
                                                        UI/UX Design Review</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Sean Bean</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">10:00 - 11:00
                                                        <span class="fs-7 text-muted text-uppercase">am</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Team
                                                        Backlog Grooming Session</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Sean Bean</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">11:00 - 11:45
                                                        <span class="fs-7 text-muted text-uppercase">am</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Creative
                                                        Content Initiative</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Kendell Trevor</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">13:00 - 14:00
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Creative
                                                        Content Initiative</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Yannis Gloverson</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                        </div>
                                        <!--end::Day-->
                                        <!--begin::Day-->
                                        <div id="kt_schedule_day_2" class="tab-pane fade show">
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">11:00 - 11:45
                                                        <span class="fs-7 text-muted text-uppercase">am</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Dashboard
                                                        UI/UX Design Review</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Michael Walters</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">13:00 - 14:00
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">9
                                                        Degree Project Estimation Meeting</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Terry Robins</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">13:00 - 14:00
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Weekly
                                                        Team Stand-Up</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Kendell Trevor</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                        </div>
                                        <!--end::Day-->
                                        <!--begin::Day-->
                                        <div id="kt_schedule_day_3" class="tab-pane fade show">
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">16:30 - 17:30
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Dashboard
                                                        UI/UX Design Review</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Terry Robins</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">13:00 - 14:00
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Lunch
                                                        &amp; Learn Catch Up</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Yannis Gloverson</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">13:00 - 14:00
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">9
                                                        Degree Project Estimation Meeting</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Karina Clarke</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">11:00 - 11:45
                                                        <span class="fs-7 text-muted text-uppercase">am</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Marketing
                                                        Campaign Discussion</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Kendell Trevor</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">12:00 - 13:00
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">9
                                                        Degree Project Estimation Meeting</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">David Stevenson</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                        </div>
                                        <!--end::Day-->
                                        <!--begin::Day-->
                                        <div id="kt_schedule_day_4" class="tab-pane fade show">
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">13:00 - 14:00
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Lunch
                                                        &amp; Learn Catch Up</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Karina Clarke</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">14:30 - 15:30
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">9
                                                        Degree Project Estimation Meeting</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Terry Robins</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">14:30 - 15:30
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">9
                                                        Degree Project Estimation Meeting</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Naomi Hayabusa</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">16:30 - 17:30
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Sales
                                                        Pitch Proposal</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Karina Clarke</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">14:30 - 15:30
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Sales
                                                        Pitch Proposal</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">David Stevenson</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                        </div>
                                        <!--end::Day-->
                                        <!--begin::Day-->
                                        <div id="kt_schedule_day_5" class="tab-pane fade show">
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">13:00 - 14:00
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Weekly
                                                        Team Stand-Up</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Walter White</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">12:00 - 13:00
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Sales
                                                        Pitch Proposal</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Bob Harris</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">9:00 - 10:00
                                                        <span class="fs-7 text-muted text-uppercase">am</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">9
                                                        Degree Project Estimation Meeting</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">David Stevenson</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">9:00 - 10:00
                                                        <span class="fs-7 text-muted text-uppercase">am</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Weekly
                                                        Team Stand-Up</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Kendell Trevor</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                        </div>
                                        <!--end::Day-->
                                        <!--begin::Day-->
                                        <div id="kt_schedule_day_6" class="tab-pane fade show">
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">16:30 - 17:30
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Dashboard
                                                        UI/UX Design Review</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Michael Walters</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">16:30 - 17:30
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Committee
                                                        Review Approvals</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Karina Clarke</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">9:00 - 10:00
                                                        <span class="fs-7 text-muted text-uppercase">am</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Weekly
                                                        Team Stand-Up</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Caleb Donaldson</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">12:00 - 13:00
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Team
                                                        Backlog Grooming Session</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Yannis Gloverson</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                        </div>
                                        <!--end::Day-->
                                        <!--begin::Day-->
                                        <div id="kt_schedule_day_7" class="tab-pane fade show">
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">9:00 - 10:00
                                                        <span class="fs-7 text-muted text-uppercase">am</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Sales
                                                        Pitch Proposal</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Sean Bean</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">9:00 - 10:00
                                                        <span class="fs-7 text-muted text-uppercase">am</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Team
                                                        Backlog Grooming Session</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Yannis Gloverson</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">16:30 - 17:30
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Team
                                                        Backlog Grooming Session</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Peter Marcus</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                        </div>
                                        <!--end::Day-->
                                        <!--begin::Day-->
                                        <div id="kt_schedule_day_8" class="tab-pane fade show">
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">14:30 - 15:30
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Team
                                                        Backlog Grooming Session</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Terry Robins</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">9:00 - 10:00
                                                        <span class="fs-7 text-muted text-uppercase">am</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Sales
                                                        Pitch Proposal</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Walter White</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">9:00 - 10:00
                                                        <span class="fs-7 text-muted text-uppercase">am</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Project
                                                        Review &amp; Testing</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Yannis Gloverson</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">16:30 - 17:30
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Lunch
                                                        &amp; Learn Catch Up</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Naomi Hayabusa</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                        </div>
                                        <!--end::Day-->
                                        <!--begin::Day-->
                                        <div id="kt_schedule_day_9" class="tab-pane fade show">
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">10:00 - 11:00
                                                        <span class="fs-7 text-muted text-uppercase">am</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Committee
                                                        Review Approvals</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Walter White</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">9:00 - 10:00
                                                        <span class="fs-7 text-muted text-uppercase">am</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Weekly
                                                        Team Stand-Up</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Mark Randall</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">13:00 - 14:00
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Dashboard
                                                        UI/UX Design Review</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Yannis Gloverson</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">13:00 - 14:00
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Sales
                                                        Pitch Proposal</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Sean Bean</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">11:00 - 11:45
                                                        <span class="fs-7 text-muted text-uppercase">am</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Marketing
                                                        Campaign Discussion</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Naomi Hayabusa</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                        </div>
                                        <!--end::Day-->
                                        <!--begin::Day-->
                                        <div id="kt_schedule_day_10" class="tab-pane fade show">
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">14:30 - 15:30
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Development
                                                        Team Capacity Review</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Michael Walters</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">10:00 - 11:00
                                                        <span class="fs-7 text-muted text-uppercase">am</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Development
                                                        Team Capacity Review</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Peter Marcus</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">12:00 - 13:00
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Project
                                                        Review &amp; Testing</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Mark Randall</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">10:00 - 11:00
                                                        <span class="fs-7 text-muted text-uppercase">am</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Project
                                                        Review &amp; Testing</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Caleb Donaldson</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Time-->
                                            <div class="d-flex flex-stack position-relative mt-6">
                                                <!--begin::Bar-->
                                                <div
                                                    class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0">
                                                </div>
                                                <!--end::Bar-->
                                                <!--begin::Info-->
                                                <div class="fw-bold ms-5">
                                                    <!--begin::Time-->
                                                    <div class="fs-7 mb-1">13:00 - 14:00
                                                        <span class="fs-7 text-muted text-uppercase">pm</span>
                                                    </div>
                                                    <!--end::Time-->
                                                    <!--begin::Title-->
                                                    <a href="#"
                                                        class="fs-5 fw-bolder text-dark text-hover-primary mb-2">Dashboard
                                                        UI/UX Design Review</a>
                                                    <!--end::Title-->
                                                    <!--begin::User-->
                                                    <div class="fs-7 text-muted">Lead by
                                                        <a href="#">Kendell Trevor</a>
                                                    </div>
                                                    <!--end::User-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Action-->
                                                <a href="#"
                                                    class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Time-->
                                        </div>
                                        <!--end::Day-->
                                    </div>
                                    <!--end::Tab Content-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                            <!--begin::Tasks-->
                            <div class="card card-flush mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header mt-6">
                                    <!--begin::Card title-->
                                    <div class="card-title flex-column">
                                        <h2 class="mb-1">User's Tasks</h2>
                                        <div class="fs-6 fw-bold text-muted">Total 25 tasks in backlog</div>
                                    </div>
                                    <!--end::Card title-->
                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <button type="button" class="btn btn-light-primary btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#kt_modal_add_task">
                                            <!--begin::Svg Icon | path: icons/duotone/Interface/File-Plus.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.25"
                                                        d="M3 4C3 2.34315 4.34315 1 6 1H15.7574C16.553 1 17.3161 1.31607 17.8787 1.87868L20.1213 4.12132C20.6839 4.68393 21 5.44699 21 6.24264V20C21 21.6569 19.6569 23 18 23H6C4.34315 23 3 21.6569 3 20V4Z"
                                                        fill="#12131A" />
                                                    <path
                                                        d="M15 1.89181C15 1.39927 15.3993 1 15.8918 1V1C16.6014 1 17.2819 1.28187 17.7836 1.78361L20.2164 4.21639C20.7181 4.71813 21 5.39863 21 6.10819V6.10819C21 6.60073 20.6007 7 20.1082 7H16C15.4477 7 15 6.55228 15 6V1.89181Z"
                                                        fill="#12131A" />
                                                    <path
                                                        d="M13 11C13 10.4477 12.5523 10 12 10C11.4477 10 11 10.4477 11 11V13H9C8.44771 13 8 13.4477 8 14C8 14.5523 8.44771 15 9 15H11V17C11 17.5523 11.4477 18 12 18C12.5523 18 13 17.5523 13 17V15H15C15.5523 15 16 14.5523 16 14C16 13.4477 15.5523 13 15 13H13V11Z"
                                                        fill="#12131A" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->Add Task
                                        </button>
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body d-flex flex-column">
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center position-relative mb-7">
                                        <!--begin::Label-->
                                        <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px">
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Details-->
                                        <div class="fw-bold ms-5">
                                            <a href="#" class="fs-5 fw-bolder text-dark text-hover-primary">Create
                                                FureStibe branding logo</a>
                                            <!--begin::Info-->
                                            <div class="fs-7 text-muted">Due in 1 day
                                                <a href="#">Karina Clark</a>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Details-->
                                        <!--begin::Menu-->
                                        <button type="button"
                                            class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                            data-kt-menu-flip="top-end">
                                            <!--begin::Svg Icon | path: icons/duotone/Interface/Settings-02.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.25"
                                                        d="M2 6.5C2 4.01472 4.01472 2 6.5 2H17.5C19.9853 2 22 4.01472 22 6.5V6.5C22 8.98528 19.9853 11 17.5 11H6.5C4.01472 11 2 8.98528 2 6.5V6.5Z"
                                                        fill="#12131A" />
                                                    <path
                                                        d="M20 6.5C20 7.88071 18.8807 9 17.5 9C16.1193 9 15 7.88071 15 6.5C15 5.11929 16.1193 4 17.5 4C18.8807 4 20 5.11929 20 6.5Z"
                                                        fill="#12131A" />
                                                    <path opacity="0.25"
                                                        d="M2 17.5C2 15.0147 4.01472 13 6.5 13H17.5C19.9853 13 22 15.0147 22 17.5V17.5C22 19.9853 19.9853 22 17.5 22H6.5C4.01472 22 2 19.9853 2 17.5V17.5Z"
                                                        fill="#12131A" />
                                                    <path
                                                        d="M9 17.5C9 18.8807 7.88071 20 6.5 20C5.11929 20 4 18.8807 4 17.5C4 16.1193 5.11929 15 6.5 15C7.88071 15 9 16.1193 9 17.5Z"
                                                        fill="#12131A" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--begin::Task menu-->
                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                            data-kt-menu="true" data-kt-menu-id="kt-users-tasks">
                                            <!--begin::Header-->
                                            <div class="px-7 py-5">
                                                <div class="fs-5 text-dark fw-bolder">Update Status</div>
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Menu separator-->
                                            <div class="separator border-gray-200"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Form-->
                                            <form class="form px-7 py-5" data-kt-menu-id="kt-users-tasks-form">
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-10">
                                                    <!--begin::Label-->
                                                    <label class="form-label fs-6 fw-bold">Status:</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select class="form-select form-select-solid" name="task_status"
                                                        data-kt-select2="true" data-placeholder="Select option"
                                                        data-allow-clear="true" data-hide-search="true">
                                                        <option></option>
                                                        <option value="1">Approved</option>
                                                        <option value="2">Pending</option>
                                                        <option value="3">In Process</option>
                                                        <option value="4">Rejected</option>
                                                    </select>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Actions-->
                                                <div class="d-flex justify-content-end">
                                                    <button type="button"
                                                        class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                        data-kt-users-update-task-status="reset">Reset</button>
                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                        data-kt-users-update-task-status="submit">
                                                        <span class="indicator-label">Apply</span>
                                                        <span class="indicator-progress">Please wait...
                                                            <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                    </button>
                                                </div>
                                                <!--end::Actions-->
                                            </form>
                                            <!--end::Form-->
                                        </div>
                                        <!--end::Task menu-->
                                        <!--end::Menu-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center position-relative mb-7">
                                        <!--begin::Label-->
                                        <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px">
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Details-->
                                        <div class="fw-bold ms-5">
                                            <a href="#" class="fs-5 fw-bolder text-dark text-hover-primary">Schedule
                                                a
                                                meeting with FireBear CTO John</a>
                                            <!--begin::Info-->
                                            <div class="fs-7 text-muted">Due in 3 days
                                                <a href="#">Rober Doe</a>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Details-->
                                        <!--begin::Menu-->
                                        <button type="button"
                                            class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                            data-kt-menu-flip="top-end">
                                            <!--begin::Svg Icon | path: icons/duotone/Interface/Settings-02.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.25"
                                                        d="M2 6.5C2 4.01472 4.01472 2 6.5 2H17.5C19.9853 2 22 4.01472 22 6.5V6.5C22 8.98528 19.9853 11 17.5 11H6.5C4.01472 11 2 8.98528 2 6.5V6.5Z"
                                                        fill="#12131A" />
                                                    <path
                                                        d="M20 6.5C20 7.88071 18.8807 9 17.5 9C16.1193 9 15 7.88071 15 6.5C15 5.11929 16.1193 4 17.5 4C18.8807 4 20 5.11929 20 6.5Z"
                                                        fill="#12131A" />
                                                    <path opacity="0.25"
                                                        d="M2 17.5C2 15.0147 4.01472 13 6.5 13H17.5C19.9853 13 22 15.0147 22 17.5V17.5C22 19.9853 19.9853 22 17.5 22H6.5C4.01472 22 2 19.9853 2 17.5V17.5Z"
                                                        fill="#12131A" />
                                                    <path
                                                        d="M9 17.5C9 18.8807 7.88071 20 6.5 20C5.11929 20 4 18.8807 4 17.5C4 16.1193 5.11929 15 6.5 15C7.88071 15 9 16.1193 9 17.5Z"
                                                        fill="#12131A" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--begin::Task menu-->
                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                            data-kt-menu="true" data-kt-menu-id="kt-users-tasks">
                                            <!--begin::Header-->
                                            <div class="px-7 py-5">
                                                <div class="fs-5 text-dark fw-bolder">Update Status</div>
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Menu separator-->
                                            <div class="separator border-gray-200"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Form-->
                                            <form class="form px-7 py-5" data-kt-menu-id="kt-users-tasks-form">
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-10">
                                                    <!--begin::Label-->
                                                    <label class="form-label fs-6 fw-bold">Status:</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select class="form-select form-select-solid" name="task_status"
                                                        data-kt-select2="true" data-placeholder="Select option"
                                                        data-allow-clear="true" data-hide-search="true">
                                                        <option></option>
                                                        <option value="1">Approved</option>
                                                        <option value="2">Pending</option>
                                                        <option value="3">In Process</option>
                                                        <option value="4">Rejected</option>
                                                    </select>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Actions-->
                                                <div class="d-flex justify-content-end">
                                                    <button type="button"
                                                        class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                        data-kt-users-update-task-status="reset">Reset</button>
                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                        data-kt-users-update-task-status="submit">
                                                        <span class="indicator-label">Apply</span>
                                                        <span class="indicator-progress">Please wait...
                                                            <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                    </button>
                                                </div>
                                                <!--end::Actions-->
                                            </form>
                                            <!--end::Form-->
                                        </div>
                                        <!--end::Task menu-->
                                        <!--end::Menu-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center position-relative mb-7">
                                        <!--begin::Label-->
                                        <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px">
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Details-->
                                        <div class="fw-bold ms-5">
                                            <a href="#" class="fs-5 fw-bolder text-dark text-hover-primary">9 Degree
                                                Project Estimation</a>
                                            <!--begin::Info-->
                                            <div class="fs-7 text-muted">Due in 1 week
                                                <a href="#">Neil Owen</a>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Details-->
                                        <!--begin::Menu-->
                                        <button type="button"
                                            class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                            data-kt-menu-flip="top-end">
                                            <!--begin::Svg Icon | path: icons/duotone/Interface/Settings-02.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.25"
                                                        d="M2 6.5C2 4.01472 4.01472 2 6.5 2H17.5C19.9853 2 22 4.01472 22 6.5V6.5C22 8.98528 19.9853 11 17.5 11H6.5C4.01472 11 2 8.98528 2 6.5V6.5Z"
                                                        fill="#12131A" />
                                                    <path
                                                        d="M20 6.5C20 7.88071 18.8807 9 17.5 9C16.1193 9 15 7.88071 15 6.5C15 5.11929 16.1193 4 17.5 4C18.8807 4 20 5.11929 20 6.5Z"
                                                        fill="#12131A" />
                                                    <path opacity="0.25"
                                                        d="M2 17.5C2 15.0147 4.01472 13 6.5 13H17.5C19.9853 13 22 15.0147 22 17.5V17.5C22 19.9853 19.9853 22 17.5 22H6.5C4.01472 22 2 19.9853 2 17.5V17.5Z"
                                                        fill="#12131A" />
                                                    <path
                                                        d="M9 17.5C9 18.8807 7.88071 20 6.5 20C5.11929 20 4 18.8807 4 17.5C4 16.1193 5.11929 15 6.5 15C7.88071 15 9 16.1193 9 17.5Z"
                                                        fill="#12131A" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--begin::Task menu-->
                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                            data-kt-menu="true" data-kt-menu-id="kt-users-tasks">
                                            <!--begin::Header-->
                                            <div class="px-7 py-5">
                                                <div class="fs-5 text-dark fw-bolder">Update Status</div>
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Menu separator-->
                                            <div class="separator border-gray-200"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Form-->
                                            <form class="form px-7 py-5" data-kt-menu-id="kt-users-tasks-form">
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-10">
                                                    <!--begin::Label-->
                                                    <label class="form-label fs-6 fw-bold">Status:</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select class="form-select form-select-solid" name="task_status"
                                                        data-kt-select2="true" data-placeholder="Select option"
                                                        data-allow-clear="true" data-hide-search="true">
                                                        <option></option>
                                                        <option value="1">Approved</option>
                                                        <option value="2">Pending</option>
                                                        <option value="3">In Process</option>
                                                        <option value="4">Rejected</option>
                                                    </select>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Actions-->
                                                <div class="d-flex justify-content-end">
                                                    <button type="button"
                                                        class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                        data-kt-users-update-task-status="reset">Reset</button>
                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                        data-kt-users-update-task-status="submit">
                                                        <span class="indicator-label">Apply</span>
                                                        <span class="indicator-progress">Please wait...
                                                            <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                    </button>
                                                </div>
                                                <!--end::Actions-->
                                            </form>
                                            <!--end::Form-->
                                        </div>
                                        <!--end::Task menu-->
                                        <!--end::Menu-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center position-relative mb-7">
                                        <!--begin::Label-->
                                        <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px">
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Details-->
                                        <div class="fw-bold ms-5">
                                            <a href="#"
                                                class="fs-5 fw-bolder text-dark text-hover-primary">Dashboard UI
                                                &amp; UX for Leafr CRM</a>
                                            <!--begin::Info-->
                                            <div class="fs-7 text-muted">Due in 1 week
                                                <a href="#">Olivia Wild</a>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Details-->
                                        <!--begin::Menu-->
                                        <button type="button"
                                            class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                            data-kt-menu-flip="top-end">
                                            <!--begin::Svg Icon | path: icons/duotone/Interface/Settings-02.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.25"
                                                        d="M2 6.5C2 4.01472 4.01472 2 6.5 2H17.5C19.9853 2 22 4.01472 22 6.5V6.5C22 8.98528 19.9853 11 17.5 11H6.5C4.01472 11 2 8.98528 2 6.5V6.5Z"
                                                        fill="#12131A" />
                                                    <path
                                                        d="M20 6.5C20 7.88071 18.8807 9 17.5 9C16.1193 9 15 7.88071 15 6.5C15 5.11929 16.1193 4 17.5 4C18.8807 4 20 5.11929 20 6.5Z"
                                                        fill="#12131A" />
                                                    <path opacity="0.25"
                                                        d="M2 17.5C2 15.0147 4.01472 13 6.5 13H17.5C19.9853 13 22 15.0147 22 17.5V17.5C22 19.9853 19.9853 22 17.5 22H6.5C4.01472 22 2 19.9853 2 17.5V17.5Z"
                                                        fill="#12131A" />
                                                    <path
                                                        d="M9 17.5C9 18.8807 7.88071 20 6.5 20C5.11929 20 4 18.8807 4 17.5C4 16.1193 5.11929 15 6.5 15C7.88071 15 9 16.1193 9 17.5Z"
                                                        fill="#12131A" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--begin::Task menu-->
                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                            data-kt-menu="true" data-kt-menu-id="kt-users-tasks">
                                            <!--begin::Header-->
                                            <div class="px-7 py-5">
                                                <div class="fs-5 text-dark fw-bolder">Update Status</div>
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Menu separator-->
                                            <div class="separator border-gray-200"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Form-->
                                            <form class="form px-7 py-5" data-kt-menu-id="kt-users-tasks-form">
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-10">
                                                    <!--begin::Label-->
                                                    <label class="form-label fs-6 fw-bold">Status:</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select class="form-select form-select-solid" name="task_status"
                                                        data-kt-select2="true" data-placeholder="Select option"
                                                        data-allow-clear="true" data-hide-search="true">
                                                        <option></option>
                                                        <option value="1">Approved</option>
                                                        <option value="2">Pending</option>
                                                        <option value="3">In Process</option>
                                                        <option value="4">Rejected</option>
                                                    </select>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Actions-->
                                                <div class="d-flex justify-content-end">
                                                    <button type="button"
                                                        class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                        data-kt-users-update-task-status="reset">Reset</button>
                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                        data-kt-users-update-task-status="submit">
                                                        <span class="indicator-label">Apply</span>
                                                        <span class="indicator-progress">Please wait...
                                                            <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                    </button>
                                                </div>
                                                <!--end::Actions-->
                                            </form>
                                            <!--end::Form-->
                                        </div>
                                        <!--end::Task menu-->
                                        <!--end::Menu-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center position-relative">
                                        <!--begin::Label-->
                                        <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px">
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Details-->
                                        <div class="fw-bold ms-5">
                                            <a href="#" class="fs-5 fw-bolder text-dark text-hover-primary">Mivy App
                                                R&amp;D, Meeting with clients</a>
                                            <!--begin::Info-->
                                            <div class="fs-7 text-muted">Due in 2 weeks
                                                <a href="#">Sean Bean</a>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Details-->
                                        <!--begin::Menu-->
                                        <button type="button"
                                            class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                            data-kt-menu-flip="top-end">
                                            <!--begin::Svg Icon | path: icons/duotone/Interface/Settings-02.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.25"
                                                        d="M2 6.5C2 4.01472 4.01472 2 6.5 2H17.5C19.9853 2 22 4.01472 22 6.5V6.5C22 8.98528 19.9853 11 17.5 11H6.5C4.01472 11 2 8.98528 2 6.5V6.5Z"
                                                        fill="#12131A" />
                                                    <path
                                                        d="M20 6.5C20 7.88071 18.8807 9 17.5 9C16.1193 9 15 7.88071 15 6.5C15 5.11929 16.1193 4 17.5 4C18.8807 4 20 5.11929 20 6.5Z"
                                                        fill="#12131A" />
                                                    <path opacity="0.25"
                                                        d="M2 17.5C2 15.0147 4.01472 13 6.5 13H17.5C19.9853 13 22 15.0147 22 17.5V17.5C22 19.9853 19.9853 22 17.5 22H6.5C4.01472 22 2 19.9853 2 17.5V17.5Z"
                                                        fill="#12131A" />
                                                    <path
                                                        d="M9 17.5C9 18.8807 7.88071 20 6.5 20C5.11929 20 4 18.8807 4 17.5C4 16.1193 5.11929 15 6.5 15C7.88071 15 9 16.1193 9 17.5Z"
                                                        fill="#12131A" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--begin::Task menu-->
                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                            data-kt-menu="true" data-kt-menu-id="kt-users-tasks">
                                            <!--begin::Header-->
                                            <div class="px-7 py-5">
                                                <div class="fs-5 text-dark fw-bolder">Update Status</div>
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Menu separator-->
                                            <div class="separator border-gray-200"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Form-->
                                            <form class="form px-7 py-5" data-kt-menu-id="kt-users-tasks-form">
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-10">
                                                    <!--begin::Label-->
                                                    <label class="form-label fs-6 fw-bold">Status:</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select class="form-select form-select-solid" name="task_status"
                                                        data-kt-select2="true" data-placeholder="Select option"
                                                        data-allow-clear="true" data-hide-search="true">
                                                        <option></option>
                                                        <option value="1">Approved</option>
                                                        <option value="2">Pending</option>
                                                        <option value="3">In Process</option>
                                                        <option value="4">Rejected</option>
                                                    </select>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Actions-->
                                                <div class="d-flex justify-content-end">
                                                    <button type="button"
                                                        class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                        data-kt-users-update-task-status="reset">Reset</button>
                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                        data-kt-users-update-task-status="submit">
                                                        <span class="indicator-label">Apply</span>
                                                        <span class="indicator-progress">Please wait...
                                                            <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                    </button>
                                                </div>
                                                <!--end::Actions-->
                                            </form>
                                            <!--end::Form-->
                                        </div>
                                        <!--end::Task menu-->
                                        <!--end::Menu-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Tasks-->
                        </div>
                        <!--end:::Tab pane-->
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade" id="kt_user_view_overview_security" role="tabpanel">
                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Profile</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0 pb-5">
                                    <!--begin::Table wrapper-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed gy-5"
                                            id="kt_table_users_login_session">
                                            <!--begin::Table body-->
                                            <tbody class="fs-6 fw-bold text-gray-600">
                                                <tr>
                                                    <td>Email</td>
                                                    <td>e.smith@kpmg.com.au</td>
                                                    <td class="text-end">
                                                        <button type="button"
                                                            class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#kt_modal_update_email">
                                                            <!--begin::Svg Icon | path: icons/duotone/Interface/Edit.svg-->
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <rect opacity="0.25" x="3" y="21" width="18"
                                                                        height="2" rx="1" fill="#191213" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M4.08576 11.5L3.58579 12C3.21071 12.375 3 12.8838 3 13.4142V17C3 18.1045 3.89543 19 5 19H8.58579C9.11622 19 9.62493 18.7893 10 18.4142L10.5 17.9142L4.08576 11.5Z"
                                                                        fill="#121319" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M5.5 10.0858L11.5858 4L18 10.4142L11.9142 16.5L5.5 10.0858Z"
                                                                        fill="#121319" />
                                                                    <path opacity="0.25" fill-rule="evenodd"
                                                                        clip-rule="evenodd"
                                                                        d="M18.1214 1.70705C16.9498 0.535476 15.0503 0.535476 13.8787 1.70705L13 2.58576L19.4142 8.99997L20.2929 8.12126C21.4645 6.94969 21.4645 5.0502 20.2929 3.87862L18.1214 1.70705Z"
                                                                        fill="#191213" />
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Password</td>
                                                    <td>******</td>
                                                    <td class="text-end">
                                                        <button type="button"
                                                            class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#kt_modal_update_password">
                                                            <!--begin::Svg Icon | path: icons/duotone/Interface/Edit.svg-->
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <rect opacity="0.25" x="3" y="21" width="18"
                                                                        height="2" rx="1" fill="#191213" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M4.08576 11.5L3.58579 12C3.21071 12.375 3 12.8838 3 13.4142V17C3 18.1045 3.89543 19 5 19H8.58579C9.11622 19 9.62493 18.7893 10 18.4142L10.5 17.9142L4.08576 11.5Z"
                                                                        fill="#121319" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M5.5 10.0858L11.5858 4L18 10.4142L11.9142 16.5L5.5 10.0858Z"
                                                                        fill="#121319" />
                                                                    <path opacity="0.25" fill-rule="evenodd"
                                                                        clip-rule="evenodd"
                                                                        d="M18.1214 1.70705C16.9498 0.535476 15.0503 0.535476 13.8787 1.70705L13 2.58576L19.4142 8.99997L20.2929 8.12126C21.4645 6.94969 21.4645 5.0502 20.2929 3.87862L18.1214 1.70705Z"
                                                                        fill="#191213" />
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Role</td>
                                                    <td>Administrator</td>
                                                    <td class="text-end">
                                                        <button type="button"
                                                            class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#kt_modal_update_role">
                                                            <!--begin::Svg Icon | path: icons/duotone/Interface/Edit.svg-->
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <rect opacity="0.25" x="3" y="21" width="18"
                                                                        height="2" rx="1"
                                                                        fill="#191213" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M4.08576 11.5L3.58579 12C3.21071 12.375 3 12.8838 3 13.4142V17C3 18.1045 3.89543 19 5 19H8.58579C9.11622 19 9.62493 18.7893 10 18.4142L10.5 17.9142L4.08576 11.5Z"
                                                                        fill="#121319" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M5.5 10.0858L11.5858 4L18 10.4142L11.9142 16.5L5.5 10.0858Z"
                                                                        fill="#121319" />
                                                                    <path opacity="0.25" fill-rule="evenodd"
                                                                        clip-rule="evenodd"
                                                                        d="M18.1214 1.70705C16.9498 0.535476 15.0503 0.535476 13.8787 1.70705L13 2.58576L19.4142 8.99997L20.2929 8.12126C21.4645 6.94969 21.4645 5.0502 20.2929 3.87862L18.1214 1.70705Z"
                                                                        fill="#191213" />
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table wrapper-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title flex-column">
                                        <h2 class="mb-1">Two Step Authentication</h2>
                                        <div class="fs-6 fw-bold text-muted">Keep your account extra secure with a second
                                            authentication step.</div>
                                    </div>
                                    <!--end::Card title-->
                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <!--begin::Add-->
                                        <button type="button" class="btn btn-light-primary btn-sm"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                            data-kt-menu-flip="top-end">
                                            <!--begin::Svg Icon | path: icons/duotone/Interface/Lock.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.25" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M3.11117 13.2288C3.27137 11.0124 5.01376 9.29156 7.2315 9.15059C8.55778 9.06629 10.1795 9 12 9C13.8205 9 15.4422 9.06629 16.7685 9.15059C18.9862 9.29156 20.7286 11.0124 20.8888 13.2288C20.9535 14.1234 21 15.085 21 16C21 16.915 20.9535 17.8766 20.8888 18.7712C20.7286 20.9876 18.9862 22.7084 16.7685 22.8494C15.4422 22.9337 13.8205 23 12 23C10.1795 23 8.55778 22.9337 7.23151 22.8494C5.01376 22.7084 3.27137 20.9876 3.11118 18.7712C3.04652 17.8766 3 16.915 3 16C3 15.085 3.04652 14.1234 3.11117 13.2288Z"
                                                        fill="#12131A" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M13 16.7324C13.5978 16.3866 14 15.7403 14 15C14 13.8954 13.1046 13 12 13C10.8954 13 10 13.8954 10 15C10 15.7403 10.4022 16.3866 11 16.7324V18C11 18.5523 11.4477 19 12 19C12.5523 19 13 18.5523 13 18V16.7324Z"
                                                        fill="#12131A" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M7 6C7 3.23858 9.23858 1 12 1C14.7614 1 17 3.23858 17 6V10C17 10.5523 16.5523 11 16 11C15.4477 11 15 10.5523 15 10V6C15 4.34315 13.6569 3 12 3C10.3431 3 9 4.34315 9 6V10C9 10.5523 8.55228 11 8 11C7.44772 11 7 10.5523 7 10V6Z"
                                                        fill="#12131A" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->Add Authentication Step
                                        </button>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-6 w-200px py-4"
                                            data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                    data-bs-target="#kt_modal_add_auth_app">Use authenticator app</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                    data-bs-target="#kt_modal_add_one_time_password">Enable one-time
                                                    password</a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                        <!--end::Add-->
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pb-5">
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Content-->
                                        <div class="d-flex flex-column">
                                            <span>SMS</span>
                                            <span class="text-muted fs-6">+61 412 345 678</span>
                                        </div>
                                        <!--end::Content-->
                                        <!--begin::Action-->
                                        <div class="d-flex justify-content-end align-items-center">
                                            <!--begin::Button-->
                                            <button type="button"
                                                class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto me-5"
                                                data-bs-toggle="modal" data-bs-target="#kt_modal_add_one_time_password">
                                                <!--begin::Svg Icon | path: icons/duotone/Interface/Edit.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.25" x="3" y="21" width="18"
                                                            height="2" rx="1" fill="#191213" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M4.08576 11.5L3.58579 12C3.21071 12.375 3 12.8838 3 13.4142V17C3 18.1045 3.89543 19 5 19H8.58579C9.11622 19 9.62493 18.7893 10 18.4142L10.5 17.9142L4.08576 11.5Z"
                                                            fill="#121319" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M5.5 10.0858L11.5858 4L18 10.4142L11.9142 16.5L5.5 10.0858Z"
                                                            fill="#121319" />
                                                        <path opacity="0.25" fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M18.1214 1.70705C16.9498 0.535476 15.0503 0.535476 13.8787 1.70705L13 2.58576L19.4142 8.99997L20.2929 8.12126C21.4645 6.94969 21.4645 5.0502 20.2929 3.87862L18.1214 1.70705Z"
                                                            fill="#191213" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </button>
                                            <!--end::Button-->
                                            <!--begin::Button-->
                                            <button type="button"
                                                class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                                id="kt_users_delete_two_step">
                                                <!--begin::Svg Icon | path: icons/duotone/General/Trash.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path
                                                                d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                                fill="#000000" fill-rule="nonzero" />
                                                            <path
                                                                d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                                fill="#000000" opacity="0.3" />
                                                        </g>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </button>
                                            <!--end::Button-->
                                        </div>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin:Separator-->
                                    <div class="separator separator-dashed my-5"></div>
                                    <!--end:Separator-->
                                    <!--begin::Disclaimer-->
                                    <div class="text-gray-600">If you lose your mobile device or security key, you can
                                        <a href='#' class="me-1">generate a backup code</a>to sign in to your
                                        account.
                                    </div>
                                    <!--end::Disclaimer-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title flex-column">
                                        <h2>Email Notifications</h2>
                                        <div class="fs-6 fw-bold text-muted">Choose what messages you’d like to receive
                                            for
                                            each of your accounts.</div>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body">
                                    <!--begin::Form-->
                                    <form class="form" id="kt_users_email_notification_form">
                                        <!--begin::Item-->
                                        <div class="d-flex">
                                            <!--begin::Checkbox-->
                                            <div class="form-check form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" name="email_notification_0"
                                                    type="checkbox" value="0"
                                                    id="kt_modal_update_email_notification_0" checked='checked' />
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <label class="form-check-label"
                                                    for="kt_modal_update_email_notification_0">
                                                    <div class="fw-bolder">Successful Payments</div>
                                                    <div class="text-gray-600">Receive a notification for every successful
                                                        payment.</div>
                                                </label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Checkbox-->
                                        </div>
                                        <!--end::Item-->
                                        <div class='separator separator-dashed my-5'></div>
                                        <!--begin::Item-->
                                        <div class="d-flex">
                                            <!--begin::Checkbox-->
                                            <div class="form-check form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" name="email_notification_1"
                                                    type="checkbox" value="1"
                                                    id="kt_modal_update_email_notification_1" />
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <label class="form-check-label"
                                                    for="kt_modal_update_email_notification_1">
                                                    <div class="fw-bolder">Payouts</div>
                                                    <div class="text-gray-600">Receive a notification for every initiated
                                                        payout.</div>
                                                </label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Checkbox-->
                                        </div>
                                        <!--end::Item-->
                                        <div class='separator separator-dashed my-5'></div>
                                        <!--begin::Item-->
                                        <div class="d-flex">
                                            <!--begin::Checkbox-->
                                            <div class="form-check form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" name="email_notification_2"
                                                    type="checkbox" value="2"
                                                    id="kt_modal_update_email_notification_2" />
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <label class="form-check-label"
                                                    for="kt_modal_update_email_notification_2">
                                                    <div class="fw-bolder">Application fees</div>
                                                    <div class="text-gray-600">Receive a notification each time you
                                                        collect a fee from an account.</div>
                                                </label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Checkbox-->
                                        </div>
                                        <!--end::Item-->
                                        <div class='separator separator-dashed my-5'></div>
                                        <!--begin::Item-->
                                        <div class="d-flex">
                                            <!--begin::Checkbox-->
                                            <div class="form-check form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" name="email_notification_3"
                                                    type="checkbox" value="3"
                                                    id="kt_modal_update_email_notification_3" checked='checked' />
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <label class="form-check-label"
                                                    for="kt_modal_update_email_notification_3">
                                                    <div class="fw-bolder">Disputes</div>
                                                    <div class="text-gray-600">Receive a notification if a payment is
                                                        disputed by a customer and for dispute resolutions.</div>
                                                </label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Checkbox-->
                                        </div>
                                        <!--end::Item-->
                                        <div class='separator separator-dashed my-5'></div>
                                        <!--begin::Item-->
                                        <div class="d-flex">
                                            <!--begin::Checkbox-->
                                            <div class="form-check form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" name="email_notification_4"
                                                    type="checkbox" value="4"
                                                    id="kt_modal_update_email_notification_4" checked='checked' />
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <label class="form-check-label"
                                                    for="kt_modal_update_email_notification_4">
                                                    <div class="fw-bolder">Payment reviews</div>
                                                    <div class="text-gray-600">Receive a notification if a payment is
                                                        marked as an elevated risk.</div>
                                                </label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Checkbox-->
                                        </div>
                                        <!--end::Item-->
                                        <div class='separator separator-dashed my-5'></div>
                                        <!--begin::Item-->
                                        <div class="d-flex">
                                            <!--begin::Checkbox-->
                                            <div class="form-check form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" name="email_notification_5"
                                                    type="checkbox" value="5"
                                                    id="kt_modal_update_email_notification_5" />
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <label class="form-check-label"
                                                    for="kt_modal_update_email_notification_5">
                                                    <div class="fw-bolder">Mentions</div>
                                                    <div class="text-gray-600">Receive a notification if a teammate
                                                        mentions you in a note.</div>
                                                </label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Checkbox-->
                                        </div>
                                        <!--end::Item-->
                                        <div class='separator separator-dashed my-5'></div>
                                        <!--begin::Item-->
                                        <div class="d-flex">
                                            <!--begin::Checkbox-->
                                            <div class="form-check form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" name="email_notification_6"
                                                    type="checkbox" value="6"
                                                    id="kt_modal_update_email_notification_6" />
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <label class="form-check-label"
                                                    for="kt_modal_update_email_notification_6">
                                                    <div class="fw-bolder">Invoice Mispayments</div>
                                                    <div class="text-gray-600">Receive a notification if a customer sends
                                                        an incorrect amount to pay their invoice.</div>
                                                </label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Checkbox-->
                                        </div>
                                        <!--end::Item-->
                                        <div class='separator separator-dashed my-5'></div>
                                        <!--begin::Item-->
                                        <div class="d-flex">
                                            <!--begin::Checkbox-->
                                            <div class="form-check form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" name="email_notification_7"
                                                    type="checkbox" value="7"
                                                    id="kt_modal_update_email_notification_7" />
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <label class="form-check-label"
                                                    for="kt_modal_update_email_notification_7">
                                                    <div class="fw-bolder">Webhooks</div>
                                                    <div class="text-gray-600">Receive notifications about consistently
                                                        failing webhook endpoints.</div>
                                                </label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Checkbox-->
                                        </div>
                                        <!--end::Item-->
                                        <div class='separator separator-dashed my-5'></div>
                                        <!--begin::Item-->
                                        <div class="d-flex">
                                            <!--begin::Checkbox-->
                                            <div class="form-check form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" name="email_notification_8"
                                                    type="checkbox" value="8"
                                                    id="kt_modal_update_email_notification_8" />
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <label class="form-check-label"
                                                    for="kt_modal_update_email_notification_8">
                                                    <div class="fw-bolder">Trial</div>
                                                    <div class="text-gray-600">Receive helpful tips when you try out our
                                                        products.</div>
                                                </label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Checkbox-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Action buttons-->
                                        <div class="d-flex justify-content-end align-items-center mt-12">
                                            <!--begin::Button-->
                                            <button type="button" class="btn btn-light me-5"
                                                id="kt_users_email_notification_cancel">Cancel</button>
                                            <!--end::Button-->
                                            <!--begin::Button-->
                                            <button type="button" class="btn btn-primary"
                                                id="kt_users_email_notification_submit">
                                                <span class="indicator-label">Save</span>
                                                <span class="indicator-progress">Please wait...
                                                    <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                            <!--end::Button-->
                                        </div>
                                        <!--begin::Action buttons-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Card body-->
                                <!--begin::Card footer-->
                                <!--end::Card footer-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end:::Tab pane-->
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade" id="kt_user_view_overview_events_and_logs_tab" role="tabpanel">
                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Login Sessions</h2>
                                    </div>
                                    <!--end::Card title-->
                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <!--begin::Filter-->
                                        <button type="button" class="btn btn-sm btn-flex btn-light-primary"
                                            id="kt_modal_sign_out_sesions">
                                            <!--begin::Svg Icon | path: icons/duotone/Interface/Sign-Out.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.25"
                                                        d="M13.1409 21.8611C11.5331 21.7101 10.3267 20.4628 10.2092 18.8523C10.0992 17.3432 10 15.118 10 12C10 8.882 10.0992 6.65682 10.2092 5.14773C10.3267 3.5372 11.5331 2.2899 13.1408 2.13886C13.9779 2.06022 14.9589 2 16 2C17.0411 2 18.0221 2.06022 18.8592 2.13886C20.4669 2.2899 21.6733 3.53721 21.7908 5.14773C21.9008 6.65683 22 8.882 22 12C22 15.118 21.9008 17.3432 21.7908 18.8523C21.6733 20.4628 20.4669 21.7101 18.8591 21.8611C18.0221 21.9398 17.0411 22 16 22C14.9589 22 13.9779 21.9398 13.1409 21.8611Z"
                                                        fill="#12131A" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M7.20711 14.7929C7.59763 15.1834 7.59763 15.8166 7.20711 16.2071C6.81658 16.5976 6.18342 16.5976 5.79289 16.2071L2.29289 12.7071C1.90237 12.3166 1.90237 11.6834 2.29289 11.2929L5.79289 7.79289C6.18342 7.40237 6.81658 7.40237 7.20711 7.79289C7.59763 8.18342 7.59763 8.81658 7.20711 9.20711L5.41421 11H15C15.5523 11 16 11.4477 16 12C16 12.5523 15.5523 13 15 13L5.41421 13L7.20711 14.7929Z"
                                                        fill="#12131A" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->Sign out all sessions
                                        </button>
                                        <!--end::Filter-->
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0 pb-5">
                                    <!--begin::Table wrapper-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed gy-5"
                                            id="kt_table_users_login_session">
                                            <!--begin::Table head-->
                                            <thead class="border-bottom border-gray-200 fs-7 fw-bolder">
                                                <!--begin::Table row-->
                                                <tr class="text-start text-muted text-uppercase gs-0">
                                                    <th class="min-w-100px">Location</th>
                                                    <th>Device</th>
                                                    <th>IP Address</th>
                                                    <th class="min-w-125px">Time</th>
                                                    <th class="min-w-70px">Actions</th>
                                                </tr>
                                                <!--end::Table row-->
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody class="fs-6 fw-bold text-gray-600">
                                                <tr>
                                                    <!--begin::Invoice=-->
                                                    <td>Australia</td>
                                                    <!--end::Invoice=-->
                                                    <!--begin::Status=-->
                                                    <td>Chome - Windows</td>
                                                    <!--end::Status=-->
                                                    <!--begin::Amount=-->
                                                    <td>207.24.21.386</td>
                                                    <!--end::Amount=-->
                                                    <!--begin::Date=-->
                                                    <td>23 seconds ago</td>
                                                    <!--end::Date=-->
                                                    <!--begin::Action=-->
                                                    <td>Current session</td>
                                                    <!--end::Action=-->
                                                </tr>
                                                <tr>
                                                    <!--begin::Invoice=-->
                                                    <td>Australia</td>
                                                    <!--end::Invoice=-->
                                                    <!--begin::Status=-->
                                                    <td>Safari - iOS</td>
                                                    <!--end::Status=-->
                                                    <!--begin::Amount=-->
                                                    <td>207.43.36.266</td>
                                                    <!--end::Amount=-->
                                                    <!--begin::Date=-->
                                                    <td>3 days ago</td>
                                                    <!--end::Date=-->
                                                    <!--begin::Action=-->
                                                    <td>
                                                        <a href="#" data-kt-users-sign-out="single_user">Sign
                                                            out</a>
                                                    </td>
                                                    <!--end::Action=-->
                                                </tr>
                                                <tr>
                                                    <!--begin::Invoice=-->
                                                    <td>Australia</td>
                                                    <!--end::Invoice=-->
                                                    <!--begin::Status=-->
                                                    <td>Chrome - Windows</td>
                                                    <!--end::Status=-->
                                                    <!--begin::Amount=-->
                                                    <td>207.40.37.391</td>
                                                    <!--end::Amount=-->
                                                    <!--begin::Date=-->
                                                    <td>last week</td>
                                                    <!--end::Date=-->
                                                    <!--begin::Action=-->
                                                    <td>Expired</td>
                                                    <!--end::Action=-->
                                                </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table wrapper-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Logs</h2>
                                    </div>
                                    <!--end::Card title-->
                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <!--begin::Button-->
                                        <button type="button" class="btn btn-sm btn-light-primary">
                                            <!--begin::Svg Icon | path: icons/duotone/Files/Download.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none"
                                                        fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path
                                                            d="M2,13 C2,12.5 2.5,12 3,12 C3.5,12 4,12.5 4,13 C4,13.3333333 4,15 4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 C2,15 2,13.3333333 2,13 Z"
                                                            fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                        <rect fill="#000000" opacity="0.3"
                                                            transform="translate(12.000000, 8.000000) rotate(-180.000000) translate(-12.000000, -8.000000)"
                                                            x="11" y="1" width="2" height="14"
                                                            rx="1" />
                                                        <path
                                                            d="M7.70710678,15.7071068 C7.31658249,16.0976311 6.68341751,16.0976311 6.29289322,15.7071068 C5.90236893,15.3165825 5.90236893,14.6834175 6.29289322,14.2928932 L11.2928932,9.29289322 C11.6689749,8.91681153 12.2736364,8.90091039 12.6689647,9.25670585 L17.6689647,13.7567059 C18.0794748,14.1261649 18.1127532,14.7584547 17.7432941,15.1689647 C17.3738351,15.5794748 16.7415453,15.6127532 16.3310353,15.2432941 L12.0362375,11.3779761 L7.70710678,15.7071068 Z"
                                                            fill="#000000" fill-rule="nonzero"
                                                            transform="translate(12.000004, 12.499999) rotate(-180.000000) translate(-12.000004, -12.499999)" />
                                                    </g>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->Download Report
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body py-0">
                                    <!--begin::Table wrapper-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed fw-bold text-gray-600 fs-6 gy-5"
                                            id="kt_table_users_logs">
                                            <!--begin::Table body-->
                                            <tbody>
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Badge=-->
                                                    <td class="min-w-70px">
                                                        <div class="badge badge-light-warning">404 WRN</div>
                                                    </td>
                                                    <!--end::Badge=-->
                                                    <!--begin::Status=-->
                                                    <td>POST /v1/customer/c_610d48587f5fb/not_found</td>
                                                    <!--end::Status=-->
                                                    <!--begin::Timestamp=-->
                                                    <td class="pe-0 text-end min-w-200px">22 Sep 2021, 10:10 pm</td>
                                                    <!--end::Timestamp=-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Badge=-->
                                                    <td class="min-w-70px">
                                                        <div class="badge badge-light-warning">404 WRN</div>
                                                    </td>
                                                    <!--end::Badge=-->
                                                    <!--begin::Status=-->
                                                    <td>POST /v1/customer/c_610d48587f600/not_found</td>
                                                    <!--end::Status=-->
                                                    <!--begin::Timestamp=-->
                                                    <td class="pe-0 text-end min-w-200px">05 May 2021, 9:23 pm</td>
                                                    <!--end::Timestamp=-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Badge=-->
                                                    <td class="min-w-70px">
                                                        <div class="badge badge-light-warning">404 WRN</div>
                                                    </td>
                                                    <!--end::Badge=-->
                                                    <!--begin::Status=-->
                                                    <td>POST /v1/customer/c_610d48587f5ff/not_found</td>
                                                    <!--end::Status=-->
                                                    <!--begin::Timestamp=-->
                                                    <td class="pe-0 text-end min-w-200px">10 Nov 2021, 6:05 pm</td>
                                                    <!--end::Timestamp=-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Badge=-->
                                                    <td class="min-w-70px">
                                                        <div class="badge badge-light-success">200 OK</div>
                                                    </td>
                                                    <!--end::Badge=-->
                                                    <!--begin::Status=-->
                                                    <td>POST /v1/invoices/in_3842_1661/payment</td>
                                                    <!--end::Status=-->
                                                    <!--begin::Timestamp=-->
                                                    <td class="pe-0 text-end min-w-200px">22 Sep 2021, 10:10 pm</td>
                                                    <!--end::Timestamp=-->
                                                </tr>
                                                <!--end::Table row-->
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Badge=-->
                                                    <td class="min-w-70px">
                                                        <div class="badge badge-light-danger">500 ERR</div>
                                                    </td>
                                                    <!--end::Badge=-->
                                                    <!--begin::Status=-->
                                                    <td>POST /v1/invoice/in_7607_8523/invalid</td>
                                                    <!--end::Status=-->
                                                    <!--begin::Timestamp=-->
                                                    <td class="pe-0 text-end min-w-200px">19 Aug 2021, 6:43 am</td>
                                                    <!--end::Timestamp=-->
                                                </tr>
                                                <!--end::Table row-->
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table wrapper-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Events</h2>
                                    </div>
                                    <!--end::Card title-->
                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <!--begin::Button-->
                                        <button type="button" class="btn btn-sm btn-light-primary">
                                            <!--begin::Svg Icon | path: icons/duotone/Files/Download.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none"
                                                        fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path
                                                            d="M2,13 C2,12.5 2.5,12 3,12 C3.5,12 4,12.5 4,13 C4,13.3333333 4,15 4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 C2,15 2,13.3333333 2,13 Z"
                                                            fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                        <rect fill="#000000" opacity="0.3"
                                                            transform="translate(12.000000, 8.000000) rotate(-180.000000) translate(-12.000000, -8.000000)"
                                                            x="11" y="1" width="2" height="14"
                                                            rx="1" />
                                                        <path
                                                            d="M7.70710678,15.7071068 C7.31658249,16.0976311 6.68341751,16.0976311 6.29289322,15.7071068 C5.90236893,15.3165825 5.90236893,14.6834175 6.29289322,14.2928932 L11.2928932,9.29289322 C11.6689749,8.91681153 12.2736364,8.90091039 12.6689647,9.25670585 L17.6689647,13.7567059 C18.0794748,14.1261649 18.1127532,14.7584547 17.7432941,15.1689647 C17.3738351,15.5794748 16.7415453,15.6127532 16.3310353,15.2432941 L12.0362375,11.3779761 L7.70710678,15.7071068 Z"
                                                            fill="#000000" fill-rule="nonzero"
                                                            transform="translate(12.000004, 12.499999) rotate(-180.000000) translate(-12.000004, -12.499999)" />
                                                    </g>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->Download Report
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body py-0">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 text-gray-600 fw-bold gy-5"
                                        id="kt_table_customers_events">
                                        <!--begin::Table body-->
                                        <tbody>
                                            <!--begin::Table row-->
                                            <tr>
                                                <!--begin::Event=-->
                                                <td class="min-w-400px">
                                                    <a href="#"
                                                        class="text-gray-600 text-hover-primary me-1">Brian
                                                        Cox</a>has made payment to
                                                    <a href="#"
                                                        class="fw-bolder text-gray-900 text-hover-primary">#OLP-45690</a>
                                                </td>
                                                <!--end::Event=-->
                                                <!--begin::Timestamp=-->
                                                <td class="pe-0 text-gray-600 text-end min-w-200px">20 Jun 2021, 11:05 am
                                                </td>
                                                <!--end::Timestamp=-->
                                            </tr>
                                            <!--end::Table row-->
                                            <!--begin::Table row-->
                                            <tr>
                                                <!--begin::Event=-->
                                                <td class="min-w-400px">
                                                    <a href="#" class="text-gray-600 text-hover-primary me-1">Max
                                                        Smith</a>has made payment to
                                                    <a href="#"
                                                        class="fw-bolder text-gray-900 text-hover-primary">#SDK-45670</a>
                                                </td>
                                                <!--end::Event=-->
                                                <!--begin::Timestamp=-->
                                                <td class="pe-0 text-gray-600 text-end min-w-200px">10 Nov 2021, 11:30 am
                                                </td>
                                                <!--end::Timestamp=-->
                                            </tr>
                                            <!--end::Table row-->
                                            <!--begin::Table row-->
                                            <tr>
                                                <!--begin::Event=-->
                                                <td class="min-w-400px">Invoice
                                                    <a href="#"
                                                        class="fw-bolder text-gray-900 text-hover-primary me-1">#LOP-45640</a>has
                                                    been
                                                    <span class="badge badge-light-danger">Declined</span>
                                                </td>
                                                <!--end::Event=-->
                                                <!--begin::Timestamp=-->
                                                <td class="pe-0 text-gray-600 text-end min-w-200px">05 May 2021, 9:23 pm
                                                </td>
                                                <!--end::Timestamp=-->
                                            </tr>
                                            <!--end::Table row-->
                                            <!--begin::Table row-->
                                            <tr>
                                                <!--begin::Event=-->
                                                <td class="min-w-400px">
                                                    <a href="#" class="text-gray-600 text-hover-primary me-1">Sean
                                                        Bean</a>has made payment to
                                                    <a href="#"
                                                        class="fw-bolder text-gray-900 text-hover-primary">#XRS-45670</a>
                                                </td>
                                                <!--end::Event=-->
                                                <!--begin::Timestamp=-->
                                                <td class="pe-0 text-gray-600 text-end min-w-200px">24 Jun 2021, 8:43 pm
                                                </td>
                                                <!--end::Timestamp=-->
                                            </tr>
                                            <!--end::Table row-->
                                            <!--begin::Table row-->
                                            <tr>
                                                <!--begin::Event=-->
                                                <td class="min-w-400px">Invoice
                                                    <a href="#"
                                                        class="fw-bolder text-gray-900 text-hover-primary me-1">#LOP-45640</a>has
                                                    been
                                                    <span class="badge badge-light-danger">Declined</span>
                                                </td>
                                                <!--end::Event=-->
                                                <!--begin::Timestamp=-->
                                                <td class="pe-0 text-gray-600 text-end min-w-200px">20 Jun 2021, 8:43 pm
                                                </td>
                                                <!--end::Timestamp=-->
                                            </tr>
                                            <!--end::Table row-->
                                            <!--begin::Table row-->
                                            <tr>
                                                <!--begin::Event=-->
                                                <td class="min-w-400px">Invoice
                                                    <a href="#"
                                                        class="fw-bolder text-gray-900 text-hover-primary me-1">#SEP-45656</a>status
                                                    has changed from
                                                    <span class="badge badge-light-warning me-1">Pending</span>to
                                                    <span class="badge badge-light-info">In Progress</span>
                                                </td>
                                                <!--end::Event=-->
                                                <!--begin::Timestamp=-->
                                                <td class="pe-0 text-gray-600 text-end min-w-200px">20 Dec 2021, 6:05 pm
                                                </td>
                                                <!--end::Timestamp=-->
                                            </tr>
                                            <!--end::Table row-->
                                            <!--begin::Table row-->
                                            <tr>
                                                <!--begin::Event=-->
                                                <td class="min-w-400px">Invoice
                                                    <a href="#"
                                                        class="fw-bolder text-gray-900 text-hover-primary me-1">#LOP-45640</a>has
                                                    been
                                                    <span class="badge badge-light-danger">Declined</span>
                                                </td>
                                                <!--end::Event=-->
                                                <!--begin::Timestamp=-->
                                                <td class="pe-0 text-gray-600 text-end min-w-200px">20 Jun 2021, 2:40 pm
                                                </td>
                                                <!--end::Timestamp=-->
                                            </tr>
                                            <!--end::Table row-->
                                            <!--begin::Table row-->
                                            <tr>
                                                <!--begin::Event=-->
                                                <td class="min-w-400px">Invoice
                                                    <a href="#"
                                                        class="fw-bolder text-gray-900 text-hover-primary me-1">#KIO-45656</a>status
                                                    has changed from
                                                    <span class="badge badge-light-succees me-1">In Transit</span>to
                                                    <span class="badge badge-light-success">Approved</span>
                                                </td>
                                                <!--end::Event=-->
                                                <!--begin::Timestamp=-->
                                                <td class="pe-0 text-gray-600 text-end min-w-200px">10 Nov 2021, 6:05 pm
                                                </td>
                                                <!--end::Timestamp=-->
                                            </tr>
                                            <!--end::Table row-->
                                            <!--begin::Table row-->
                                            <tr>
                                                <!--begin::Event=-->
                                                <td class="min-w-400px">
                                                    <a href="#"
                                                        class="text-gray-600 text-hover-primary me-1">Melody
                                                        Macy</a>has made payment to
                                                    <a href="#"
                                                        class="fw-bolder text-gray-900 text-hover-primary">#XRS-45670</a>
                                                </td>
                                                <!--end::Event=-->
                                                <!--begin::Timestamp=-->
                                                <td class="pe-0 text-gray-600 text-end min-w-200px">20 Jun 2021, 6:05 pm
                                                </td>
                                                <!--end::Timestamp=-->
                                            </tr>
                                            <!--end::Table row-->
                                            <!--begin::Table row-->
                                            <tr>
                                                <!--begin::Event=-->
                                                <td class="min-w-400px">
                                                    <a href="#" class="text-gray-600 text-hover-primary me-1">Emma
                                                        Smith</a>has made payment to
                                                    <a href="#"
                                                        class="fw-bolder text-gray-900 text-hover-primary">#XRS-45670</a>
                                                </td>
                                                <!--end::Event=-->
                                                <!--begin::Timestamp=-->
                                                <td class="pe-0 text-gray-600 text-end min-w-200px">10 Nov 2021, 5:30 pm
                                                </td>
                                                <!--end::Timestamp=-->
                                            </tr>
                                            <!--end::Table row-->
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end:::Tab pane-->
                    </div>
                    <!--end:::Tab content-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
