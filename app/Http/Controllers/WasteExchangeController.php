<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WasteExchangeController extends Controller
{
    public function create()
    {
        // Logic untuk menampilkan form atau memproses tukar sampah
        return view('filament.user-pages.create-waste-exchange');
    }
}