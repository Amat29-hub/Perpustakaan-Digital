<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class IndexController extends Controller
{
    public function index()
    {
        $buku = Buku::all(); // ambil semua buku

        return view('frontend.index.index', compact('buku'));
    }
}