<?php $__env->startSection('content'); ?>
    <h1>Project List</h1>
    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    Title : <?php echo e($project->title); ?><br>
    Description : <?php echo e($project->description); ?><br>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\helloLaravel\laravel\resources\views/projects/index.blade.php ENDPATH**/ ?>