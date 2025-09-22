<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($data['title']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Staff Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto">
                    <span class="navbar-text me-3 d-none d-lg-block">Welcome, <?php echo e($data['user']->name); ?></span>
                    <span class="navbar-text d-lg-none mb-2">Welcome, <?php echo e($data['user']->name); ?></span>
                    <a class="nav-link" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none"><?php echo csrf_field(); ?></form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid px-3 mt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"><?php echo e($data['title']); ?></h4>
                    </div>
                    <div class="card-body">
                        <p class="lead mb-4">You are logged in as <strong>Staff</strong></p>
                        
                        <div class="row g-3">
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="card bg-primary text-white h-100">
                                    <div class="card-body text-center d-flex flex-column">
                                        <h5 class="card-title">Students</h5>
                                        <p class="card-text flex-grow-1">Manage student records</p>
                                        <a href="<?php echo e(route('staff.students.index')); ?>" class="btn btn-light btn-sm mt-auto">View Students</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="card bg-success text-white h-100">
                                    <div class="card-body text-center d-flex flex-column">
                                        <h5 class="card-title">Classes</h5>
                                        <p class="card-text flex-grow-1">Manage class schedules</p>
                                        <a href="#" class="btn btn-light btn-sm mt-auto">View Classes</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="card bg-info text-white h-100">
                                    <div class="card-body text-center d-flex flex-column">
                                        <h5 class="card-title">Reports</h5>
                                        <p class="card-text flex-grow-1">Generate reports</p>
                                        <a href="#" class="btn btn-light btn-sm mt-auto">View Reports</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH D:\Herd\kriti-sbmemori\resources\views/staff/dashboard.blade.php ENDPATH**/ ?>