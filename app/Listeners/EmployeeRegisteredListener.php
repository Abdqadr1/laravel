<?php

namespace App\Listeners;

use App\Events\EmployeeRegistered;
use App\Http\Controllers\MailController;
use App\Models\Employee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EmployeeRegisteredListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(EmployeeRegistered $event)
    {
        //
        if ($event instanceof EmployeeRegistered && isset($event->employee)) {
            error_log("received employee instance: id = " . $event->employee->id);
        }
        error_log("we're outside");
        MailController::sendRegistrationMail([
            'message' => "You have been registered as an employee at our company",
            'subject' => "Employee Registration",
            'from' => "registration@employee.com",
            'view' => "emails.registration",
            'to' => $event->employee->email,
        ]);
    }

    // if queued job failed 
    public function failed(Employee $employee, $exception)
    {
        dd($exception);
    }
}
