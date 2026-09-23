<?php

namespace App\Listeners;

use App\AppointmentBooking;
use App\Course;
use App\CourseEnroll;
use App\EventPaymentLogs;
use App\Events\CourseEnrollSuccess;


class CourseEnrollDatabaseUpdate
{

    public function __construct()
    {
        //
    }

    public function handle(CourseEnrollSuccess $event)
    {
        $data = $event->data;
        if (empty($data) || !isset($data['transaction_id']) || !isset($data['enroll_id'])) {
            return;
        }

        // Find the course enrollment
        $enroll_details = CourseEnroll::findOrFail($data['enroll_id']);
        if (!$enroll_details) {
            return;
        }

        // Update statuses based on payment gateway
        if ($enroll_details->payment_gateway !== 'manual_payment') {
            // For non-manual payments, update to complete
            $enroll_details->update([
                'transaction_id' => $data['transaction_id'],
                'payment_status' => 'complete',
                'status' => 'complete'
            ]);

            // Increase enrolled student count in course table
            $course = Course::findOrFail($enroll_details->course_id);
            $course->enrolled_student = (int) $course->enrolled_student + 1;
            $course->save();
        } else {
            // For manual payments, ensure statuses remain pending
            $enroll_details->update([
                'transaction_id' => $data['transaction_id'],
                'payment_status' => 'pending',
                'status' => 'pending'
            ]);
        }
    }
}
