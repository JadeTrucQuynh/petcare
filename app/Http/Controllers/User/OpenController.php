<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OpenController extends Controller
{
    public function index()
    {
        $topServices = \App\Models\DichVu::withCount('chiTietPdts')
                        ->orderByDesc('chi_tiet_pdts_count')
                        ->take(4)
                        ->get();

        return view('user.index', compact('topServices'));
}
    public function contact(){
        return view('user.contact');
    }
}
