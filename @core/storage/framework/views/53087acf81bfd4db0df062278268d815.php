<?php
    $home_page_variant = $home_page ?? filter_static_option_value('home_page_variant',$global_static_field_data);
?>
        <!DOCTYPE html>
<html lang="<?php echo e($user_select_lang_slug); ?>"  dir="<?php echo e(get_user_lang_direction()); ?>">

<head>
<?php if(!empty(filter_static_option_value('site_google_analytics',$global_static_field_data))): ?>
    <?php echo get_static_option('site_google_analytics'); ?>

<?php endif; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php echo render_favicon_by_id(filter_static_option_value('site_favicon',$global_static_field_data)); ?>

    <?php
        $custom_body_font_get = \App\CustomFontImport::select('status','file','path')->where('status', 1)->latest()->first();
        $custom_heading_font_get = \App\CustomFontImport::select('status','file','path')->where('status', 2)->latest()->first();
    ?>
    <?php if(!empty($custom_body_font_get) || !empty($custom_heading_font_get)): ?>
        <style>
            /*heading font*/
            @font-face {
                font-family: <?php echo e(optional($custom_heading_font_get)->file); ?>;
                src: url('<?php echo e(optional($custom_heading_font_get)->path); ?>') format('woff');
                font-weight: normal;
                font-style: normal;
                font-display: swap;
            }
            /*body font*/
            @font-face {
                font-family: <?php echo e(optional($custom_body_font_get)->file); ?>;
                src: url('<?php echo e(optional($custom_body_font_get)->path); ?>') format('woff');
                font-weight: normal;
                font-style: normal;
                font-display: swap;
            }
            :root {
                --heading-font: '<?php echo e(optional($custom_heading_font_get)->file); ?>', sans-serif !important;
                --body-font: '<?php echo e(optional($custom_body_font_get)->file); ?>', sans-serif !important;
            }
            #all_search_result {
                position: absolute; /* or "fixed" depending on your requirement */
                top: 0;
                left: 0;
                background-color: white; /* Optional: Set a background color to distinguish the data */
                padding: 10px; /* Optional: Add some padding for better visibility */
                z-index: 9999; /* A higher value to bring it above other elements */
            }
        </style>
    <?php else: ?>
        <?php echo load_google_fonts(); ?>

    <?php endif; ?>
    <link rel="canonical" href="<?php echo e(url()->current()); ?>">
    <link rel=preload href="<?php echo e(asset('assets/frontend/css/fontawesome.min.css')); ?>" as="style">
    <link rel=preload href="<?php echo e(asset('assets/frontend/css/flaticon.css')); ?>" as="style">
    <link rel=preload href="<?php echo e(asset('assets/frontend/css/nexicon.css')); ?>" as="style">

    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/flaticon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/nexicon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/fontawesome.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/animate.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/magnific-popup.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/style-two.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/helpers.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/responsive.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/jquery.ihavecookies.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/dynamic-style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/toastr.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/slick.css')); ?>">
    <link href="<?php echo e(asset('assets/frontend/css/jquery.mb.YTPlayer.min.css')); ?>" media="all" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <?php if(!empty(get_static_option('google_adsense_publisher_id'))): ?>
        <script rel="preload" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=<?php echo e(get_static_option('google_adsense_publisher_id')); ?>" crossorigin="anonymous"></script>
    <?php endif; ?>

<?php if(file_exists('assets/frontend/css/home-'.$home_page_variant.'.css') && empty(get_static_option('home_page_page_builder_status'))): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/home-'.$home_page_variant.'.css')); ?>">
    <?php endif; ?>
    <?php echo $__env->make('frontend.partials.css-variable', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('frontend.partials.navbar-css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->yieldContent('style'); ?>
    <?php if(!empty(filter_static_option_value('site_rtl_enabled',$global_static_field_data)) || get_user_lang_direction() == 'rtl'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/rtl.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/new_rtl.css')); ?>">
    <?php endif; ?>
    <?php echo $__env->make('frontend.partials.og-meta', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <script src="<?php echo e(asset('assets/frontend/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/frontend/js/jquery-migrate.min.js')); ?>"></script>

    <script>var siteurl = "<?php echo e(url('/')); ?>"</script>

    <?php echo filter_static_option_value('site_third_party_tracking_code',$global_static_field_data); ?>


</head>

<body class="<?php echo e(request()->path()); ?> home_variant_<?php echo e($home_page_variant); ?> nexelit_version_<?php echo e(getenv('XGENIOUS_NEXELIT_VERSION')); ?> <?php echo e(filter_static_option_value('item_license_status',$global_static_field_data)); ?> apps_key_<?php echo e(filter_static_option_value('site_script_unique_key',$global_static_field_data)); ?> ">

<?php echo filter_static_option_value('site_third_party_tracking_body_code', $global_static_field_data); ?>


<?php echo $__env->make('frontend.partials.preloader', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('frontend.partials.search-popup', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<?php if(!empty(get_static_option('navbar_variant')) && !in_array(get_static_option('navbar_variant'),['03','05'])): ?>
<?php echo $__env->make('frontend.partials.supportbar',['home_page_variant' => $home_page_variant], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?><?php /**PATH E:\xampp-8.2\htdocs\nexelit\@core\resources\views/frontend/partials/header.blade.php ENDPATH**/ ?>