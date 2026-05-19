<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('student-list', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'required|string|max:255|unique:students',
            'section' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
        ]);

        Student::create($request->all());

        return redirect()->route('student-list')->with('success', 'Student added successfully.');
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'required|string|max:255|unique:students,student_id,' . $student->id,
            'section' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
        ]);

        $student->update($request->all());

        return redirect()->route('student-list')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('student-list')->with('success', 'Student deleted successfully.');
    }
}
