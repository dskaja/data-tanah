<?php

namespace App\Http\Controllers;

use App\Models\Mushola;
use App\Models\Tanah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class MusholaController extends Controller
{
    // Index - List all mushola
    public function index()
    {
        $data = Mushola::with('tanah')->orderBy('created_at', 'desc')->get();
        return view('mushola.index', compact('data'));
    }

    // Create Form
    public function create()
    {
        // 🔥 AMBIL TANAH POLSEK + POLRES
        $tanahList = Tanah::whereIn('kategori', ['polsek', 'polres'])
            ->orderBy('kategori', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        
        return view('mushola.create', compact('tanahList'));
    }

    // Store
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

    $file->move(config('filesystem_path.mushola'), $filename);

    $validated['foto'] = $filename;
        }

        $validated['created_by'] = Auth::id();

        Mushola::create($validated);

        return redirect()->route('mushola.index')
            ->with('success', 'Data mushola berhasil ditambahkan!');
    }

    /**
     * 🔥 SHOW METHOD - DENGAN LOAD CREATOR & UPDATER
     */
    public function show(Mushola $mushola)
    {
        $mushola->load(['creator', 'updater', 'tanah']);
        return view('mushola.show', compact('mushola'));
    }

    // Edit Form
    public function edit(Mushola $mushola)
    {
        // 🔥 AMBIL TANAH POLSEK + POLRES
        $tanahList = Tanah::whereIn('kategori', ['polsek', 'polres'])
            ->orderBy('kategori', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        
        return view('mushola.edit', compact('mushola', 'tanahList'));
    }

    // Update
    public function update(Request $request, Mushola $mushola)
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
            if ($mushola->foto) {
                $oldPath = config('filesystem_path.mushola') . '/' . $mushola->foto;

        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
            }
            $file = $request->file('foto');

    $filename = time().'_'.$file->getClientOriginalName();

    $file->move(config('filesystem_path.mushola'), $filename);

    $validated['foto'] = $filename;
        }

        $validated['updated_by'] = Auth::id();

        $mushola->update($validated);

        return redirect()->route('mushola.index')
            ->with('success', 'Data mushola berhasil diperbarui!');
    }

    // Delete
    public function destroy(Mushola $mushola)
    {
        if ($mushola->foto) {
            $path = config('filesystem_path.mushola') . '/' . $mushola->foto;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $mushola->delete();

        return redirect()->route('mushola.index')
            ->with('success', 'Data mushola berhasil dihapus!');
    }

    // ========== LAPORAN PDF ==========
    public function laporanPdf()
    {
        $data = Mushola::with('tanah')->orderBy('created_at', 'desc')->get();

        $pdf = Pdf::loadView('mushola.laporan-pdf', compact('data'));
        $pdf->setPaper('a4', 'landscape');
        $filename = 'Laporan-Data-Mushola-' . date('Y-m-d-His') . '.pdf';
        
        return $pdf->download($filename);
    }
}