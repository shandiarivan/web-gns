<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class MartabeController extends Controller
{
    // ... sisa kode Anda di sini ...
    public function index()
    {
        $packages = Package::where('type', 'martabe')->get();
        return view('ui-martabe', compact('packages'));
    }
}