<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Method index - get all resources
    public function index() {
        // Menggunakan model student untuk select data
        $student = Student::all();

        if($student) {
            $data = [
                'message' => 'Get all student',
                'data' => $student
            ];

            // Menggunakan respon json laravel
            // otomatis set header content type json
            // otomatis mengubah data array ke JSON
            // mengatur status code
            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Student not found'
            ];

            return response()->json($data, 404);
        }
    }

    // Menambahkan resource
    public function store(Request $request) {
        // Membuat validasi
        $validatedData = $request->validate([
            // kolom => 'rules|rules'
            'nama' => 'required',
            'nim' => 'numeric|required',
            'email' => 'email|required',
            'jurusan' => 'required'
        ]);

        // Menggunakan student
        $student = Student::create($validatedData);
        $data = [
            'message' => 'Student is created',
            'data' => $student
        ];

        // mengembalikan data (json) dan kode 201
        return response()->json($data, 201);
    }

    // Update resource student
    // Method update
    public function update(Request $request, $id) {
        // Cari data student
        $student = Student::find($id);

        if($student) {
            $input = [
                'nama' => $request->nama ?? $student->nama,
                'nim' => $request->nim ?? $student->nim,
                'email' => $request->email ?? $student->email,
                'jurusan' => $request->jurusan ?? $student->jurusan
            ];

            // Update resource
            $student->update($input);

            $data = [
                'message' => 'Resource student updated',
                'data' => $student
            ];

            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Student not found'
            ];

            return response()->json($data, 404);
        }
    }

    public function destroy($id) {
        // Cari data student
        $student = Student::find($id);

        if($student) {
            // Hapus student tersebut
            $student->delete();

            $data = [
                '$student' => 'Student is deleted'
            ];

            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Student not found'
            ];

            return response()->json($data, 404);
        }
    }

    // Mendapatkan detail resource student
    // Method show
    public function show($id) {
        // cari data student
        $student = Student::find($id);

        if($student) {
            $data = [
                'message' => 'get detailed student',
                'data' => $student
            ];
    
            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Student not found'
            ];

            return response()->json($data, 404);
        }
    }
}