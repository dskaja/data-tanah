<?php

namespace App\Http\Controllers;

use App\Models\Garasi;
use App\Models\Tanah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class GarasiController extends Controller
{
    // ========== INDEX ==========
    public function index()
    {
        $data = Garasi::with('tanah')->orderBy('created_at', 'desc')->get();
        return view('garasi.index', compact('data'));
    }

    // ========== CREATE ==========
    public function create()
    {
        // 🔥 AMBIL TANAH POLSEK + POLRES
        $tanahList = Tanah::whereIn('kategori', ['polsek', 'polres'])
            ->orderBy('kategori', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        
        return view('garasi.create', compact('tanahList'));
    }

    // ========== STORE ==========
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanah_id' => 'required|exists:tanah,id',
            'nama' => 'required|string|max:255',
            'luas_bangunan' => 'required|numeric|min:0',
            'bangunan_di_atas' => 'required|string|max:255',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'keterangan' => 'nullable|string'
        ]);

        if ($request->hasFile('foto')) {
           $file = $request->file('foto');

    $filename = time().'_'.$file->getClientOriginalName();

    $file->move(config('filesystem_path.garasi'), $filename);

    $validated['foto'] = $filename;
        }

        $validated['created_by'] = Auth::id();

        Garasi::create($validated);

        return redirect()->route('garasi.index')
            ->with('success', 'Data garasi berhasil ditambahkan!');
    }

    /**
     * 🔥 SHOW METHOD - DENGAN LOAD CREATOR & UPDATER
     */
    public function show(Garasi $garasi)
    {
        $garasi->load(['creator', 'updater', 'tanah']);
        return view('garasi.show', compact('garasi'));
    }

    // ========== EDIT ==========
    public function edit(Garasi $garasi)
    {
        // 🔥 AMBIL TANAH POLSEK + POLRES
        $tanahList = Tanah::whereIn('kategori', ['polsek', 'polres'])
            ->orderBy('kategori', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        
        return view('garasi.edit', compact('garasi', 'tanahList'));
    }

    // ========== UPDATE ==========
    public function update(Request $request, Garasi $garasi)
    {
        $validated = $request->validate([
            'tanah_id' => 'required|exists:tanah,id',
            'nama' => 'required|string|max:255',
            'luas_bangunan' => 'required|numeric|min:0',
            'bangunan_di_atas' => 'required|string|max:255',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'keterangan' => 'nullable|string'
        ]);

        if ($request->hasFile('foto')) {
            if ($garasi->foto) {
                $oldPath = config('filesystem_path.garasi') . '/' . $garasi->foto;

        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
            }
           $file = $request->file('foto');

    $filename = time().'_'.$file->getClientOriginalName();

    $file->move(config('filesystem_path.garasi'), $filename);

    $validated['foto'] = $filename;
        }

        $validated['updated_by'] = Auth::id();

        $garasi->update($validated);

        return redirect()->route('garasi.index')
            ->with('success', 'Data garasi berhasil diperbarui!');
    }

    // ========== DESTROY ==========
    public function destroy(Garasi $garasi)
    {
        if ($garasi->foto) {
           $path = config('filesystem_path.garasi') . '/' . $garasi->foto;

    if(file_exists($path)){
        unlink($path);
    }
        }

        $garasi->delete();

        return redirect()->route('garasi.index')
            ->with('success', 'Data garasi berhasil dihapus!');
    }

    // ========== LAPORAN PDF ==========
    public function laporanPdf()
    {
        $data = Garasi::with('tanah')->orderBy('created_at', 'desc')->get();

        $pdf = Pdf::loadView('garasi.laporan-pdf', compact('data'));
        $pdf->setPaper('a4', 'landscape');
        $filename = 'Laporan-Data-Garasi-' . date('Y-m-d-His') . '.pdf';
        
        return $pdf->download($filename);
    }
}