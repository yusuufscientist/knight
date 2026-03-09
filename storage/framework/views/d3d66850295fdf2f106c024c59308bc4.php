

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Panels - <?php echo e($solarSystem->name); ?></h1>
        <a href="<?php echo e(route('solar-systems.panels.create', $solarSystem)); ?>" class="btn btn-primary">
            Add Panel
        </a>
    </div>

    <?php if($panels->isEmpty()): ?>
        <div class="alert alert-info">
            No panels found. Add your first panel to start monitoring.
        </div>
    <?php else: ?>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Serial Number</th>
                            <th>Model</th>
                            <th>Manufacturer</th>
                            <th>Capacity (Watts)</th>
                            <th>Status</th>
                            <th>Alerts</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $panels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $panel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($panel->serial_number); ?></td>
                            <td><?php echo e($panel->model); ?></td>
                            <td><?php echo e($panel->manufacturer); ?></td>
                            <td><?php echo e($panel->capacity_watts); ?>W</td>
                            <td>
                                <span class="badge bg-<?php echo e($panel->status === 'active' ? 'success' : 'secondary'); ?>">
                                    <?php echo e($panel->status); ?>

                                </span>
                            </td>
                            <td><?php echo e($panel->alerts_count); ?></td>
                            <td>
                                <a href="<?php echo e(route('solar-systems.panels.show', [$solarSystem, $panel])); ?>" class="btn btn-sm btn-info">View</a>
                                <a href="<?php echo e(route('solar-systems.panels.edit', [$solarSystem, $panel])); ?>" class="btn btn-sm btn-warning">Edit</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fcyusuuf\Desktop\compo\SolarSmart\resources\views/panels/index.blade.php ENDPATH**/ ?>