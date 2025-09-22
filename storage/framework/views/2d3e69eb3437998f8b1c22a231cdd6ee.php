<?php $__env->startPush('scripts'); ?>
    <?php if($message = session()->get('success')): ?>
        <script>
            toastr.success('<?php echo e($message); ?>');
        </script>
    <?php endif; ?>
    <?php if($message = session()->get('error')): ?>
        <script>
            toastr.error('<?php echo e($message); ?>');
        </script>
    <?php endif; ?>
    <?php if($message = session()->get('info')): ?>
        <script>
            toastr.info('<?php echo e($message); ?>');
        </script>
    <?php endif; ?>
    <?php if($message = session()->get('warning')): ?>
        <script>
            toastr.warning('<?php echo e($message); ?>');
        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\Herd\sbmemori\resources\views/admin/layouts/partials/flash.blade.php ENDPATH**/ ?>