

<?php $__env->startSection('title', 'Alert Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2">Alert Details</h1>
    <a href="<?php echo e(route('alerts.index')); ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-exclamation-triangle me-2"></i>Alert Information</span>
                <span class="badge bg-<?php echo e($alert->statusBadge()); ?>"><?php echo e(ucfirst($alert->status)); ?></span>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <small class="text-muted d-block">Title</small>
                        <h5 class="mb-0"><?php echo e($alert->title); ?></h5>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block">Type</small>
                        <strong><?php echo e($alert->typeLabel()); ?></strong>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <small class="text-muted d-block">Severity</small>
                        <span class="badge bg-<?php echo e($alert->severityColor()); ?>"><?php echo e(ucfirst($alert->severity)); ?></span>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block">Triggered At</small>
                        <strong><?php echo e($alert->triggered_at->format('M d, Y H:i')); ?></strong>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <small class="text-muted d-block">Solar System</small>
                        <a href="<?php echo e(route('solar-systems.show', $alert->solarSystem)); ?>">
                            <?php echo e($alert->solarSystem->name); ?>

                        </a>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block">Panel</small>
                        <?php if($alert->panel): ?>
                            <a href="<?php echo e(route('solar-systems.panels.show', [$alert->solarSystem, $alert->panel])); ?>">
                                <?php echo e($alert->panel->serial_number); ?>

                            </a>
                        <?php else: ?>
                            <span class="text-muted">N/A</span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted d-block">Message</small>
                    <p class="mb-0"><?php echo e($alert->message); ?></p>
                </div>

                <?php if($alert->acknowledged_at): ?>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <small class="text-muted d-block">Acknowledged At</small>
                            <strong><?php echo e($alert->acknowledged_at->format('M d, Y H:i')); ?></strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Acknowledged By</small>
                            <strong><?php echo e($alert->acknowledgedBy->name); ?></strong>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($alert->resolved_at): ?>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <small class="text-muted d-block">Resolved At</small>
                            <strong><?php echo e($alert->resolved_at->format('M d, Y H:i')); ?></strong>
                        </div>
                    </div>
                    <?php if($alert->resolution_notes): ?>
                        <div class="mb-3">
                            <small class="text-muted d-block">Resolution Notes</small>
                            <p class="mb-0"><?php echo e($alert->resolution_notes); ?></p>
                        </div>
                    <?php endif; ?>
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
                <?php if($alert->status === 'active'): ?>
                    <form action="<?php echo e(route('alerts.acknowledge', $alert)); ?>" method="POST" class="mb-2">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-warning w-100">
                            <i class="bi bi-check me-2"></i>Acknowledge
                        </button>
                    </form>
                <?php endif; ?>

                <?php if($alert->status !== 'resolved'): ?>
                    <button type="button" class="btn btn-success w-100 mb-2" data-bs-toggle="modal" data-bs-target="#resolveModal">
                        <i class="bi bi-check-circle me-2"></i>Resolve
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Resolve Modal -->
<?php if($alert->status !== 'resolved'): ?>
<div class="modal fade" id="resolveModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo e(route('alerts.resolve', $alert)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Resolve Alert</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Resolution Notes</label>
                        <textarea name="resolution_notes" class="form-control" rows="3" placeholder="Describe how this alert was resolved..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Resolve Alert</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fcyusuuf\Desktop\compo\SolarSmart\resources\views/alerts/show.blade.php ENDPATH**/ ?>