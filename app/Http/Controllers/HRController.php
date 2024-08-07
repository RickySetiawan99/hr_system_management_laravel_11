<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Holiday;
use App\Models\Department;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class HRController extends Controller
{
    /** employee list */
    public function employeeList()
    {
        $employeeList = User::all();
        $id = User::first()->user_id;
        $userId = (int)substr($id, 4) + 1;
        $employeeId = 'KH_000'.$userId;
        return view('HR.employee',compact('employeeList','employeeId'));
    }

    /** holiday Page */
    public function holidayPage()
    {
        $holidayList = Holiday::all();
        return view('HR.holidays',compact('holidayList'));
    }

    /** save record holiday */
    public function holidaySaveRecord(Request $request)
    {
        // In your controller or route handler
        $request->validate([
            'holiday_type' => 'required|string',
            'holiday_name' => 'required|string',
            'holiday_date' => 'required|string',
        ]);

        try {
            $holiday = Holiday::UpdateOrCreate(['id'=>$request->idUpdate]);
            $holiday->holiday_type  = $request->holiday_type;
            $holiday->holiday_name  = $request->holiday_name;
            $holiday->holiday_date  = $request->holiday_date;
            $holiday->save();

            toastr()->success('Create or Update Holiday successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            toastr()->error('Add Holiday fail :)','Error');
            return redirect()->back();
        }
    }

    /** delete record */
    public function holidayDeleteRecord(Request $request) 
    {
        try {

            $holidayDelete = Holiday::findOrFail($request->id_delete);
            $holidayDelete->delete();

            toastr()->success('Delete Holiday successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            toastr()->error('Delete Holiday fail :)','Error');
            return redirect()->back();
        }
    }

    /** leave Employee */
    public function leaveEmployee()
    {
        return view('HR.LeavesManage.leave-employee');
    }

    /** create Leave Employee */
    public function createLeaveEmployee()
    {
        return view('HR.LeavesManage.create-leave-employee');
    }

    /** leave HR */
    public function leaveHR() {
        return view('HR.LeavesManage.leave-hr');
    }

    /** attendance */
    public function attendance()
    {
        return view('HR.Attendance.attendance');
    }

    /** create Leave HR */
    public function createLeaveHR()
    {
        return view('HR.LeavesManage.create-leave-hr');
    }

    /** attendance Main */
    public function attendanceMain()
    {
        return view('HR.Attendance.attendance-main');
    }

    /** department */
    public function department()
    {
        $departmentList = Department::all();
        return view('HR.department',compact('departmentList'));
    }

    /** save record department */
    public function saveRecordDepartment(Request $request)
    {
        // In your controller or route handler
        $request->validate([
            'department'   => 'required|string',
            'head_of'      => 'required|string',
            'phone_number' => 'required|integer',
            'email'        => 'required|email',
            'total_employee' => 'required|integer',
        ]);

        try {
            $department = Department::UpdateOrCreate(['id'=>$request->id_update]);
            $department->department      = $request->department;
            $department->head_of         = $request->head_of;
            $department->phone_number    = $request->phone_number;
            $department->email           = $request->email;
            $department->total_employee  = $request->total_employee;
            $department->save();

            toastr()->success('Create or Update Department successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            toastr()->error('Add Department fail :)','Error');
            return redirect()->back();
        }
    }

    /** delete record department */
    public function deleteRecordDepartment(Request $request)
    {
        try {

            $delete = Department::findOrFail($request->id_delete);
            $delete->delete();

            toastr()->success('Delete record successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            toastr()->error('Delete record fail :)','Error');
            return redirect()->back();
        }
    }

}
