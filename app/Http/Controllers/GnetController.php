<?php
namespace App\Http\Controllers;
use App\Models\Package;
use Illuminate\Http\Request;

class GnetController extends Controller
{

    public function index()
    {
        $packages = Package::where('type', 'gnet')->get(); // Filter berdasarkan tipe
        return view('ui-gnet', compact('packages'));
    }
}