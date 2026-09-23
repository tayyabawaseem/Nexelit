<div class="header-style-01  header-variant-<?php echo e(get_static_option('home_page_variant')); ?>">
    <nav class="navbar navbar-area navbar-expand-lg nav-style-01">
        <div class="container nav-container">
            <div class="responsive-mobile-menu">
                <div class="logo-wrapper">

                    <a href="<?php echo e(url('/')); ?>" class="logo">
                        <?php if(!empty(filter_static_option_value('site_white_logo',$global_static_field_data))): ?>
                            <?php echo render_image_markup_by_attachment_id(filter_static_option_value('site_white_logo',$global_static_field_data)); ?>

                        <?php else: ?>
                            <h2 class="site-title"><?php echo e(filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)); ?></h2>
                        <?php endif; ?>
                    </a>

                </div>
                <?php if (isset($component)) { $__componentOriginal92badc805761ef3d902f0e5c224d383d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal92badc805761ef3d902f0e5c224d383d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-cart-mobile','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-cart-mobile'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal92badc805761ef3d902f0e5c224d383d)): ?>
<?php $attributes = $__attributesOriginal92badc805761ef3d902f0e5c224d383d; ?>
<?php unset($__attributesOriginal92badc805761ef3d902f0e5c224d383d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal92badc805761ef3d902f0e5c224d383d)): ?>
<?php $component = $__componentOriginal92badc805761ef3d902f0e5c224d383d; ?>
<?php unset($__componentOriginal92badc805761ef3d902f0e5c224d383d); ?>
<?php endif; ?>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                <ul class="navbar-nav">
                    <?php echo render_frontend_menu($primary_menu); ?>

                </ul>
            </div>
            <div class="nav-right-content">
                <div class="icon-part">
                    <ul>
                        <?php if (isset($component)) { $__componentOriginal4313027f0f6fada1614414b1e14f0bae = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4313027f0f6fada1614414b1e14f0bae = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navbar-search','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('navbar-search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4313027f0f6fada1614414b1e14f0bae)): ?>
<?php $attributes = $__attributesOriginal4313027f0f6fada1614414b1e14f0bae; ?>
<?php unset($__attributesOriginal4313027f0f6fada1614414b1e14f0bae); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4313027f0f6fada1614414b1e14f0bae)): ?>
<?php $component = $__componentOriginal4313027f0f6fada1614414b1e14f0bae; ?>
<?php unset($__componentOriginal4313027f0f6fada1614414b1e14f0bae); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal9be73221563c027921e656d8ffec6a6e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9be73221563c027921e656d8ffec6a6e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-cart','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-cart'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9be73221563c027921e656d8ffec6a6e)): ?>
<?php $attributes = $__attributesOriginal9be73221563c027921e656d8ffec6a6e; ?>
<?php unset($__attributesOriginal9be73221563c027921e656d8ffec6a6e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9be73221563c027921e656d8ffec6a6e)): ?>
<?php $component = $__componentOriginal9be73221563c027921e656d8ffec6a6e; ?>
<?php unset($__componentOriginal9be73221563c027921e656d8ffec6a6e); ?>
<?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
<?php /**PATH E:\xampp-8.2\htdocs\nexelit\@core\resources\views/frontend/partials/navbar.blade.php ENDPATH**/ ?>