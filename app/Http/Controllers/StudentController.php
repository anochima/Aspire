<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    function __construct()

    {

        $this->middleware('permission:student-list');

        $this->middleware('permission:student-create', ['only' => ['create','store']]);

        $this->middleware('permission:student-edit', ['only' => ['edit','update']]);

        $this->middleware('permission:student-delete', ['only' => ['destroy']]);

    }

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $students = Student::latest()->paginate(5);

        return view('frontend.students.index',compact('students'))

            ->with('i', (request()->input('page', 1) - 1) * 5);

    }


    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('frontend.students.create');

    }


    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        request()->validate([

            'firstname' => 'required',
            'lastname' => 'required',
            'othernames' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'email' => 'required',
            'class' => 'required',
            'section' => 'required',

        ]);


        Student::create($request->all());


        return redirect()->route('students.index')

            ->with('success','Student created successfully.');

    }


    /**

     * Display the specified resource.

     *

     * @param  \App\Student  $student

     * @return \Illuminate\Http\Response

     */

    public function show(Student $student)

    {

        return view('frontend.students.index',compact('student'));

    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Student  $student

     * @return \Illuminate\Http\Response

     */

    public function edit(Student $student)

    {

        return view('frontend.students.edit',compact('student'));

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Student  $student

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Student $student)

    {

        request()->validate([

            'firstname' => 'required',
            'lastname' => 'required',
            'othernames' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'email' => 'required',
            'class' => 'required',
            'section' => 'required',

        ]);


        $student->update($request->all());


        return redirect()->route('frontend.students.index')

            ->with('success','Student updated successfully');

    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Student  $student

     * @return \Illuminate\Http\Response

     */

    public function destroy(Student $student)

    {

        $student->delete();


        return redirect()->route('frontend.students.index')

            ->with('success','Student deleted successfully');

    }

}

