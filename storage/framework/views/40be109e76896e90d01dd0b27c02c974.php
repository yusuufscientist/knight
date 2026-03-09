

<?php $__env->startSection('title', 'Solar Systems'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2">Solar Systems</h1>
    <a href="<?php echo e(route('solar-systems.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>Add New System
    </a>
</div>

<?php if($solarSystems->count() > 0): ?>
    <div class="row g-4">
        <?php $__currentLoopData = $solarSystems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $system): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><?php echo e($system->name); ?></h5>
                        <span class="badge bg-<?php echo e($system->status === 'active' ? 'success' : ($system->status === 'maintenance' ? 'warning' : 'secondary')); ?>">
                            <?php echo e(ucfirst($system->status)); ?>

                        </span>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <small class="text-muted d-block">Location</small>
                            <span><?php echo e($system->location); ?></span>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <small class="text-muted d-block">Capacity</small>
                                <strong><?php echo e($system->total_capacity_kw); ?> kW</strong>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">Panels</small>
                                <strong><?php echo e($system->panels_count); ?></strong>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-6">
                                <small class="text-muted d-block">Today's Production</small>
                                <strong class="text-success"><?php echo e(number_format($system->todayProduction(), 2)); ?> kWh</strong>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">Active Alerts</small>
                                <strong class="<?php echo e($system->alerts_count > 0 ? 'text-danger' : 'text-success'); ?>">
                                    <?php echo e($system->alerts_count); ?>

                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('solar-systems.show', $system)); ?>" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-eye me-1"></i>View
                            </a>
                            <div>
                                <a href="<?php echo e(route('solar-systems.edit', $system)); ?>" class="btn btn-outline-secondary btn-sm me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="<?php echo e(route('solar-systems.destroy', $system)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this system?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php else: ?>
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="bi bi-sun text-muted" style="font-size: 4rem;"></i>
            <h4 class="mt-3">No Solar Systems Yet</h4>
            <p class="text-muted">Start by adding your first solar system to monitor</p>
            <a href="<?php echo e(route('solar-systems.create')); ?>" class="btn btn-primary">
                <i class="bi bi-plus-lg me-2"></i>Add Solar System
            </a>
        </div>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fcyusuuf\Desktop\compo\SolarSmart\resources\views/solar-systems/index.blade.php ENDPATH**/ ?>