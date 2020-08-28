<?php $__env->startSection('title', '글 작가 페이지'); ?>

<?php $__env->startSection('content'); ?>
    <div>
        <ul class="float-left ml-5 text-blue-700    md:text-center">
            <li class="font-bold text-2xl">메     뉴</li>
            <li><a href="<?php echo e(route('home')); ?>">home</a></li>
            <li>공지사항</li>
            <li><a href="<?php echo e(route('writers.writer')); ?>">글  작가 페이지</a></li>
            <li><a href="<?php echo e(route('painters.painter')); ?>">그림 작가 페이지</a></li>
        </ul>
    </div>
    <div class="px-64">
        <h1 class="font-bold text-3xl">글 작가 페이지</h1><br>
        <table class="border border-gray-800 w-full">
            <tr>
                <td>번호</td><td>제목</td><td>작성자</td><td>날짜</td>
            </tr>
            <?php $__currentLoopData = $writerInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $writerInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($writerInfo->id); ?></td>
                    <td><a href="/writers/<?php echo e($writerInfo->id); ?>"><?php echo e($writerInfo->title); ?></a></td>
                    <td><?php echo e($writerInfo->user_id); ?></td>
                    <td><?php echo e($writerInfo->updated_at); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table><br>
        <div class="px-20">
            <?php echo e($writerInfos->links()); ?>

        </div>
        <br>
        <a href="<?php echo e(route('home')); ?>" class="bg-blue-600 text-white px-4 py-2 float-right ml-2">h o m e</a>
        <a href="<?php echo e(route('writers.create')); ?>" class="bg-blue-600 text-white px-4 py-2 float-right">글 작성</a>
    </div>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\helloLaravel\laravel\resources\views/writers/writer.blade.php ENDPATH**/ ?>