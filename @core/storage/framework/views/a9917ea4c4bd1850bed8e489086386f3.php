<?php if(!empty(get_static_option('product_module_status'))): ?>
    <?php if(!get_static_option('display_price_only_for_logged_user') || auth()->check()): ?>
        <li class="wishlist_global">
            <a href="<?php echo e(route('frontend.products.wishlist')); ?>">
                <i class="fas fa-heart"></i>
                
            </a>
        </li>

        <li class="cart cart_global ml-3">
            <a href="<?php echo e(route('frontend.products.cart')); ?>">
                <i class="flaticon-shopping-cart"></i>
                <span class="pcount"><?php echo e(\App\Facades\Cart::count()); ?></span>
            </a>
        </li>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH E:\xampp-8.2\htdocs\nexelit\@core\resources\views/components/product-cart.blade.php ENDPATH**/ ?>