<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="{{ asset('admin/dist/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('admin/dist/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{ asset('admin/dist/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('admin/dist/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Page Vendors Javascript-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{ asset('/admin/dist/js/custom/documentation/forms/flatpickr.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.4/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('admin/dist/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script> --}}

<script>
    function checkForm(form) // Submit button clicked
    {
        if ($(form).valid()) {
            // console.log('valid');
            var btn = document.getElementById("submitBtn");
            btn.innerHTML = "<i class='fa fa-spinner fa-spin'></i> Please wait...";
            form.submitBtn.disabled = true;
            return true;
        }
        // console.log('invalid');
        return false;
    }

    function maxIntDigits() {
        return env('MAX_INT_DIGIT');
    }

    function isPositiveInteger(str) {
        // if (typeof str !== 'string') {
        //     return false;
        // }
        const num = Number(str);
        if (!isNaN(num)) {
            // if (Number.isInteger(num) && num > 0) {
            //     return true;
            // }
            var len = num.toString().length;
            console.log('len = ', len);

            let max_digit = `{{ env('MAX_INT_DIGIT') }}`;
            console.log('aas', max_digit);

            if (len < max_digit) {
                return true;
            }
        }
        return false;
    }


    // make select2 work with jquery validation plugin
    $("select").on("select2:close", function(e) {
        $(this).valid();
    });

    $("img").lazyload({
        effect: "fadeIn"
    });

    $(document).on('keypress', '.only_number', function(e) {
        // Only ASCII charactar in that range allowed
        var ASCIICode = (e.which) ? e.which : e.keyCode;
        $("#onlynumber_error").html("");
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) {
            $("#onlynumber_error").html("Only Numbers allowed.");
            return false;
        }
        return true;
    });

    function actionButton(edit_url, id, deleteclass = "clsdelete") {
        KTMenu.createInstances();
        return `<a href="#" class="btn btn-light btn-active-light-primary btn-sm"
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
                    <div class="menu-item px-3">
                        <a href="` + edit_url + `" data-id="` + id + `" title="Edit"
                            class="menu-link px-3">Edit</a>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="javascript:;" class="menu-link px-3 ${deleteclass}" data-id="${id}"
                            data-kt-users-table-filter="delete_row">Delete</a>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::Menu-->`;
    }

    function actionEditButton(url, id) {
        return `<a href="` + url + `" data-id="` + id + `" title="Edit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                        </svg>
                    </span>
                </a>`;
    }

    function setStringLength(string_value, length = 20) {
        return string_value.length > length ? string_value.substring(0, length) + "..." : string_value;
    }

    function actionHomeButton(url, id) {
        // return `<a class="btn btn-sm btn-clean btn-icon btn-icon-md" target="_blank" href="`+url+`" data-id="` + id + `" title="Edit"><i class="fa fa-edit text-success" ></i></a>`;
        return `<a class="button px-2 mr-1 mb-2 mt-2 text-white mr-3 bg-theme-12" data-toggle="modal" data-target="#delete-confirmation-modal3" href="javascript:;" onclick="status('7','1')">
                    <span class="w-5 h-5 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home w-4 h-4"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></span>
                </a>`;
    }

    function getDateByFormat(date) {
        const d = new Date(date);
        const ye = new Intl.DateTimeFormat('en', {
            year: 'numeric'
        }).format(d);
        const mo = new Intl.DateTimeFormat('en', {
            month: 'short'
        }).format(d);
        const da = new Intl.DateTimeFormat('en', {
            day: '2-digit'
        }).format(d);
        return `${da} ${mo} ${ye}`;
    }

    function getDateTimeByFormat(date) {
        const d = new Date(date);
        const ye = new Intl.DateTimeFormat('en', {
            year: 'numeric'
        }).format(d);
        const mo = new Intl.DateTimeFormat('en', {
            month: 'short'
        }).format(d);
        const da = new Intl.DateTimeFormat('en', {
            day: '2-digit'
        }).format(d);
        // const h = new Intl.DateTimeFormat('en', {
        //     hour: '2-digit'
        // }).format(d);
        // const i = new Intl.DateTimeFormat('en', {
        //     minute: '2-digit'
        // }).format(d);
        // return `${da} ${mo} ${ye} ${h}:${i}`;
        return `${da} ${mo} ${ye}`;
    }

    function getDurationByDate(date) {
        const createDate = new Date(date);
        const nowDate = new Date();
        const diffTime = Math.abs(nowDate - createDate);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        return diffDays;

    }

    function isValidHttpUrl(string) {
        let url;

        try {
            url = new URL(string);
        } catch (_) {
            return false;
        }

        return url.protocol === "http:" || url.protocol === "https:";
    }

    function actionShowButton(url) {
        return `<a href="` + url + `" title="Show" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                <span class="svg-icon svg-icon-3">
                  <i class="bi bi-eye fs-2"></i>
                </span>
            </a>`;
    }

    function actionShowNotesButton(url) {
        return `<a href="` + url + `" title="Show Notes" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                <span class="svg-icon svg-icon-3">
                    <i class="fas fa-sticky-note"></i>
                </span>
            </a>`;
    }

    function actionAddNotesButton(url) {
        return `<a href="` + url + `" title="Add Notes" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                <span class="svg-icon svg-icon-3">
                    <i class="far fa-sticky-note"></i>
                </span>
            </a>`;
    }

    function actionShowTitle(url, stringTitle) {
        return `<a class="btn btn-sm btn-clean" href="` + url + `" title="` + stringTitle + `">` + stringTitle + `</a>`;
    }

    function actionDeleteButton(id, deleteclass = "clsdelete") {
        return `<a href="javascript:;" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm ${deleteclass}" data-id="${id}">
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
                                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                    </span>
                </a>`;
    }

    function serialNumberShow(meta) {
        return (parseInt(meta.row) + parseInt(meta.settings._iDisplayStart + 1));
    }

    function actionActiveButton(data, attr, statusclass = "clsstatus") {
        // return parseInt(data) ? "<span class=\"badge badge-success cursor-pointer "+statusclass+" \" "+ attr +" >"+"{{ trans_choice('content.active_title', 1) }}"+"</span>" : "<span class=\"badge badge-danger cursor-pointer  "+statusclass+" \" "+ attr +">"+"Deactivate"+"</span>";
        if (data == 1) {
            return `<div class="badge badge-light-success fw-bolder ${statusclass}" ${attr}>{{ trans_choice('content.active_title', 1) }}</div>`;
        } else {
            return `<div class="badge badge-light-danger fw-bolder ${statusclass}" ${attr}>{{ trans_choice('content.inactive_title', 1) }}</div>`;
        }
    }

    function actionApprovedButton(data, attr, statusclass = "clsstatus") {
        // return parseInt(data) ? "<span class=\"badge badge-success cursor-pointer "+statusclass+" \" "+ attr +" >"+"{{ trans_choice('content.active_title', 1) }}"+"</span>" : "<span class=\"badge badge-danger cursor-pointer  "+statusclass+" \" "+ attr +">"+"Deactivate"+"</span>";
        if (data == 1) {
            return `<div class="badge badge-primary fw-bolder ${statusclass}" ${attr}>{{ trans_choice('content.approved_title', 1) }}</div>`;
        } else if (data == 0) {
            return `<div class="badge badge-secondary fw-bolder ${statusclass}" ${attr}>{{ trans_choice('content.pending_title', 1) }}</div>`;
        } else {
            return `<div class="badge badge-danger fw-bolder ${statusclass}" ${attr}>{{ trans_choice('content.rejected_title', 1) }}</div>`;
        }
    }

    function actionPaidButton(data, attr, statusclass = "clsstatus") {
        // return parseInt(data) ? "<span class=\"badge badge-success cursor-pointer "+statusclass+" \" "+ attr +" >"+"Paid"+"</span>" : "<span class=\"badge badge-danger cursor-pointer  "+statusclass+" \" "+ attr +">"+"Deactivate"+"</span>";
        if (data == 1) {
            return `<div class="badge badge-light-success fw-bolder ${statusclass}" ${attr}>Paid</div>`;
        } else {
            return `<div class="badge badge-light-danger fw-bolder ${statusclass}" ${attr}>UnPaid</div>`;
        }
    }

    function actionTitleButton(data, url) {
        return `<a class="" href="${url}"><div class="text-dark fw-bolder text-hover-primary mb-1 fs-6">${data}</div></a>`;

    }

    function imagesPreview(input, image_id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#' + image_id).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    // Multiple images preview with JavaScript
    function multipleImagesPreview(input, placeToInsertImagePreview) {
        if (input.files) {
            $(placeToInsertImagePreview).html('');
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $($.parseHTML('<img>'))
                        .attr('src', e.target.result)
                        .attr('width', 'auto')
                        .attr('height', 80)
                        .attr('class', 'img-img-responsive m-2')
                        .appendTo(placeToInsertImagePreview);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    function deleteImage(url, elem) {
        Swal.fire({
            title: "{{ __('messages.title_alert_message') }}",
            text: "{{ __('messages.delete_alert_message') }}",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: url,
                            type: 'DELETE',
                            dataType: 'json'
                        })
                        .done(function(response) {
                            if (response.status == 1) {
                                elem.remove();
                                Swal.fire('Deleted!', response.message, 'success');
                            } else {
                                Swal.fire('Info!', response.message, 'info');
                            }
                        })
                        .fail(function() {
                            Swal.fire('Oops...', 'Something went wrong!', 'error');
                        });
                });
            },
            allowOutsideClick: false
        });
    }

    function tableDeleteRow(url, oTable) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: url,
                            type: 'DELETE',
                            dataType: 'json'
                        })
                        .done(function(response) {
                            oTable.draw();
                            Swal.fire('Deleted!', response.message, 'success');
                        })
                        .fail(function(response) {
                            Swal.fire('Oops...', 'Something went wrong!', 'error');
                        });
                });
            },
            allowOutsideClick: false
        });
    }

    function tableChnageStatus(url, oTable, message = 'You will be able to revert this') {
        Swal.fire({
            title: "Are you sure?",
            text: "You wont be able to revert this!",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Confirm",
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            url: url,
                            type: 'GET',
                            dataType: 'json'
                        })
                        .done(function(response) {
                            if (response.status == 1) {
                                oTable.draw();
                                Swal.fire('Updated!', response.message, 'success');
                            } else {
                                Swal.fire('Info!', response.message, 'info');
                            }
                        })
                        .fail(function() {
                            Swal.fire('Oops...', 'Something went wrong!',
                                'error');
                        });
                });
            },
            allowOutsideClick: false
        });
    }

    function tableChnageStatusRadio(url, oTable, message = 'You will be able to revert this') {
        Swal.fire({
                title: "Are you sure?",
                text: "You wont be able to revert this!",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes, delete it!",
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
            })
            .then(function(result) {
                if (result.value) {
                    $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            url: url,
                            type: 'GET',
                            dataType: 'json'
                        })
                        .done(function(response) {
                            if (response.status == 1) {
                                oTable.draw();
                                Swal.fire('Updated!', response.message, 'success');
                            } else {
                                Swal.fire('Info!', response.message, 'info');
                            }
                        })
                        .fail(function() {
                            Swal.fire('Oops...', 'Something went wrong!', 'error');
                        });
                    // result.dismiss can be "cancel", "overlay",
                    // "close", and "timer"
                } else if (result.dismiss === "cancel") {
                    oTable.draw();
                    Swal.fire('Cancelled', 'Action ha been cancelled.', 'info')
                } else {
                    oTable.draw();
                    Swal.fire('Cancelled', 'Your have changed your mind.', 'info')
                }
            });
    }

    function updateStatus(url, className, message = 'You will be able to revert this') {
        Swal.fire({
            title: 'Are you sure?',
            text: message,
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            url: url,
                            type: 'GET',
                            dataType: 'json'
                        })
                        .done(function(response) {
                            if (response.status == 1) {
                                $('.' + className).load(location + '. ' +
                                    className);
                                window.location.reload();
                                Swal.fire('Updated!', response.message, 'success');
                            } else {
                                Swal.fire('Info!', response.message, 'info');
                            }
                        })
                        .fail(function() {
                            Swal.fire('Oops...', 'Something went wrong!',
                                'error');
                        });
                });
            },
            allowOutsideClick: false
        });
    }

    function actionShowNotesButton(url) {
        return `<a href="` + url + `" title="Show Notes" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                <span class="svg-icon svg-icon-3">
                    <i class="fas fa-sticky-note"></i>
                </span>
            </a>`;
    }

    function actionAddNotesButton(url) {
        return `<a href="` + url + `" title="Add Notes" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                <span class="svg-icon svg-icon-3">
                    <i class="far fa-sticky-note"></i>
                </span>
            </a>`;
    }

    function actionResendButton(id) {
        return `<a href="javascript:;" title="Resend" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 resend" data-id="${id}">
                <span class="svg-icon svg-icon-3">
                    <i class="fas fa-undo-alt"></i>
                </span>
            </a>`;
    }

    function userImageNameButton(url, name = 'Guest', email = '', img_url = '') {
        if (img_url == '' || img_url == null) {
            var img_url = '{{ asset('admin/dist/media/avatars/150-26.jpg') }}';
        }
        return `<!--begin:: Avatar -->
                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="` + url + `">
                            <div class="symbol-label">
                                <img src="` + img_url + `" alt="User-Image" class="w-100" />
                            </div>
                        </a>
                    </div>
                    <!--end::Avatar-->
                    <!--begin::User details-->
                    <div class="d-flex flex-column">
                        <a href="` + url + `" class="text-gray-800 text-hover-primary mb-1">` + name + `</a>
                        <span>` + email + `</span>
                    </div>
                <!--begin::User details-->`;
    }
    toastr.options = {
        "closeButton": true,
        "debug": true,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "4000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    function toggleFilterDrawerManually() {
        var drawerElement = document.querySelector("#kt_drawer_filter");
        var drawer = KTDrawer.getInstance(drawerElement);
        drawer.toggle();
    }


    function actionShowWithModal(attr, statusclass = "clsShowModal") {


        return `<a title="Show" class="btn btn-icon btn-bg-light ${statusclass} btn-active-color-primary btn-sm me-1" ${attr}>
                <span class="svg-icon svg-icon-3">
                  <i class="bi bi-eye fs-2"></i>
                </span>
            </a>`;
    }


    function actionEditWithModal(attr, statusclass = "clsEditModal") {

        return `<a title="Edit" class="btn btn-icon btn-bg-light ${statusclass} btn-active-color-primary btn-sm me-1" ${attr} >
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                        </svg>
                    </span>
                </a>`;

        return html_data_retun;
    }

    function getModalEditData(id, url) {
        $.ajax({
            url: url,
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            // dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('.clsEditModal').css('pointer-events', 'none');
            },
            success: function(response) {
                $('#form_modal_body').html(response.data);
                $('#editDataModal').modal('show');
                $('.clsEditModal').css('pointer-events', '');
            },
            error: function() {
                $('.clsEditModal').css('pointer-events', '');
            },
        })
    }

    function getModalShowData(id, url) {
        $.ajax({
            url: url,
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            // dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('.clsShowModal').css('pointer-events', 'none');
            },
            success: function(response) {
                $('#details_modal_body').html(response.data);
                $('#viewDataModal').modal('show');
                $('.clsShowModal').css('pointer-events', '');
            },
            error: function() {
                $('.clsShowModal').css('pointer-events', '');
            },
        })
    }

    $(document).on('click', '#btnClosePopupEdit', function(e) {
        $("#editDataModal").modal('hide');
    });

    function customFnErrors(form, element_errors) {
        form.find('.invalid-feedback').remove();
        $.each(element_errors, function(key, element_error) {
            var html = `<div class="invalid-feedback" style="display: block;color: red;">`;
            $.each(element_error, function(index, error) {
                html = html + error;
            });
            html = html + `</div>`;
            if (key.indexOf(".") != -1) {
                var arr = key.split(".");
                var selector = "[name='" + arr[0];
                for (var i = 1; i < arr.length; i++) {
                    selector = selector + "[" + arr[i] + "]";
                }
                selector = selector + "']";
                form.find(selector).closest('.col-md-6.fv-row').append(html);
            } else {
                if (form.find('[name="' + key + '"]').length) {
                    form.find('[name="' + key + '"]').closest(' .col-md-6.fv-row').append(html);
                } else if (form.find('[name="' + key + '[]"]').length) {
                    form.find('[name="' + key + '[]"]').closest('.col-md-6.fv-row').append(html);
                }
            }
        });
    }
</script>
<!--end::Javascript-->
