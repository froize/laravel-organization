<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Branch\ValidateBranchRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Branch;


class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = DB::table('branches')
            ->leftJoin('branch_employee', 'branches.id', '=', 'branch_employee.branch_id')
            ->leftJoin('employees', 'branch_employee.employee_id', '=', 'employees.id')
            ->select('branches.*',
                DB::raw('COUNT(branch_employee.employee_id) as employees_qty'),
                DB::raw('MAX(employees.salary) as max_salary')
            )
            ->groupBy('branches.id')
            ->orderBy('branches.id', 'desc')
            ->paginate(2);
        $branches->withPath('/branches');
        return json_encode($branches);
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
     * @param ValidateBranchRequest $request
     * @return array|string
     */
    public function store(ValidateBranchRequest $request)
    {
        if (!empty($request->messages())) {
            return $request->messages();
        }
        $branch = new Branch();
        $branch->name = $request->name;
        $branch->save();
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
     * @param ValidateBranchRequest $request
     * @param int $id
     * @return array|string
     */
    public function update(ValidateBranchRequest $request, $id)
    {
        if (!empty($request->messages())) {
            return $request->messages();
        }
        $branch = Branch::find($id);
        $branch->name = $request->name;
        $branch->save();
        return json_encode('Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return false|string
     */
    public function destroy($id)
    {
        if (DB::table('branch_employee')->where('branch_id', $id)->count() == 0) {
            DB::table('branches')->where('id', $id)->delete();
            return json_encode('Success');
        } else {
            return json_encode('Deletion Error');
        }

    }
}
