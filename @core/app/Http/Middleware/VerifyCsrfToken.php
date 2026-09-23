<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{

    protected $except = [
        '/price-plan-paytm-ipn',
        '/price-plan-payfast-ipn',
        '/price-plan-cashfree-ipn',
        '/price-plan-cinetpay-ipn',
        '/price-plan-paytabs-ipn',
        '/price-plan-iyzipay-ipn',
        '/price-plan-awdpay-ipn',
        '/price-plan-billplz-ipn',

        '/event-paytm-ipn',
        '/pevent-payfast-ipn',
        '/event-cashfree-ipn',
        '/event-cinetpay-ipn',
        '/event-paytabs-ipn',
        '/event-iyzipay-ipn',
        '/event-awdpay-ipn',
        '/event-billplz-ipn',

        '/donation-paytm-ipn',
        '/donation-payfast-ipn',
        '/donation-cashfree-ipn',
        '/donation-cinetpay-ipn',
        '/donation-paytabs-ipn',
        '/donation-iyzipay-ipn',
        '/donation-awdpay-ipn',
        '/donation-billplz-ipn',

        '/product-paytm-ipn',
        '/product-payfast-ipn',
        '/product-cashfree-ipn',
        '/product-cinetpay-ipn',
        '/product-paytabs-ipn',
        '/product-iyzipay-ipn',
        '/product-awdpay-ipn',
        '/product-billplz-ipn',

        '/appointment-paytm-ipn',
        '/appointment-payfast-ipn',
        '/appointment-cashfree-ipn',
        '/appointment-cinetpay-ipn',
        '/appointment-paytabs-ipn',
        '/appointment-iyzipay-ipn',
        '/appointment-awdpay-ipn',
        '/appointment-billplz-ipn',

        '/course-paytm-ipn',
        '/course-payfast-ipn',
        '/course-cashfree-ipn',
        '/course-cinetpay-ipn',
        '/course-paytabs-ipn',
        '/course-iyzipay-ipn',
        '/course-awdpay-ipn',
        '/course-billplz-ipn',

        '/job-paytm-ipn',
        '/job-payfast-ipn',
        '/job-cashfree-ipn',
        '/job-cinetpay-ipn',
        '/job-paytabs-ipn',
        '/job-iyzipay-ipn',
        '/job-awdpay-ipn',
        '/job-billplz-ipn',

    ];
}
