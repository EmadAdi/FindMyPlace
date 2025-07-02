
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title', 'لوحة التحكم'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?> 
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen">
    <div class="flex">
        
        <aside class="w-64 bg-white shadow-md h-screen p-4">
            <h2 class="text-lg font-bold text-blue-600 mb-6">لوحة المشرف</h2>
            <nav class="space-y-2">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="block text-gray-700 hover:text-blue-600">🏠 الرئيسية</a>
                <a href="#" class="block text-gray-700 hover:text-blue-600">🏘️ العقارات</a>
                <a href="#" class="block text-gray-700 hover:text-blue-600">👥 المستخدمون</a>
                <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button class="text-red-600 hover:underline">🚪 تسجيل الخروج</button>
                </form>
            </nav>
        </aside>

        
        <main class="flex-1 p-8">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
</body>
</html>
<?php /**PATH C:\wamp64\www\FindMyPlace4\resources\views/layouts/admin.blade.php ENDPATH**/ ?>