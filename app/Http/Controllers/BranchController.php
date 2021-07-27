<?php

namespace App\Http\Controllers;

use App\Http\Requests\Branch\ValidateBranchRequest;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BranchController extends Controller
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
            $response = Http::get('http://localhost:8001/api/branches/?page=' . $page);
        } else {
            $response = Http::get('http://localhost:8001/api/branches/');
        }
        $branches = json_decode($response->body());
        return view('branches.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('branches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ValidateBranchRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateBranchRequest $request)
    {
        $response = Http::post('http://localhost:8001/api/branches/', [
            '_token' => csrf_token(),
            'name' => $request->name,
        ]);
        $result = json_decode($response->body());
        if ($result == 'Success') {
            return redirect()->route('branches.index')
                ->with('success', 'Branch Has Been created successfully');
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
        $branch = Branch::find($id);
        return view('branches.show', compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch = Branch::find($id);
        return view('branches.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ValidateBranchRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateBranchRequest $request, $id)
    {
        $response = Http::put('http://localhost:8001/api/branches/' . $id, [
            '_token' => csrf_token(),
            'id' => $id,
            'name' => $request->name,
        ]);
        $result = json_decode($response->body());
        if ($result == 'Success') {
            return redirect()->route('branches.index')
                ->with('success', 'Branch Has Been updated successfully');
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
        $response = Http::delete('http://localhost:8001/api/branches/' . $id);
        $result = json_decode($response->body());
        if ($result == 'Success') {
            return redirect()->route('branches.index')
                ->with('success', 'Branch Has Been deleted successfully');
        } else {
            return redirect()->route('branches.index')->with('fail', $result);
        }
    }
}
