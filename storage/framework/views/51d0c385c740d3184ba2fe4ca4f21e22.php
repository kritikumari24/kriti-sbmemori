<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Profile</div>
                <div class="card-body">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <img src="<?php echo e($user->image ?? asset('images/default-avatar.png')); ?>" 
                                 class="img-fluid rounded-circle" alt="Profile Picture">
                        </div>
                        <div class="col-md-8">
                            <h4><?php echo e($user->name); ?></h4>
                            <p><strong>Email:</strong> <?php echo e($user->email); ?></p>
                            <p><strong>Mobile:</strong> <?php echo e($user->mobile_no ?? 'Not provided'); ?></p>
                            <p><strong>Role:</strong> Parent</p>
                            <p><strong>Status:</strong> 
                                <span class="badge <?php echo e($user->is_active ? 'bg-success' : 'bg-danger'); ?>">
                                    <?php echo e($user->is_active ? 'Active' : 'Inactive'); ?>

                                </span>
                            </p>
                            <a href="<?php echo e(route('parents.profile.edit')); ?>" class="btn btn-primary">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Herd\kriti-sbmemori\resources\views/parents/profile/index.blade.php ENDPATH**/ ?>