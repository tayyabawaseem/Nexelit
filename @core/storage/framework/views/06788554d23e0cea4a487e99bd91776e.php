<?php if(!empty(get_static_option('product_module_status'))): ?>
    <?php if(!get_static_option('display_price_only_for_logged_user') || auth()->check()): ?>
        <div class="mobile-cart">
            <a href="<?php echo e(route('frontend.products.cart')); ?>">
                <i class="flaticon-shopping-cart"></i>
                <span class="pcount"><?php echo e(\App\Facades\Cart::count()); ?></span>
            </a>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH E:\xampp-8.2\htdocs\nexelit\@core\resources\views/components/product-cart-mobile.blade.php ENDPATH**/ ?>