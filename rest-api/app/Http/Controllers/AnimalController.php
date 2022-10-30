<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller {
    public $animals = ["Kucing", "Ayam", "Ikan"];

    public function index() {
    echo "Menampilkan Data animals: <br>";
    foreach($this->animals as $hewan) {
        echo '-' . $hewan . '<br>';
    }
}

    public function store(Request $request) {
        echo "Menambahkan data animals - ";
        echo "Nama hewan: $request->nama<br>";
        array_push($this->animals, $request->nama);
        foreach($this->animals as $hewan) {
            echo '-' . $hewan . '<br>';
        }
    }

    public function update(Request $request, $id) {
        echo "Mengubah data animal id $id - ";
        echo "Nama hewan: $request->nama<br>";
        $this->animals[$id] = $request->nama;
        foreach($this->animals as $hewan) {
            echo '-' . $hewan . '<br>';
        }
    }

    public function destroy($id) {
        echo "Menghapus data animal id $id<br>";
        unset($this->animals[$id]);
        foreach($this->animals as $hewan) {
            echo '-' . $hewan . '<br>';
        }
    }
}