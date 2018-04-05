<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card mt-3 mb-3">
      <h4 class="card-header">Dashboard</h4>
      <div class="card-body">
          <table class="table">
              <thead>
                  <tr>
                      <th>My Surveys</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $__currentLoopData = $surveys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $survey): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                          <td><?php echo e($survey->title); ?>

                      </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
          </table>
          <a class="btn btn-primary" href="<?php echo e(route('surveys.create')); ?>">New Survey</a>
      </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>