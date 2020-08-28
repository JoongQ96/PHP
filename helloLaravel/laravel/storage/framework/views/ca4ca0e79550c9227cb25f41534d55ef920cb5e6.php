<?php $__env->startSection('title', '글 보기'); ?>

<?php $__env->startSection('content'); ?>
    <div class="px-64">
        <h1 class="font-bold text-3xl">글 보기</h1>
        <label class="block" for="title">제    목</label><small class="float-right">작성일 <?php echo e($writer->created_at); ?></small>
        <br>
        <input class="border board-gray-800 w-full" readonly type="text" name="title" id="title" value="<?php echo e($writer->title); ?>"><br>

        <label class="block" for="body">내    용</label><br>
        <textarea class="border board-gray-800 w-full" readonly name="body" id="body" cols="30" rows="10"><?php echo e($writer->contents); ?></textarea><br>

        <br>
        <button class="bg-blue-600 text-white px-4 py-2 float-left" onclick="location.href='/writer/writer'">M A I N</button>
        <form action="/writer/<?php echo e($writer->id); ?>" method="POST">
            <?php echo method_field('DELETE'); ?>
            <?php echo csrf_field(); ?>
            <button class="bg-blue-600 text-white px-4 py-2 float-right ml-2">글 삭제</button>
        </form>
        <button class="bg-blue-600 text-white px-4 py-2 float-right" onclick="location.href='/writer/<?php echo e($writer->id); ?>/edit'">글 수정</button>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\helloLaravel\laravel\resources\views/writer/show.blade.php ENDPATH**/ ?>