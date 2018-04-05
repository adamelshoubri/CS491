<?php $__env->startSection('content'); ?>


<div class="container" align="center">
    <div class="col-md-6 mt-5" align="left">
        <form class="form-signin" method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo e(csrf_field()); ?>

            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="email" class="sr-only">Email address</label>
            <input input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" class="form-control mt-3" placeholder="Email address" required autofocus>
            <?php if($errors->has('email')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('email')); ?></strong>
                </span>
            <?php endif; ?>
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
            <?php if($errors->has('password')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('password')); ?></strong>
                </span>
            <?php endif; ?>
            <div class="checkbox">
                <label>
                <input type="checkbox" value="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
        <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
            Forgot Your Password?
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>