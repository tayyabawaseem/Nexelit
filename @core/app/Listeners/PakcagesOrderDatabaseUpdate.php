<?php

namespace App\Listeners;

use App\Events\PackagesOrderSuccess;
use App\Order;
use App\PaymentLogs;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PakcagesOrderDatabaseUpdate
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle(PackagesOrderSuccess $event)
    {
        $orders = $event->orders;
        if (!isset($orders['order_id']) || !isset($orders['transaction_id'])) {
            return;
        }

        // Find the order
        $order = Order::find($orders['order_id']);
        if (!$order) {
            return;
        }

        // Extract payment gateway from custom_fields
        $custom_fields = unserialize($order->custom_fields);
        $payment_gateway = !empty($custom_fields['selected_payment_gateway']) ? $custom_fields['selected_payment_gateway'] : '';

        // Update statuses based on payment gateway
        if ($payment_gateway !== 'manual_payment') {
            // For non-manual payments, update to complete
            $order->update(['payment_status' => 'complete']);
            PaymentLogs::where('order_id', $orders['order_id'])->update([
                'transaction_id' => $orders['transaction_id'],
                'status' => 'complete'
            ]);
        } else {
            // For manual payments, ensure statuses remain pending
            $order->update(['payment_status' => 'pending']);
            PaymentLogs::where('order_id', $orders['order_id'])->update([
                'transaction_id' => $orders['transaction_id'],
                'status' => 'pending'
            ]);
        }
    }
}
