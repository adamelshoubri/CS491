<?php $__env->startSection('content'); ?>
    <div id="app">
        <div class="container pt-4">
            <survey-creator></survey-creator>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>