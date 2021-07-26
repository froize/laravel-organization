<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\ValidateEmployeeRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->paginate(2);
        $employees->withPath('/employees');
        return json_encode($employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ValidateEmployeeRequest $request
     * @return array|string
     */
    public function store(ValidateEmployeeRequest $request)
    {
        if(!empty($request->messages())) {
            return $request->messages();
        }
        $employee = new Employee;
        $employee->firstname = $request->firstname;
        $employee->lastname = $request->lastname;
        $employee->middlename = $request->middlename;
        $employee->sex = $request->sex;
        $employee->salary = $request->salary;
        $employee->save();

        $branches = $request->input('branches', []);
        $employee->branches()->sync($branches);
        return json_encode('Success');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ValidateEmployeeRequest $request
     * @param int $id
     * @return array|string
     */
    public function update(ValidateEmployeeRequest $request, $id)
    {
        if(!empty($request->messages())) {
            return $request->messages();
        }
        $employee = Employee::find($id);
        $employee->firstname = $request->firstname;
        $employee->lastname = $request->lastname;
        $employee->middlename = $request->middlename;
        $employee->sex = $request->sex;
        $employee->salary = $request->salary;
        $employee->save();

        DB::table('branch_employee')->where('employee_id', $id)->delete();
        $branches = $request->input('branches', []);
        $employee->branches()->sync($branches);
        return json_encode('Success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Employee::find($id) != null) {
            DB::table('employees')->where('id', $id)->delete();
            return json_encode('Success');
        } else {
            return json_encode('Deletion error');

        }
    }
}
