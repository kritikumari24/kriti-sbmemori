<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.header', [
        'title' => __('header.dashboard'),
        'breadcrumbs' => Breadcrumbs::render('admin.dashboard'),
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <div class="d-flex gap-2 mb-3">
                <a href="<?php echo e(route('admin.sample-pdf')); ?>?download_type=stream">
                <button type="button" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-file-pdf" viewBox="0 0 16 16">
                            <path
                                d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1">
                            </path>
                            <path
                                d="M4.603 12.087a.8.8 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.7 7.7 0 0 1 1.482-.645 20 20 0 0 0 1.062-2.227 7.3 7.3 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.187-.012.395-.047.614-.084.51-.27 1.134-.52 1.794a11 11 0 0 0 .98 1.686 5.8 5.8 0 0 1 1.334.05c.364.065.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.86.86 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.7 5.7 0 0 1-.911-.95 11.6 11.6 0 0 0-1.997.406 11.3 11.3 0 0 1-1.021 1.51c-.29.35-.608.655-.926.787a.8.8 0 0 1-.58.029m1.379-1.901q-.25.115-.459.238c-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361q.016.032.026.044l.035-.012c.137-.056.355-.235.635-.572a8 8 0 0 0 .45-.606m1.64-1.33a13 13 0 0 1 1.01-.193 12 12 0 0 1-.51-.858 21 21 0 0 1-.5 1.05zm2.446.45q.226.244.435.41c.24.19.407.253.498.256a.1.1 0 0 0 .07-.015.3.3 0 0 0 .094-.125.44.44 0 0 0 .059-.2.1.1 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a4 4 0 0 0-.612-.053zM8.078 5.8a7 7 0 0 0 .2-.828q.046-.282.038-.465a.6.6 0 0 0-.032-.198.5.5 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822q.036.167.09.346z">
                            </path>
                        </svg>
                        Sample Pdf
                </button></a>
            </div>
            <?php if(session('status')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>
            <!--begin::Col-->
            <div class="col-12">
                <!--begin::Mixed Widget 2-->
                <div class="card mb-4 px-4">
                    <div class="row">
                        <div class="mt-2">
                            <h2 class="text-lg font-medium truncate mr-5">Chart</h2>
                        </div>
                        <div class="col-md-6">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="dailyCustomersCurrentMonth" class="mt-6 chartjs-render-monitor"
                                style="display: block;"></canvas>
                        </div>
                        <div class="col-md-6">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="weeklyCustomerChart" class="mt-6 chartjs-render-monitor"
                                style="display: block;"></canvas>
                        </div>
                    </div>
                </div>
                <!--end::Mixed Widget 2-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-12">
                <!--begin::Mixed Widget 2-->
                <div class="card">
                    <!--begin::Body-->
                    <div class="card-body p-0">
                        <!--begin::Stats-->
                        <div class="card-p mt-20 position-relative">
                            <!--begin::Row-->
                            <div class="row g-0">
                                <!--begin::Col-->
                                <div class="col bg-light-primary px-6 py-8 rounded-2 me-7 mb-7">
                                    <!--begin::Svg Icon | path: icons/duotone/Communication/Add-user.svg-->
                                    <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <path
                                                d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <path
                                                d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                fill="#000000" fill-rule="nonzero" />
                                        </svg>
                                        <h4 class="text-dark fw-bold fs-6"><span class="new_users">0</span>
                                        </h4>
                                    </span>
                                    <!--end::Svg Icon-->

                                    <a href=" <?php echo e(route('admin.users.index')); ?>"
                                        class="text-primary fw-bold fs-6"><?php echo e(trans_choice('content.dashboard_cards.new_users', 1)); ?></a>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col bg-light-primary px-6 py-8 rounded-2 me-7 mb-7">
                                    <!--begin::Svg Icon | path: icons/duotone/Communication/Add-user.svg-->
                                    <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
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
                                        <h4 class="text-dark fw-bold fs-6"><span class="total_clients">0</span>
                                        </h4>
                                    </span>
                                    <!--end::Svg Icon-->

                                    <a href="<?php echo e(route('admin.users.index')); ?>"
                                        class="text-primary fw-bold fs-6"><?php echo e(trans_choice('content.dashboard_cards.total_clients', 1)); ?></a>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                                    <!--begin::Svg Icon | path: icons/duotone/Media/Equalizer.svg-->
                                    <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <rect fill="#000000" opacity="0.3" x="13" y="4" width="3"
                                                    height="16" rx="1.5" />
                                                <rect fill="#000000" x="8" y="9" width="3" height="11"
                                                    rx="1.5" />
                                                <rect fill="#000000" x="18" y="11" width="3" height="9"
                                                    rx="1.5" />
                                                <rect fill="#000000" x="3" y="13" width="3" height="7"
                                                    rx="1.5" />
                                            </g>
                                        </svg>
                                        <h4 class="text-dark fw-bold fs-6 ">₭ <span class="yearly_sales_count">0</span>
                                        </h4>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <a href="#"
                                        class="text-warning fw-bold fs-6"><?php echo e(trans_choice('content.dashboard_cards.yearly_sales', 1)); ?></a>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col bg-light-success px-6 py-8 rounded-2 me-7 mb-7">
                                    <!--begin::Svg Icon | path: icons/duotone/Media/Equalizer.svg-->
                                    <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <path
                                                d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"
                                                fill="#000000" />
                                        </svg>
                                        <h4 class="text-dark fw-bold fs-6 "><span class="total_vendors">0</span>
                                        </h4>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <a href="#"
                                        class="text-success fw-bold fs-6"><?php echo e(trans_choice('content.dashboard_cards.total_vendors', 1)); ?></a>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col bg-light-primary px-6 py-8 rounded-2 mb-7">
                                    <!--begin::Svg Icon | path: icons/duotone/Communication/Add-user.svg-->
                                    <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <!-- <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" /> -->
                                            <!-- <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" /> -->
                                            <path
                                                d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"
                                                fill="#000000" fill-rule="nonzero" />
                                        </svg>
                                        <h4 class="text-dark fw-bold fs-6"><span class="total_purchase">0</span>
                                        </h4>
                                    </span>
                                    <!--end::Svg Icon-->

                                    <a href="#"
                                        class="text-primary fw-bold fs-6"><?php echo e(trans_choice('content.dashboard_cards.total_purchase', 1)); ?></a>
                                </div>
                                <!--end::Col-->

                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="row g-0">
                                <!--begin::Col-->
                                <div class="col bg-light-danger px-6 py-8 rounded-2 me-7 mb-7">
                                    <!--begin::Svg Icon | path: icons/duotone/Communication/Urgent-mail.svg-->
                                    <span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <path
                                                d="M12.7037037,14 L15.6666667,10 L13.4444444,10 L13.4444444,6 L9,12 L11.2222222,12 L11.2222222,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L12.7037037,14 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M9.80428954,10.9142091 L9,12 L11.2222222,12 L11.2222222,16 L15.6666667,10 L15.4615385,10 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9.80428954,10.9142091 Z"
                                                fill="#000000" />
                                        </svg>
                                        <h4 class="text-dark fw-bold fs-6"><span class="total_unrecieved_bill">0</span>
                                        </h4>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <a href="#"
                                        class="text-danger fw-bold fs-6 mt-2"><?php echo e(trans_choice('content.dashboard_cards.total_unrecieved_bill', 1)); ?></a>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col bg-light-info px-6 py-8 rounded-2 me-7 mb-7">
                                    <!--begin::Svg Icon | path: icons/duotone/Communication/Urgent-mail.svg-->
                                    <span class="svg-icon svg-icon-3x svg-icon-info d-block my-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <path fill="#000000" fill-rule="evenodd"
                                                d="M6.364 13.5a.5.5 0 0 0 .5.5H13.5a1.5 1.5 0 0 0 1.5-1.5v-10A1.5 1.5 0 0 0 13.5 1h-10A1.5 1.5 0 0 0 2 2.5v6.636a.5.5 0 1 0 1 0V2.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-.5.5H6.864a.5.5 0 0 0-.5.5z" />
                                            <path fill="#000000" fill-rule="evenodd"
                                                d="M11 5.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793l-8.147 8.146a.5.5 0 0 0 .708.708L10 6.707V10.5a.5.5 0 0 0 1 0v-5z" />
                                        </svg>
                                        <h4 class="text-dark fw-bold fs-6">₭ <span class="total_unpaid_amount">0</span>
                                        </h4>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <a href="#"
                                        class="text-info fw-bold fs-6 mt-2"><?php echo e(trans_choice('content.dashboard_cards.total_unpaid_amount', 1)); ?></a>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col bg-light-danger px-6 py-8 rounded-2 mb-7">
                                    <!--begin::Svg Icon | path: icons/duotone/Communication/Urgent-mail.svg-->
                                    <span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <path
                                                d="M12.7037037,14 L15.6666667,10 L13.4444444,10 L13.4444444,6 L9,12 L11.2222222,12 L11.2222222,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L12.7037037,14 Z"
                                                fill="#000000" opacity="0.3" />
                                            <path
                                                d="M9.80428954,10.9142091 L9,12 L11.2222222,12 L11.2222222,16 L15.6666667,10 L15.4615385,10 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9.80428954,10.9142091 Z"
                                                fill="#000000" />
                                        </svg>
                                        <h4 class="text-dark fw-bold fs-6">₭ <span
                                                class="total_unrecieved_amount">0</span>
                                        </h4>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <a href="#"
                                        class="text-danger fw-bold fs-6 mt-2"><?php echo e(trans_choice('content.dashboard_cards.total_unrecieved_amount', 1)); ?></a>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="row g-0">
                                <!--begin::Col-->
                                <div class="col bg-light-danger px-6 py-8 rounded-2 me-7 mb-7"
                                    style="background:#f04f4f;">
                                    <!--begin::Svg Icon-->
                                    <span class="svg-icon svg-icon-3x svg-icon-dark d-block my-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <path
                                                d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                                fill="#000000" fill-rule="nonzero" />
                                            <path
                                                d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                                fill="#000000" opacity="0.3" />
                                        </svg>
                                        <h4 class="text-dark fw-bold fs-6">₭ <span class="total_dept_balance">0</span>
                                        </h4>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <a href="#" style="color:#f00505!important"
                                        class="fw-bold fs-6"><?php echo e(trans_choice('content.dashboard_cards.total_dept_balance', 1)); ?></a>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col bg-light-success px-6 py-8 rounded-2 mb-7">
                                    <!--begin::Svg Icon | path: icons/Design/Bucket.svg-->
                                    <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M5,5 L5,15 C5,15.5948613 5.25970314,16.1290656 5.6719139,16.4954176 C5.71978107,16.5379595 5.76682388,16.5788906 5.81365532,16.6178662 C5.82524933,16.6294602 15,7.45470952 15,7.45470952 C15,6.9962515 15,6.17801499 15,5 L5,5 Z M5,3 L15,3 C16.1045695,3 17,3.8954305 17,5 L17,15 C17,17.209139 15.209139,19 13,19 L7,19 C4.790861,19 3,17.209139 3,15 L3,5 C3,3.8954305 3.8954305,3 5,3 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(10.000000, 11.000000) rotate(-315.000000) translate(-10.000000, -11.000000) " />
                                                <!-- <path d="M20,22 C21.6568542,22 23,20.6568542 23,19 C23,17.8954305 22,16.2287638 20,14 C18,16.2287638 17,17.8954305 17,19 C17,20.6568542 18.3431458,22 20,22 Z" fill="#000000" opacity="0.3" /> -->
                                            </g>
                                        </svg>
                                        <h4 class="text-dark fw-bold fs-6"> <span class="total_asset">0</span>
                                        </h4>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <a href="#"
                                        class="text-success fw-bold fs-6 mt-2"><?php echo e(trans_choice('content.dashboard_cards.total_asset', 1)); ?></a>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Stats-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 2-->
    </div>
    <!--end::Col-->
    </div>
    <!--end::Post-->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        function dashboard() {
            $.ajax({
                    url: `<?php echo e(route('admin.dashboard-counts')); ?>`,
                    type: "get",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                })
                .done(function(response) {
                    console.log(response);
                    $('.new_users').text(response.data.new_users);
                    $('.total_clients').text(response.data.total_clients);
                    $('.yearly_sales_count').text(response.data.yearly_sales_count);

                    $('.total_vendors').text(response.data.total_vendors);

                    $('.total_purchase').text(response.data.total_purchase);

                    $('.total_unpaid_bill').text(response.data.total_unpaid_bill);
                    $('.total_unrecieved_bill').text(response.data.total_unrecieved_bill);
                    $('.total_unrecieved_amount').text((response.data.total_unrecieved_amount).toLocaleString());

                    $('.total_dept_balance').text((response.data.total_dept_balance).toLocaleString());
                    $('.total_asset').text(response.data.total_asset);
                })
                .fail(function() {
                    Swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                });
        }
        dashboard();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $.ajax({
            url: `<?php echo e(route('admin.dashboard.get-charts-data')); ?>`,
            type: 'GET',
            success: function(response) {
                console.log(response);
                getWeeklyCustomersChart(response.dailyUserData);
                getDailyCustomersChart(response.weeklyUserCount);
            }
        });

        function getWeeklyCustomersChart(weeklyUsersCount) {
            var weeks_for_users = [];
            var usersCount = [];

            // Extract data from the response
            $.each(weeklyUsersCount, function(val, text) {
                weeks_for_users.push(val);
                usersCount.push(text);
            })
            var ctx = document.getElementById('weeklyCustomerChart').getContext('2d');
            var weeklyUserChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: weeks_for_users,
                    datasets: [{
                        label: 'Weekly Customers Count',
                        data: usersCount,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        function getDailyCustomersChart(dailyUsersData) {
            var days_for_users = [];
            var usersCountDaily = [];
            $.each(dailyUsersData, function(val, text) {
                days_for_users.push(val);
                usersCountDaily.push(text);
            })
            var dailyUsersCurrentMonth = document.getElementById('dailyCustomersCurrentMonth').getContext('2d');
            var dailyUsersCurrentMonth = new Chart(dailyUsersCurrentMonth, {
                type: 'line',
                data: {
                    labels: days_for_users,
                    datasets: [{
                        label: 'Daily Customers Count',
                        data: usersCountDaily,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Herd\sbmemori\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>