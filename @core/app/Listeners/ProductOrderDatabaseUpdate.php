<?php

namespace App\Listeners;

use App\Events\ProductOrders;
use App\ProductOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProductOrderDatabaseUpdate
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

    /**
     * Handle the event.
     *
     * @param  ProductOrders  $event
     * @return void
     */
    public function handle(ProductOrders $event)
    {
        $order_details = $event->order_details;
        if (empty($order_details) || !isset($order_details['transaction_id']) || !isset($order_details['order_id'])) {
            return;
        }

        // Find the product order
        $order = ProductOrder::findOrFail($order_details['order_id']);
        if (!$order) {
            return;
        }

        // Update statuses based on payment gateway
        if ($order->payment_gateway !== 'manual_payment') {
            // For non-manual payments, update to complete
            $order->update([
                'transaction_id' => $order_details['transaction_id'],
                'payment_status' => 'complete',
                'status' => 'complete'
            ]);
        } else {
            // For manual payments, ensure statuses remain pending
            $order->update([
                'transaction_id' => $order_details['transaction_id'],
                'payment_status' => 'pending',
                'status' => 'pending'
            ]);
        }

        // Clear cart session
        rest_cart_session();

    }
}
