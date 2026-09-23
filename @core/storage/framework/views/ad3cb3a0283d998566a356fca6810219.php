<?php $__env->startSection('content'); ?>
    <?php
    $page_partial = 'home-'.get_static_option('home_page_variant');
    if (!empty(get_static_option('home_page_page_builder_status'))){
        $page_partial = 'page-builder';
    }
    ?>
<?php echo $__env->make('frontend.home-pages.'.$page_partial, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\nexelit\@core\resources\views/frontend/frontend-home.blade.php ENDPATH**/ ?>