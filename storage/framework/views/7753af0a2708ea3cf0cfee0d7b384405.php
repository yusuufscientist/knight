

<?php $__env->startSection('title', 'Interventions'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2">Interventions</h1>
</div>

<div class="card">
    <div class="card-header">
        <i class="bi bi-tools me-2"></i>All Interventions
    </div>
    <div class="card-body p-0">
        <?php if($interventions->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Solar System</th>
                            <th>Technician</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $interventions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $intervention): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($intervention->scheduled_date->format('M d, Y')); ?></td>
                                <td><?php echo e($intervention->typeLabel()); ?></td>
                                <td><?php echo e($intervention->solarSystem->name); ?></td>
                                <td><?php echo e($intervention->technician->name); ?></td>
                                <td>
                                    <span class="badge bg-<?php echo e($intervention->priorityColor()); ?>">
                                        <?php echo e(ucfirst($intervention->priority)); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-<?php echo e($intervention->statusBadge()); ?>">
                                        <?php echo e(ucfirst($intervention->status)); ?>

                                    </span>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('interventions.show', $intervention)); ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <?php if($intervention->status === 'scheduled'): ?>
                                        <form action="<?php echo e(route('interventions.start', $intervention)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-warning" title="Start">
                                                <i class="bi bi-play"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    <?php if($intervention->status === 'in_progress'): ?>
                                        <form action="<?php echo e(route('interventions.complete', $intervention)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Complete">
                                                <i class="bi bi-check-circle"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                <?php echo e($interventions->links()); ?>

            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-tools text-muted" style="font-size: 3rem;"></i>
                <h5 class="mt-3">No Interventions</h5>
                <p class="text-muted">No maintenance interventions scheduled</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fcyusuuf\Desktop\compo\SolarSmart\resources\views/interventions/index.blade.php ENDPATH**/ ?>