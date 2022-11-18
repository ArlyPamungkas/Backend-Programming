<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    // Menampilkan semua resource
    public function index()
    {
        // Menggunakan model Patients untuk select data
        $patient = Patients::all();

        if ($patient->isNotEmpty()) {
            // Response jika resource ada (JSON)
            $data = [
                'message' => 'Get all patients',
                'data' => $patient
            ];

            return response()->json($data, 200);
        } else {
            // Response jika resource kosong (JSON)
            $data = [
                'message' => 'Data is empty'
            ];

            return response()->json($data, 200);
        }
    }

    // Menambahkan resource
    public function store(Request $request) 
    {
        // Membuat validasi
        $validatedData = $request->validate([
            'name' => 'string|required',
            'phone' => 'numeric|required',
            'address' => 'required',
            'status' => 'string|required',
            'in_date_at' => 'date',
            'out_date_at' => 'date'
        ]);

        $patient = Patients::create($validatedData);

        // Response jika resource berhasil ditambahkan (JSON)
        $data = [
            'message' => 'Resource is added successfully',
            'data' => $patient
        ];

        return response()->json($data, 201);
    }

    // Mendapatkan single resource
    public function show($id)
    {
        // Cari data patients
        $patient = Patients::find($id);

        if ($patient) {
            // Response jika resource ada (JSON)
            $data = [
                'message' => 'Get detailed resource',
                'data' => $patient
            ];

            return response()->json($data, 200);
        } else {
            // Response jika resource tidak ada (JSON)
            $data = [
                'message' => 'Resource not found',
            ];

            return response()->json($data, 404);
        }
    }

    // Memperbarui single resource
    public function update(Request $request, $id)
    {
        // Cari data patient
        $patient = Patients::find($id);

        if ($patient) {
            $input = [
                'name' => $request->name ?? $patient->name,
                'phone' => $request->phone ?? $patient->phone,
                'address' => $request->address ?? $patient->address,
                'status' => $request->status ?? $patient->status,
                'in_date_at' => $request->in_date_at ?? $patient->in_date_at,
                'out_date_at' => $request->out_date_at ?? $patient->out_date_at
            ];

            // Update resource
            $patient->update($input);

            // Response jika resource berhasil di-update (JSON)
            $data = [
                'message' => 'Resource is update successfully',
                'data' => $patient
            ];

            return response()->json($data, 200);
        } else {
            // Response jika resource tidak ada (JSON)
            $data = [
                'message' => 'Resource not found'
            ];

            return response()->json($data, 404);
        }
    }

    // Menghapus single resource
    public function destroy($id)
    {
        // Cari data patiens
        $patient = Patients::find($id);

        if ($patient) {
            // Menghapus data patient
            $patient->delete();

            // Response jika resource berhasil dihapus (JSON)
            $data = [
                'message' => 'Resource is deleted successfully'
            ];

            return response()->json($data, 200);
        } else {
            // Response jika resource tidak ada (JSON)
            $data = [
                'message' => 'Resource not found'
            ];

            return response()->json($data, 404);
        }
    }

    // Mencari resource by name
    public function search($name)
    {
        // Mencari nama patient 
        $patient = Patients::where('name', $name)->get();

        if ($patient->isNotEmpty()) {
            // Response jika resource berhasil dicari
            $data = [
                'message' => 'Get searced resource',
                'data' => $patient
            ];

            return response()->json($data, 200);
        } else {
            // Response jika resource tidak ditemukan
            $data = [
                'message' => 'Resource not found'
            ];

            return response()->json($data, 404);
        }
    }

    // Mendapatkan resource yang positif
    public function positive()
    {
        // Mendapatkan resource positive
        $patient = Patients::where('status', '=', 'positive')->get();

        // Menghitung total resource positive
        $total = $patient->count();

        // Response jika resource berhasil
        $data = [
            'message' => 'Get positive resource',
            'total' => $total,
            'data' => $patient
        ];

        return response()->json($data, 200);
    }

    // Mendapatkan resource yang sembuh
    public function recovered()
    {
        // Mendapatkan resource recovered
        $patient = Patients::where('status', '=', 'recovered')->get();

        // Menghitung total resource recovered
        $total = $patient->count();

        // Response jika resource berhasil
        $data = [
            'message' => 'Get recovered resource',
            'total' => $total,
            'data' => $patient
        ];

        return response()->json($data, 200);
    }

    // Mendapatkan resource yang meninggal
    public function dead()
    {
        // Mendapatkan resource dead
        $patient = Patients::where('status', '=', 'dead')->get();

        // Menghitung total resource dead
        $total = $patient->count();

        // Response jika resource berhasil
        $data = [
            'message' => 'Get dead resource',
            'total' => $total,
            'data' => $patient
        ];

        return response()->json($data, 200);
    }
}

/* 
    Nama    : Arly Haryanto Pamungkas
    NIM     : 0110221333
    Rombel  : 3TI15
*/