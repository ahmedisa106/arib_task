<?php

namespace App\Observers;

use App\Models\Employee;
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\Storage;

class EmployeeObserver
{
    use HelperTrait;

    /**
     * Handle the Employee "created" event.
     */
    public function created(Employee $employee): void
    {
        //
    }

    /**
     * Handle the Employee "created" event.
     */
    public function creating(Employee $employee): void
    {
        if (!filter_var($employee->image, FILTER_VALIDATE_URL))
            $employee->image = $this->uploadFile($employee->image, 'employees');
    }


    /**
     * Handle the Employee "updated" event.
     */
    public function updating(Employee $employee): void
    {
        if (is_file($employee->image)) {
            $employee->image = $this->uploadFile($employee->image, 'employees', $employee->getOriginal('image'));
        }

    }

    /**
     * Handle the Employee "deleted" event.
     */
    public function deleted(Employee $employee): void
    {
        Storage::disk('public')->delete($employee->image);
    }

    /**
     * Handle the Employee "restored" event.
     */
    public function restored(Employee $employee): void
    {
        //
    }

    /**
     * Handle the Employee "force deleted" event.
     */
    public function forceDeleted(Employee $employee): void
    {
        //
    }
}
