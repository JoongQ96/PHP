<?php $__env->startSection('title'); ?>
    test 페이지
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    MyLaravelTest
    <ul>
        <?php $__currentLoopData = $webPrograms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webProgram): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($webProgram); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\helloLaravel\laravel\resources\views/test.blade.php ENDPATH**/ ?>