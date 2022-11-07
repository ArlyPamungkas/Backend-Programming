<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
class StudentController extends Controller
{
    // Method index - get all resources
    public function index() 
    {
        // Menggunakan model student untuk select data
        $student = Student::all();

        $data = [
            'message' => 'get all student',
            'data' => $student,
        ];

        // Menggunakan respon json laravel
        // otomatis set header content type json
        // otomatis mengubah data array ke JSON
        // mengatur status code
        return response()->json($data, 200);
    }

    // Menambahkan resource
    public function store(Request $request) 
    {
        // menangkap data request
        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
        ];

        // Menggunakan student
        $student = Student::create($input);
        $data = [
            'message' => 'Student is created successfully',
            'data' => $student,
        ];

        // mengembalikan data (json) dan kode 201
        return response()->json($data, 201);
    }

    public function update(Request $request, $id) {
        // menangkap data request
        $this->validate = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
        ];

        $student = Student::find($id);
        $data = [
            'message' => 'Student is updated successfully',
            'data' => $student,
            $student->nama = $request->nama,
            $student->nim = $request->nim,
            $student->email = $request->email,
            $student->jurusan = $request->jurusan,
        ];
        
        $student->save();
        return response()->json($data, 200);
    }

    public function delete($id) {
        $student = Student::find($id);
        $data = [
            '$student' => 'Student is deleted successfully',
            'data' => $student,
        ];

        $student->delete();
        return response()->json($data, 200);
    }
}