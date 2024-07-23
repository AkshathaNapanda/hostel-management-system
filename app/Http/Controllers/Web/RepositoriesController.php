<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Repository;

class RepositoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('repositories.index', [
            'repositories' => Repository::orderBy('id', 'DESC')->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('repositories.create');
    }

    public function searchStudents(Request $request)
    {
        $students = Student::where('name', 'like', '%'.$request->searchQuery.'%')
            ->orWhere('phone_no', 'like', '%'.$request->searchQuery.'%')
            ->orWhere('email', 'like', '%'.$request->searchQuery.'%')
            ->orderBy('name', 'ASC')
            ->paginate(5);
        return view('repositories.create', [
            'students' => $students
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'studentId' => 'required',
            'item' => 'required',
        ]);

        Repository::create([
            'student_id' => $request->studentId,
            'item' => $request->item,
            'repository_status' => true,
            'stored_on' => date('Y-m-d H:i:s'),
        ]);
        return redirect()->route('repositories.index')->with('success', 'Repository was added successfully');   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function updateRepositoryStatus($id)
    {
        $Repository = Repository::where('id', $id)->first();
        $Repository->repository_status = $Repository->repository_status == 0 ? 1 : 0;
        $Repository->collected_on = date('Y-m-d H:i:s');
        $Repository->save();
        return redirect()->route('repositories.index')->with('success', 'Repository status was updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
