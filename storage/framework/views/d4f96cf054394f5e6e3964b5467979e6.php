<!--begin::Input group-->
<div class="row mb-5">
    <!--begin::Col-->
    <div class="col-md-6 fv-row">
        <!--begin::Label-->
        <label class="required fs-5 fw-bold mb-2"><?php echo e(trans_choice('content.name_title', 1)); ?></label>
        <!--end::Label-->
        <!--begin::Input-->
        
        <?php echo html()->text('name', null)->attributes([
                'placeholder' => 'Name',
                'class' => 'form-control form-control-solid',
            ]); ?>

        <!--end::Input-->
        <?php if($errors->has('name')): ?>
            <span style="color:red"><?php echo e($errors->first('name')); ?></span>
        <?php endif; ?>
    </div>
    <!--end::Col-->
</div>
<!--end::Input group-->

<!--begin::Input group-->

<!--end::Input group-->

<!--begin::Input group-->
<div class="row mb-5">
    <!--begin::Col-->
    <div class="col-md-10 fv-row">
        <!--end::Label-->
        <label class="required fs-5 fw-bold mb-2"><?php echo e(trans_choice('content.permission_title', 2)); ?></label><br>
        <!--end::Label-->

        <div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" name="all_permission" value="1">
            <label class="custom-control-label" name="all_permission" style="font-weight: 600">
                All
            </label>
        </div>
        <?php if($errors->has('permissions')): ?>
            <span style="color:red">At Least one permission should be required</span>
        <?php endif; ?>
        <table class="table table-striped">
            <tbody style="display:flex; flex-wrap:wrap;">
                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="width: 30%">
                        <td>
                            

                            <?php echo html()->checkbox('permissions[]<?php echo e($value->name); ?>', in_array($value->id, $rolePermissions) ? 'checked' : '', $value->id)->attributes([
                                    'class' => 'permission',
                                    'id' => 'permission_' . $key,
                                    'type' => 'checkbox',
                                ]); ?>


                        </td>
                        <td style="font-weight: 600"> <label for="<?php echo e('permission_' . $key); ?>">
                                <?php echo e($value->name); ?></label></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <!--end::Col-->
</div>
<!--end::Input group-->

<!--begin::Separator-->
<div class="separator mb-8"></div>
<!--end::Separator-->
<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        $(document).ready(function() {

            if ($('input[type="checkbox"].permission:checked').length == $(
                    'input[type="checkbox"].permission')
                .length) {
                $('input[name="all_permission"]').prop('checked', true);
            } else {
                $('input[name="all_permission"]').prop('checked', false);
            }

            $('[name="all_permission"]').on('click', function() {
                if ($(this).is(':checked')) {
                    $.each($('.permission'), function(index, value) {
                        $(value).prop('checked', true);
                    });
                } else {
                    $.each($('.permission'), function(index, value) {
                        $(value).prop('checked', false);
                    });
                }
            });

            $('input[type="checkbox"].permission').on('click', function() {
                $.each($('.permission'), function(index, value) {
                    if ($('input[type="checkbox"].permission:checked').length == $(
                            'input[type="checkbox"].permission')
                        .length) {
                        $('input[name="all_permission"]').prop('checked', true);
                    } else {
                        $('input[name="all_permission"]').prop('checked', false);
                    }
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\Herd\sbmemori\resources\views/admin/roles/form.blade.php ENDPATH**/ ?>