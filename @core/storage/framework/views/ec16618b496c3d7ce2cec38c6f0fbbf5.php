<?php
    $site_google_captcha_v3_site_key = get_static_option('site_google_captcha_v3_site_key');
    $site_google_captcha_status = get_static_option('site_google_captcha_status');
?>

<?php if(!empty($site_google_captcha_v3_site_key) && !empty($site_google_captcha_status)): ?>
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute("<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>", {action: 'homepage'}).then(function (token) {

                let gcaptcha_token = document.getElementById('gcaptcha_token');

                if(document.getElementById('gcaptcha_token') != null){
                    document.getElementById('gcaptcha_token').value = token;
                }
            });
        });
    </script>
<?php endif; ?><?php /**PATH H:\nexelit\@core\resources\views/frontend/partials/google-captcha.blade.php ENDPATH**/ ?>