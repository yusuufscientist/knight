

<?php $__env->startSection('title', 'Intervention Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2">Intervention Details</h1>
    <a href="<?php echo e(route('interventions.index')); ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-tools me-2"></i>Intervention Information</span>
                <span class="badge bg-<?php echo e($intervention->statusBadge()); ?>"><?php echo e(ucfirst($intervention->status)); ?></span>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <small class="text-muted d-block">Type</small>
                        <strong><?php echo e($intervention->typeLabel()); ?></strong>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block">Priority</small>
                        <span class="badge bg-<?php echo e($intervention->priorityColor()); ?>"><?php echo e(ucfirst($intervention->priority)); ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <small class="text-muted d-block">Solar System</small>
                        <a href="<?php echo e(route('solar-systems.show', $intervention->solarSystem)); ?>">
                            <?php echo e($intervention->solarSystem->name); ?>

                        </a>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block">Panel</small>
                        <?php if($intervention->panel): ?>
                            <?php echo e($intervention->panel->serial_number); ?>

                        <?php else: ?>
                            <span class="text-muted">N/A</span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <small class="text-muted d-block">Technician</small>
                        <strong><?php echo e($intervention->technician->name); ?></strong>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block">Scheduled Date</small>
                        <strong><?php echo e($intervention->scheduled_date->format('M d, Y')); ?></strong>
                    </div>
                </div>

                <?php if($intervention->completed_date): ?>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <small class="text-muted d-block">Completed Date</small>
                            <strong><?php echo e($intervention->completed_date->format('M d, Y')); ?></strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Duration</small>
                            <strong><?php echo e($intervention->duration_minutes); ?> minutes</strong>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($intervention->cost): ?>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <small class="text-muted d-block">Cost</small>
                            <strong>$<?php echo e(number_format($intervention->cost, 2)); ?></strong>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <small class="text-muted d-block">Description</small>
                    <p class="mb-0"><?php echo e($intervention->description); ?></p>
                </div>

                <?php if($intervention->parts_replaced): ?>
                    <div class="mb-3">
                        <small class="text-muted d-block">Parts Replaced</small>
                        <p class="mb-0"><?php echo e($intervention->parts_replaced); ?></p>
                    </div>
                <?php endif; ?>

                <?php if($intervention->notes): ?>
                    <div class="mb-3">
                        <small class="text-muted d-block">Notes</small>
                        <p class="mb-0"><?php echo e($intervention->notes); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-gear me-2"></i>Actions
            </div>
            <div class="card-body">
                <?php if($intervention->status === 'scheduled'): ?>
                    <form action="<?php echo e(route('interventions.start', $intervention)); ?>" method="POST" class="mb-2">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-play-fill me-2"></i>Start Intervention
                        </button>
                    </form>
                <?php endif; ?>

                <?php if($intervention->status === 'in_progress'): ?>
                    <button type="button" class="btn btn-success w-100 mb-2" data-bs-toggle="modal" data-bs-target="#completeModal">
                        <i class="bi bi-check-lg me-2"></i>Complete
                    </button>
                <?php endif; ?>

                <a href="<?php echo e(route('interventions.edit', $intervention)); ?>" class="btn btn-outline-secondary w-100 mb-2">
                    <i class="bi bi-pencil me-2"></i>Edit
                </a>

                <form action="<?php echo e(route('interventions.destroy', $intervention)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this intervention?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-outline-danger w-100">
                        <i class="bi bi-trash me-2"></i>Delete
                    </button>
                </form>
            </div>
        </div>

        <?php if($intervention->alert): ?>
            <div class="card mt-4">
                <div class="card-header">
                    <i class="bi bi-exclamation-triangle me-2"></i>Related Alert
                </div>
                <div class="card-body">
                    <h6><?php echo e($intervention->alert->title); ?></h6>
                    <p class="text-muted small"><?php echo e($intervention->alert->message); ?></p>
                    <a href="<?php echo e(route('alerts.show', $intervention->alert)); ?>" class="btn btn-sm btn-outline-warning">View Alert</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Complete Modal -->
<?php if($intervention->status === 'in_progress'): ?>
<div class="modal fade" id="completeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo e(route('interventions.complete', $intervention)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Complete Intervention</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Duration (minutes) *</label>
                        <input type="number" name="duration_minutes" class="form-control" required min="1">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Parts Replaced</label>
                        <textarea name="parts_replaced" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cost</label>
                        <input type="number" step="0.01" name="cost" class="form-control" min="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Complete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fcyusuuf\Desktop\compo\SolarSmart\resources\views/interventions/show.blade.php ENDPATH**/ ?>