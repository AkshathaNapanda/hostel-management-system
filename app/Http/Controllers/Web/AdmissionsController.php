<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Guardian;

class AdmissionsController extends Controller
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
        return view('admissions.index', [
            'students' => Student::orderBy('id', 'DESC')->paginate(5)
        ]);
    }

    public function search(Request $request)
    {
        $students = Student::where('name', 'like', '%'.$request->searchQuery.'%')
            ->orWhere('phone_no', 'like', '%'.$request->searchQuery.'%')
            ->orWhere('email', 'like', '%'.$request->searchQuery.'%')
            ->orderBy('id', 'DESC')
            ->paginate(5);
        return view('admissions.index', [
            'students' => $students
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admissions.create');
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
            'studentName' => 'required|max:255',
            'studentClass' => 'required|max:255',
            'studentCourse' => 'required|max:255',
            'studentPhone' => 'required|regex:/[0-9]{10}/|max:255',
            'studentEmail' => 'required|email|max:255',
            'studentAddress' => 'required',
            'parentName' => 'required|max:255',
            'parentEmail' => 'required|email|max:255',
            'parentAddress' => 'required',
        ]);
        $student = Student::create([
            'name' => $request->studentName,
            'class' => $request->studentClass,
            'course' => $request->studentCourse,
            'phone_no' => $request->studentPhone,
            'email' => $request->studentEmail,
            'address' => $request->studentAddress,
            'admission_status' => 1,
        ]);
        Guardian::create([
            'name' => $request->parentName,
            'email' => $request->parentEmail,
            'address' => $request->parentAddress,
            'student_id' => $student->id,
        ]);
        return redirect()->route('admissions.index')->with('success', 'Admission was successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admissions.show', [
            'student' => Student::where('id', $id)->first(),
            'guardian' => Guardian::where('student_id', $id)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admissions.edit', [
            'student' => Student::where('id', $id)->first(),
            'guardian' => Guardian::where('student_id', $id)->first()
        ]);
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
        $request->validate([
            'studentName' => 'required|max:255',
            'studentClass' => 'required|max:255',
            'studentCourse' => 'required|max:255',
            'studentPhone' => 'required|regex:/[0-9]{10}/|max:255',
            'studentEmail' => 'required|email|max:255',
            'studentAddress' => 'required',
            'parentName' => 'required|max:255',
            'parentEmail' => 'required|email|max:255',
            'parentAddress' => 'required',
        ]);
        Student::where('id', $id)->update([
            'name' => $request->studentName,
            'class' => $request->studentClass,
            'course' => $request->studentCourse,
            'phone_no' => $request->studentPhone,
            'email' => $request->studentEmail,
            'address' => $request->studentAddress,
        ]);
        Guardian::where('student_id', $id)->update([
            'name' => $request->parentName,
            'email' => $request->parentEmail,
            'address' => $request->parentAddress,
        ]);
        return redirect()->route('admissions.index')->with('success', 'Admission details were updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::where('id', $id)->delete();
        Guardian::where('student_id', $id)->delete();
        return redirect()->route('admissions.index')->with('success', 'Admission were deleted successfully');
    }

    public function updateAdmissionStatus($id) {
        $student = Student::findOrFail($id);
        $student->admission_status = $student->admission_status == 1 ? 0 : 1;
        $student->save();
        return redirect()->route('admissions.index')->with('success', 'Admission status were changed successfully');
    }
}
