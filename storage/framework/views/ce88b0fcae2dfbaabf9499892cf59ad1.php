

<?php $__env->startSection('title', 'Register'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center py-5">
        <div class="col-md-6 col-lg-5">
            <div class="card glass animate__animated animate__fadeInUp" style="border-radius: 24px; border: 1px solid rgba(255, 107, 53, 0.3);">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="mb-3" style="width: 80px; height: 80px; margin: 0 auto; background: linear-gradient(135deg, #FF6B35 0%, #F7C94B 50%, #FF9F1C 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 30px rgba(255, 107, 53, 0.5);">
                            <i class="bi bi-sun-fill text-white" style="font-size: 2.5rem;"></i>
                        </div>
                        <h2 class="mt-3 fw-bold" style="background: linear-gradient(135deg, #FF6B35, #F7C94B); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Create Account</h2>
                        <p class="text-muted">Join SolarSmart today</p>
                    </div>

                    <form method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background: rgba(255, 107, 53, 0.1); border: 2px solid rgba(255, 255, 255, 0.1); border-right: none; border-radius: 12px 0 0 12px;">
                                    <i class="bi bi-person text-warning"></i>
                                </span>
                                <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       id="name" name="name" value="<?php echo e(old('name')); ?>" 
                                       placeholder="Enter your full name" required autofocus
                                       style="border-left: none; border-radius: 0 12px 12px 0;">
                            </div>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background: rgba(255, 107, 53, 0.1); border: 2px solid rgba(255, 255, 255, 0.1); border-right: none; border-radius: 12px 0 0 12px;">
                                    <i class="bi bi-envelope text-warning"></i>
                                </span>
                                <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       id="email" name="email" value="<?php echo e(old('email')); ?>" 
                                       placeholder="Enter your email" required
                                       style="border-left: none; border-radius: 0 12px 12px 0;">
                            </div>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background: rgba(255, 107, 53, 0.1); border: 2px solid rgba(255, 255, 255, 0.1); border-right: none; border-radius: 12px 0 0 12px;">
                                        <i class="bi bi-lock text-warning"></i>
                                    </span>
                                    <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           id="password" name="password" 
                                           placeholder="Password" required
                                           style="border-left: none; border-radius: 0 12px 12px 0;">
                                </div>
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label fw-semibold">Confirm</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background: rgba(255, 107, 53, 0.1); border: 2px solid rgba(255, 255, 255, 0.1); border-right: none; border-radius: 12px 0 0 12px;">
                                        <i class="bi bi-lock-fill text-warning"></i>
                                    </span>
                                    <input type="password" class="form-control"
                                           id="password_confirmation" name="password_confirmation" 
                                           placeholder="Confirm" required
                                           style="border-left: none; border-radius: 0 12px 12px 0;">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label fw-semibold">Phone Number <span class="text-muted">(Optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text" style="background: rgba(255, 107, 53, 0.1); border: 2px solid rgba(255, 255, 255, 0.1); border-right: none; border-radius: 12px 0 0 12px;">
                                    <i class="bi bi-phone text-warning"></i>
                                </span>
                                <input type="text" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       id="phone" name="phone" value="<?php echo e(old('phone')); ?>"
                                       placeholder="Enter phone number"
                                       style="border-left: none; border-radius: 0 12px 12px 0;">
                            </div>
                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-4">
                            <label for="address" class="form-label fw-semibold">Address <span class="text-muted">(Optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text" style="background: rgba(255, 107, 53, 0.1); border: 2px solid rgba(255, 255, 255, 0.1); border-right: none; border-radius: 12px 0 0 12px; align-items: flex-start; padding-top: 12px;">
                                    <i class="bi bi-geo-alt text-warning"></i>
                                </span>
                                <textarea class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                          id="address" name="address" rows="2"
                                          placeholder="Enter your address"
                                          style="border-left: none; border-radius: 0 12px 12px 0;"><?php echo e(old('address')); ?></textarea>
                            </div>
                            <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg fw-semibold">
                                <i class="bi bi-person-plus me-2"></i>Create Account
                            </button>
                        </div>
                    </form>

                    <div class="text-center">
                        <p class="mb-0 text-muted">Already have an account? 
                            <a href="<?php echo e(route('login')); ?>" class="fw-bold text-decoration-none" 
                               style="background: linear-gradient(135deg, #FF6B35, #F7C94B); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                Sign In
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\fcyusuuf\Desktop\compo\SolarSmart\resources\views/auth/register.blade.php ENDPATH**/ ?>