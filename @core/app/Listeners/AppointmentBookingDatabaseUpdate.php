<?php

namespace App\Listeners;

use App\AppointmentBooking;
use App\EventPaymentLogs;


class AppointmentBookingDatabaseUpdate
{

    public function __construct()
    {
        //
    }

    public function handle(\App\Events\AppointmentBooking $event)
    {
        $data = $event->data;
        if (empty($data) || !isset($data['transaction_id']) || !isset($data['appointment_id'])) {
            return;
        }

        // Find the appointment booking
        $booking = AppointmentBooking::findOrFail($data['appointment_id']);
        if (!$booking) {
            return;
        }

        // Extract payment gateway from custom_fields
        $custom_fields = $booking->custom_fields;
        if (is_string($custom_fields)) {
            $custom_fields = unserialize($custom_fields);
        } elseif (!is_array($custom_fields)) {
            $custom_fields = []; // Default to empty array if invalid
        }

        $payment_gateway = !empty($custom_fields['selected_payment_gateway']) ? $custom_fields['selected_payment_gateway'] : '';

        // Update statuses based on payment gateway
        if ($payment_gateway !== 'manual_payment') {
            // For non-manual payments, update to complete and confirm
            $booking->update([
                'transaction_id' => $data['transaction_id'],
                'payment_status' => 'complete',
                'status' => 'confirm'
            ]);
        } else {
            // For manual payments, ensure statuses remain pending
            $booking->update([
                'transaction_id' => $data['transaction_id'],
                'payment_status' => 'pending',
                'status' => 'pending'
            ]);
        }

    }
}
