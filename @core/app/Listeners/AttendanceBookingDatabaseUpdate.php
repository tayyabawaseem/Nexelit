<?php

namespace App\Listeners;

use App\EventAttendance;
use App\EventPaymentLogs;
use App\Events;
use App\Events\AttendanceBooking;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AttendanceBookingDatabaseUpdate
{

    public function __construct()
    {
        //
    }

    public function handle(AttendanceBooking $event)
    {
        $data = $event->data;
        if (!isset($data['attendance_id']) || !isset($data['transaction_id'])) {
            return;
        }

        // Find the event attendance record
        $order_details = EventAttendance::findOrFail($data['attendance_id']);
        if (!$order_details) {
            return;
        }

        // Extract payment gateway from custom_fields
        $custom_fields = unserialize($order_details->custom_fields);
        $payment_gateway = !empty($custom_fields['selected_payment_gateway']) ? $custom_fields['selected_payment_gateway'] : '';

        if ($payment_gateway !== 'manual_payment') {
            // For non-manual payments, update to complete and adjust available tickets
            $order_details->payment_status = 'complete';
            $order_details->status = 'complete';
            $order_details->save();

            // Update event payment log
            EventPaymentLogs::where('attendance_id', $data['attendance_id'])->update([
                'transaction_id' => $data['transaction_id'],
                'status' => 'complete'
            ]);

            // Update event available tickets
            $event_details = Events::findOrFail($order_details->event_id);
            $event_details->available_tickets = (int) $event_details->available_tickets - $order_details->quantity;
            $event_details->save();
        } else {
            // For manual payments, ensure statuses remain pending
            $order_details->payment_status = 'pending';
            $order_details->status = 'pending';
            $order_details->save();

            // Update event payment log with pending status
            EventPaymentLogs::where('attendance_id', $data['attendance_id'])->update([
                'transaction_id' => $data['transaction_id'],
                'status' => 'pending'
            ]);
            // Do not update available_tickets until manual payment is verified
        }
    }
}
