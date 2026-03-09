

<?php $__env->startSection('title', $solarSystem->name); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h2"><?php echo e($solarSystem->name); ?></h1>
        <p class="text-muted mb-0"><i class="bi bi-geo-alt me-1"></i><?php echo e($solarSystem->location); ?></p>
    </div>
    <div>
        <a href="<?php echo e(route('solar-systems.edit', $solarSystem)); ?>" class="btn btn-outline-secondary me-2">
            <i class="bi bi-pencil me-2"></i>Edit
        </a>
        <a href="<?php echo e(route('solar-systems.panels.create', $solarSystem)); ?>" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>Add Panel
        </a>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-muted mb-1">Today's Production</h6>
                    <h3 class="mb-0"><?php echo e(number_format($stats['today_production'], 2)); ?> <small class="fs-6">kWh</small></h3>
                </div>
                <div class="stat-icon bg-solar">
                    <i class="bi bi-lightning-charge"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-muted mb-1">Monthly Production</h6>
                    <h3 class="mb-0"><?php echo e(number_format($stats['month_production'], 2)); ?> <small class="fs-6">kWh</small></h3>
                </div>
                <div class="stat-icon bg-info-light">
                    <i class="bi bi-calendar-month"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-muted mb-1">Active Panels</h6>
                    <h3 class="mb-0"><?php echo e($stats['active_panels']); ?> <small class="fs-6">/ <?php echo e($stats['total_panels']); ?></small></h3>
                </div>
                <div class="stat-icon bg-success-light">
                    <i class="bi bi-sun"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="text-muted mb-1">Efficiency</h6>
                    <h3 class="mb-0"><?php echo e(number_format($stats['efficiency'], 1)); ?><small class="fs-6">%</small></h3>
                </div>
                <div class="stat-icon bg-<?php echo e($stats['efficiency'] >= 80 ? 'success' : ($stats['efficiency'] >= 50 ? 'warning' : 'danger')); ?>-light">
                    <i class="bi bi-graph-up"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Panels List -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-sun me-2"></i>Solar Panels</span>
                <a href="<?php echo e(route('solar-systems.panels.index', $solarSystem)); ?>" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                <?php if($solarSystem->panels->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Serial Number</th>
                                    <th>Model</th>
                                    <th>Capacity</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $solarSystem->panels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $panel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($panel->serial_number); ?></td>
                                        <td><?php echo e($panel->model); ?></td>
                                        <td><?php echo e($panel->capacity_watts); ?> W</td>
                                        <td>
                                            <span class="badge bg-<?php echo e($panel->status === 'active' ? 'success' : ($panel->status === 'faulty' ? 'danger' : 'warning')); ?>">
                                                <?php echo e(ucfirst($panel->status)); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('solar-systems.panels.show', [$solarSystem, $panel])); ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="bi bi-sun text-muted" style="font-size: 2rem;"></i>
                        <p class="mt-2 text-muted">No panels added yet</p>
                        <a href="<?php echo e(route('solar-systems.panels.create', $solarSystem)); ?>" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-lg me-1"></i>Add Panel
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Active Alerts -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-exclamation-triangle me-2"></i>Active Alerts</span>
                <?php if($stats['active_alerts'] > 0): ?>
                    <span class="badge bg-danger"><?php echo e($stats['active_alerts']); ?></span>
                <?php endif; ?>
            </div>
            <div class="card-body p-0">
                <?php if($solarSystem->alerts->count() > 0): ?>
                    <div class="list-group list-group-flush">
                        <?php $__currentLoopData = $solarSystem->alerts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">
                                        <span class="badge bg-<?php echo e($alert->severityColor()); ?>"><?php echo e($alert->severity); ?></span>
                                    </h6>
                                    <small class="text-muted"><?php echo e($alert->triggered_at->diffForHumans()); ?></small>
                                </div>
                                <p class="mb-1"><?php echo e($alert->title); ?></p>
                                <form action="<?php echo e(route('alerts.acknowledge', $alert)); ?>" method="POST" class="mt-2">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-warning">Acknowledge</button>
                                </form>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="bi bi-check-circle text-success" style="font-size: 2rem;"></i>
                        <p class="mt-2 text-muted">No active alerts</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- System Details -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-info-circle me-2"></i>System Details
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <small class="text-muted d-block">Installation Date</small>
                        <strong><?php echo e($solarSystem->installation_date->format('M d, Y')); ?></strong>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted d-block">Total Capacity</small>
                        <strong><?php echo e($solarSystem->total_capacity_kw); ?> kW</strong>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted d-block">Status</small>
                        <span class="badge bg-<?php echo e($solarSystem->status === 'active' ? 'success' : ($solarSystem->status === 'maintenance' ? 'warning' : 'secondary')); ?>">
                            <?php echo e(ucfirst($solarSystem->status)); ?>

                        </span>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted d-block">Coordinates</small>
                        <strong><?php echo e($solarSystem->latitude ? $solarSystem->latitude . ', ' . $solarSystem->longitude : 'N/A'); ?></strong>
                    </div>
                </div>
                <?php if($solarSystem->description): ?>
                    <div class="mt-3">
                        <small class="text-muted d-block">Description</small>
                        <p class="mb-0"><?php echo e($solarSystem->description); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fcyusuuf\Desktop\compo\SolarSmart\resources\views/solar-systems/show.blade.php ENDPATH**/ ?>