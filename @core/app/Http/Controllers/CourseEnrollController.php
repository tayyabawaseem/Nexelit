<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseEnroll;
use App\Facades\EmailTemplate;
use App\Helpers\NexelitHelpers;
use App\Mail\BasicMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CourseEnrollController extends Controller
{
    public function all(){
        $all_enroll = CourseEnroll::all();
        return view('backend.courses.enroll-all')->with(['all_enroll' => $all_enroll]);
    }

    public function delete($id){
        CourseEnroll::findOrFail($id)->delete();
        return back()->with(NexelitHelpers::item_delete());
    }

    public function reminder(Request $request){
        $enroll_details = CourseEnroll::findOrFail($request->id);
        try {
            Mail::to($enroll_details->email)->send(new BasicMail(EmailTemplate::courseReminderMail($enroll_details)));
        }catch (\Exception $e){
            return back()->with(NexelitHelpers::item_delete($e->getMessage()));
        }

        return back()->with(NexelitHelpers::reminder_mail());
    }

    public function bulk_action(Request $request){
        CourseEnroll::whereIn('id',$request->ids)->delete();
        return response()->json(['ok']);
    }
    public function payment_approved($id)
    {
        $enroll_details = CourseEnroll::findOrFail($id);
        $enroll_details->update([
            'payment_status' => 'complete',
            'status' => 'complete'
        ]);

        $course = Course::findOrFail($enroll_details->course_id);
        if ($enroll_details->wasRecentlyUpdated && $enroll_details->getOriginal('status') !== 'complete') {
            $course->enrolled_student = (int) $course->enrolled_student + 1;
            $course->save();
        }

        try {
            Mail::to($enroll_details->email)->send(new BasicMail(EmailTemplate::coursePaymentAcceptMail($enroll_details)));
        } catch (\Exception $e) {
            return back()->with(NexelitHelpers::item_delete($e->getMessage()));
        }

        return back()->with(NexelitHelpers::payment_approved());
    }

    public function view($id){
        $enroll_details = CourseEnroll::findOrFail($id);
        return view('backend.courses.course-enroll-view')->with(['enroll_details' => $enroll_details]);
    }

    public function enroll_status_change(Request $request)
    {
        $this->validate($request, [
            'enroll_id' => 'required|exists:course_enrolls,id',
            'enroll_status' => 'required|in:pending,cancel,complete'
        ]);

        $enroll_details = CourseEnroll::findOrFail($request->enroll_id);
        $original_status = $enroll_details->status;

        $enroll_details->update([
            'status' => $request->enroll_status,
//            'payment_status' => $request->enroll_status // Sync payment_status with status
        ]);

        // Update enrolled_student count in Course table
        $course = Course::findOrFail($enroll_details->course_id);
        if ($request->enroll_status === 'complete' && $original_status !== 'complete') {
            $course->enrolled_student = (int) $course->enrolled_student + 1;
            $course->save();
        } elseif ($original_status === 'complete' && $request->enroll_status !== 'complete') {
            $course->enrolled_student = (int) $course->enrolled_student - 1;
            $course->save();
        }

        // Send email notification
        try {
            Mail::to($enroll_details->email)->send(new BasicMail(EmailTemplate::courseStatusChangeMail($enroll_details)));
        } catch (\Exception $e) {
            \Log::error('Failed to send course status change email', [
                'enroll_id' => $request->enroll_id,
                'error' => $e->getMessage()
            ]);
        }

        return redirect()->back()->with([
            'msg' => __('Enrollment status updated successfully'),
            'type' => 'success'
        ]);
    }
}
