<?php $__env->startSection('title', '글 보기'); ?>

<?php $__env->startSection('content'); ?>
    <div class="px-64">
        <h1 class="font-bold text-3xl">글 보기</h1>
        <label class="block" for="title">제    목</label><small class="float-right">작성일 <?php echo e($painter->created_at); ?></small>
        <br>
        <input class="border board-gray-800 w-full" readonly type="text" name="title" id="title" value="<?php echo e($painter->title); ?>"><br>

        <label class="block" for="body">내    용</label><br>
        <textarea class="border board-gray-800 w-full" readonly name="body" id="body" cols="30" rows="10"><?php echo e($painter->contents); ?></textarea><br>

        <br>
        <button class="bg-blue-600 text-white px-4 py-2 float-left" onclick="location.href='/painters/painter'">M A I N</button>
        <?php if(auth()->user()->name == $painter->user_id): ?>
            <form action="/painters/<?php echo e($painter->id); ?>" method="POST">
                <?php echo method_field('DELETE'); ?>
                <?php echo csrf_field(); ?>
                <button class="bg-blue-600 text-white px-4 py-2 float-right ml-2">글 삭제</button>
            </form>
            <button class="bg-blue-600 text-white px-4 py-2 float-right" onclick="location.href='/painters/<?php echo e($painter->id); ?>/edit'">글 수정</button>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\helloLaravel\laravel\resources\views/painters/show.blade.php ENDPATH**/ ?>