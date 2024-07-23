<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessFeeMail;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\MessFee;

class MessFeesController extends Controller
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
        return view('mess-fees.index', [
            'messFees' => MessFee::orderBy('id', 'DESC')->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mess-fees.create');
    }

    public function searchStudents(Request $request)
    {
        $students = Student::where('name', 'like', '%'.$request->searchQuery.'%')
            ->orWhere('phone_no', 'like', '%'.$request->searchQuery.'%')
            ->orWhere('email', 'like', '%'.$request->searchQuery.'%')
            ->orderBy('name', 'ASC')
            ->paginate(5);
        return view('mess-fees.create', [
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
            'amount' => 'required|numeric|min:1',
        ]);
        $emailCount = 0;
        $students = Student::where('admission_status', 1)->get();
        foreach($students as $student) {
            $guardian = Guardian::where('student_id', $student->id)->first();
            $details = [
                'guardianName' => $guardian->name,
                'studentName' => $student->name,
                'amount' => $request->amount,
                'notes' => $request->notes ?? ''
            ];
            Mail::to($guardian->email)->send(new MessFeeMail($details));
            $emailCount++;
        }
        MessFee::create([
            'email_count' => $emailCount,
            'amount' => $request->amount,
            'notes' => $request->notes ?? ''
        ]);
        return redirect()->route('mess-fees.index')->with('success', 'Mee Fee was added successfully');
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

    /** I had to use 0 and 1 to represent status, and not boolen values.
     * since there many come a new requirement where the fee may be paid partailly  
     */
    public function updateFeeStatus($id)
    {
        $MessFee = MessFee::where('id', $id)->first();
        $MessFee->fee_status = $MessFee->fee_status == 0 ? 1 : 0;
        $MessFee->save();
        return redirect()->route('mess-fees.index')->with('success', 'Mees fee status was updated successfully');
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
