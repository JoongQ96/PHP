<?php $__env->startSection('title', '글 작가 페이지'); ?>

<?php $__env->startSection('content'); ?>
    <div class="px-64">
        <h1 class="font-bold text-3xl">글 작가 페이지</h1><br>
        <table class="border board-gray-800 w-full">
            <tr>
                <td>번호</td><td>제목</td><td>작성자</td><td>날짜</td>
            </tr>
            <?php $__currentLoopData = $writerInfoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $writerInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($writerInfo->id); ?></td>
                    <td><a href="/writer/<?php echo e($writerInfo->id); ?>"><?php echo e($writerInfo->title); ?></a></td>
                    <td><?php echo e($writerInfo->user_id); ?></td>
                    <td><?php echo e($writerInfo->updated_at); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
        <div>
            <?php echo e($writerInfoes->links()); ?>

        </div>
        <br>
        <button class="bg-blue-600 text-white px-4 py-2 float-right" onclick="location.href='<?php echo e(route('home')); ?>'">h o m e</button>
        <button class="bg-blue-600 text-white px-4 py-2 float-right" onclick="location.href='<?php echo e(route('writer.create')); ?>'">글 작성</button>
    </div>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\helloLaravel\laravel\resources\views/writer/writer.blade.php ENDPATH**/ ?>