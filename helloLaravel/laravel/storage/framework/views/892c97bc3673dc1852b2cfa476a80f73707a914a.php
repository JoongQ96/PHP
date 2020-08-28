<!doctype html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <title><?php echo $__env->yieldContent('title','Laravel'); ?></title>
    <link rel="stylesheet" href="<?php echo e(mix('css/tailwind.css')); ?>">
</head>
<body>
    <div class="container mx-auto">
        
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</body>
</html>
<?php /**PATH C:\helloLaravel\laravel\resources\views/layout.blade.php ENDPATH**/ ?>