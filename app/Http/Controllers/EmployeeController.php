<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\ValidateEmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Employee;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->input('page');
        if ($page != null) {
            $response = Http::get('http://localhost:8001/api/employees/?page=' . $page);
        } else {
            $response = Http::get('http://localhost:8001/api/employees/');
        }
        $employees = json_decode($response->body());
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::all();
        $sexTypes = [
            [
                'value' => 'male',
                'name' => 'Male',
                'selected' => false,
            ],
            [
                'value' => 'female',
                'name' => 'Female',
                'selected' => false,
            ]
        ];
        return view('employees.create', compact('branches', 'sexTypes'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ValidateEmployeeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateEmployeeRequest $request)
    {
        $response = Http::post('http://localhost:8001/api/employees/', [
            '_token' => csrf_token(),
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'middlename' => $request->middlename,
            'sex' => $request->sex,
            'salary' => $request->salary,
            'branches' => $request->branches,
        ]);
        $result = json_decode($response->body());
        if ($result == 'Success') {
            return redirect()->route('employees.index')
                ->with('success', 'Employee Has Been created successfully');
        } else {
            return back()->withErrors($result);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        $branches = DB::table('branches')
            ->join('branch_employee', 'branch_employee.branch_id', '=', 'branches.id')
            ->where('branch_employee.employee_id', $id)
            ->get();
        return view('employees.show', compact('employee', 'branches'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        $sexTypes = [
            [
                'value' => 'male',
                'name' => 'Male',
                'selected' => false,
            ],
            [
                'value' => 'female',
                'name' => 'Female',
                'selected' => false,
            ]
        ];
        foreach ($sexTypes as $i => $sex) {
            if ($employee->sex == $sex['value']) {
                $sexTypes[$i]['selected'] = true;
            }
        }
        $branches = Branch::all();
        $branchesWithEmployee = DB::table('branches')
            ->join('branch_employee', 'branch_employee.branch_id', '=', 'branches.id')
            ->where('branch_employee.employee_id', $id)
            ->select('branches.id')
            ->get();

        return view('employees.edit', compact('employee', 'sexTypes', 'branches', 'branchesWithEmployee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateEmployeeRequest $request, $id)
    {
        $response = Http::put('http://localhost:8001/api/employees/' . $id, [
            '_token' => csrf_token(),
            'id' => $id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'middlename' => $request->middlename,
            'sex' => $request->sex,
            'salary' => $request->salary,
            'branches' => $request->branches,
        ]);
        $result = json_decode($response->body());
        if ($result == 'Success') {
            return redirect()->route('employees.index')
                ->with('success', 'Employee Has Been updated successfully');
        } else {
            return back()->withErrors($result);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete('http://localhost:8001/api/employees/' . $id);
        $result = json_decode($response->body());
        if ($result == 'Success') {
            return redirect()->route('employees.index')
                ->with('success', 'Employee Has Been deleted successfully');
        } else {
            return redirect()->route('employees.index')->with('fail', 'Deletion error');
        }
    }
}
