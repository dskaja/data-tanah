<?php

namespace App\Http\Controllers;

use App\Models\Barak;
use App\Models\Tanah;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BarakController extends Controller
{
    // ========== INDEX ==========
    public function index()
    {
        $data = Barak::with('tanah')->orderBy('created_at', 'desc')->get();
        
        return view('barak.index', compact('data'));
    }

    // ========== CREATE ==========
    public function create()
    {
        // 🔥 AMBIL TANAH POLSEK + POLRES
        $tanahList = Tanah::whereIn('kategori', ['polsek', 'polres'])
            ->orderBy('kategori', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        
        return view('barak.create', compact('tanahList'));
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

    $file->move(config('filesystem_path.barak'), $filename);

    $validated['foto'] = $filename;
        }

        $validated['created_by'] = auth()->id();

        Barak::create($validated);

        return redirect()->route('barak.index')->with('success', 'Data barak berhasil ditambahkan!');
    }

    /**
     * 🔥 SHOW METHOD - DENGAN LOAD CREATOR & UPDATER
     */
    public function show(Barak $barak)
    {
        $barak->load(['creator', 'updater', 'tanah']);
        return view('barak.show', compact('barak'));
    }

    // ========== EDIT ==========
    public function edit(Barak $barak)
    {
        // 🔥 AMBIL TANAH POLSEK + POLRES
        $tanahList = Tanah::whereIn('kategori', ['polsek', 'polres'])
            ->orderBy('kategori', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        
        return view('barak.edit', compact('barak', 'tanahList'));
    }

    // ========== UPDATE ==========
    public function update(Request $request, Barak $barak)
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
              if (!empty($barak->foto)) {
        $oldPath = config('filesystem_path.barak') . '/' . $barak->foto;

        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
    }

           $file = $request->file('foto');

    $filename = time().'_'.$file->getClientOriginalName();

    $file->move(config('filesystem_path.barak'), $filename);

    $validated['foto'] = $filename;
        }

        $validated['updated_by'] = auth()->id();

        $barak->update($validated);

        return redirect()->route('barak.index')->with('success', 'Data barak berhasil diperbarui!');
    }

    // ========== DESTROY ==========
    public function destroy(Barak $barak)
    {
        if ($barak->foto) {
             $path = config('filesystem_path.barak') . '/' . $barak->foto;

    if(file_exists($path)){
        unlink($path);
    }
        }

        $barak->delete();

        return redirect()->route('barak.index')->with('success', 'Data barak berhasil dihapus!');
    }

    // ========== LAPORAN PDF ==========
    public function laporanPdf(Request $request)
    {
        $query = Barak::with('tanah');
        
        $data = $query->orderBy('created_at', 'desc')->get();
        
        $pdf = Pdf::loadView('barak.laporan-pdf', compact('data'));
        $pdf->setPaper('a4', 'landscape');
        $filename = 'Laporan-Data-Barak-' . date('Y-m-d-His') . '.pdf';
        
        return $pdf->download($filename);
    }
}