<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function index()
    {
        $schemes = Scheme::active()
            ->whereNotNull('official_website')
            ->where('official_website', '!=', '')
            ->orderBy('title')
            ->get()
            ->groupBy(fn($s) => $s->category?->name ?? 'Other');
            
        return view('pdfs.index', compact('schemes'));
    }
}
