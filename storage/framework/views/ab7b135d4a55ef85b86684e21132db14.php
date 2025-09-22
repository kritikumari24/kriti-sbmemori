<?php $__env->startSection('content'); ?>
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
        style="background-size1: 100% 50%;">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
            <a href="javascript:void(0)" class="mb-12">
                <img alt="Logo" src="<?php echo e($logo_img); ?>" class="w-100px" />
            </a>
            <!--end::Logo-->
            <!--begin::Wrapper-->
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">

                <!--begin::Form-->
                <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST"
                    action="<?php echo e(route('admin.login')); ?>">
                    <?php echo csrf_field(); ?>
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">Sign In to <?php echo e(trans_choice('content.login.company_name', 1)); ?> </h1>
                        <!--end::Title-->
                        <!--begin::Link-->
                        
                        <!--end::Link-->
                    </div>
                    <!--begin::Heading-->

                    <?php if(session()->has('error')): ?>
                        <div class="alert alert-danger text-center"><?php echo e(session()->get('error')); ?></div>
                    <?php endif; ?>
                    <?php if(session()->has('warning')): ?>
                        <div class="alert alert-danger text-center"><?php echo e(session()->get('error')); ?></div>
                    <?php endif; ?>


                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(trans_choice('content.login.email', 1)); ?>

                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-lg form-control-solid" type="text" name="email"
                            autocomplete="on" value="admin@gmail.com" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10" style="position: relative;">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack mb-2">
                            <!--begin::Label-->
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">Password </label>
                            <!--end::Label-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Input-->
                        <input class="form-control form-control-lg form-control-solid" type="password" name="password"
                            autocomplete="on" id="password" value="123456" />
                        <i class="far fa-eye" id="enter_password"
                            style="position: absolute;top: 41px;right: 34px;font-size: 18px;"></i>
                        <div class="forgot-pswrd d-flex justify-content-end mb-10"
                            style="margin-top:20px; margin-right:12px;"><a
                                href="<?php echo e(route('admin.password.request')); ?>"><b>Forgot
                                    Password?</b></a></div>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <!--begin::Submit button-->
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                            <span class="indicator-label">Login</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Submit button-->
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->

            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Authentication - Sign-in-->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('vendor/jsvalidation/js/jsvalidation.js')); ?>"></script>
    <?php echo JsValidator::formRequest('App\Http\Requests\Admin\LoginRequest', 'form'); ?>


    <script>
        $(document).on('click', '#enter_password', function() {
            if ($('#enter_password').hasClass('far fa-eye')) {
                //console.log("asdfsd");
                $('#enter_password').removeClass('fa-eye');
                $('#enter_password').addClass('fa-eye-slash');
            } else {
                $('#enter_password').removeClass('fa-eye-slash');
                $('#enter_password').addClass('fa-eye');
            }
            var password = document.getElementById('password');
            var enter_password = document.getElementById('enter_password');
            if (password.type == "password") {
                password.type = "text";
                enter_password.value = "Hide password";
            } else {
                password.type = "Password";
                enter_password.value = "Show the password";
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Herd\sbmemori\resources\views/admin/auth/login.blade.php ENDPATH**/ ?>