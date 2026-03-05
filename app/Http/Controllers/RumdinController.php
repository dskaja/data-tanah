<?php

namespace App\Http\Controllers;

use App\Models\Rumdin;
use App\Models\Tanah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class RumdinController extends Controller
{
    // ========== POLRES RUSUS ==========
    public function rusus()
    {
        $rumdins = Rumdin::with('tanah')->byKategori('polres_rusus')->latest()->paginate(10);
        $pageTitle = 'Rumdin Rusus';
        $kategori = 'polres_rusus';
        $createRoute = 'rumdin.rusus.create';
        
        return view('rumdin.index', compact('rumdins', 'pageTitle', 'kategori', 'createRoute'));
    }

    public function createRusus()
    {
        $kategori = 'polres_rusus';
        $pageTitle = 'Tambah Data Rumdin Rusus';
        $backRoute = 'rumdin.rusus';
        // 🔥 AMBIL TANAH POLSEK + POLRES
        $tanahList = Tanah::whereIn('kategori', ['polsek', 'polres'])
            ->orderBy('kategori', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        
        return view('rumdin.create', compact('kategori', 'pageTitle', 'backRoute', 'tanahList'));
    }

    // ========== POLRES SATPOLAIRUD ==========
    public function satpolairud()
    {
        $rumdins = Rumdin::with('tanah')->byKategori('polres_satpolairud')->latest()->paginate(10);
        $pageTitle = 'Rumdin Satpolairud';
        $kategori = 'polres_satpolairud';
        $createRoute = 'rumdin.satpolairud.create';
        
        return view('rumdin.index', compact('rumdins', 'pageTitle', 'kategori', 'createRoute'));
    }

    public function createSatpolairud()
    {
        $kategori = 'polres_satpolairud';
        $pageTitle = 'Tambah Data Rumdin Satpolairud';
        $backRoute = 'rumdin.satpolairud';
        // 🔥 AMBIL TANAH POLSEK + POLRES
        $tanahList = Tanah::whereIn('kategori', ['polsek', 'polres'])
            ->orderBy('kategori', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        
        return view('rumdin.create', compact('kategori', 'pageTitle', 'backRoute', 'tanahList'));
    }

    // ========== POLSEK PANGANDARAN ==========
    public function pangandaran()
    {
        $rumdins = Rumdin::with('tanah')->byPolsek('Pangandaran')->latest()->paginate(10);
        $pageTitle = 'Rumdin Polsek Pangandaran';
        $kategori = 'polsek_rumdin';
        $polsekNama = 'Pangandaran';
        $createRoute = 'rumdin.polsek.pangandaran.create';
        
        return view('rumdin.index', compact('rumdins', 'pageTitle', 'kategori', 'polsekNama', 'createRoute'));
    }

    public function createPangandaran()
    {
        $kategori = 'polsek_rumdin';
        $polsekNama = 'Pangandaran';
        $pageTitle = 'Tambah Data Rumdin Polsek Pangandaran';
        $backRoute = 'rumdin.polsek.pangandaran';
        // 🔥 AMBIL TANAH POLSEK + POLRES
        $tanahList = Tanah::whereIn('kategori', ['polsek', 'polres'])
            ->orderBy('kategori', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        
        return view('rumdin.create', compact('kategori', 'polsekNama', 'pageTitle', 'backRoute', 'tanahList'));
    }

    // ========== POLSEK KALIPUCANG ==========
    public function kalipucang()
    {
        $rumdins = Rumdin::with('tanah')->byPolsek('Kalipucang')->latest()->paginate(10);
        $pageTitle = 'Rumdin Polsek Kalipucang';
        $kategori = 'polsek_rumdin';
        $polsekNama = 'Kalipucang';
        $createRoute = 'rumdin.polsek.kalipucang.create';
        
        return view('rumdin.index', compact('rumdins', 'pageTitle', 'kategori', 'polsekNama', 'createRoute'));
    }

    public function createKalipucang()
    {
        $kategori = 'polsek_rumdin';
        $polsekNama = 'Kalipucang';
        $pageTitle = 'Tambah Data Rumdin Polsek Kalipucang';
        $backRoute = 'rumdin.polsek.kalipucang';
        // 🔥 AMBIL TANAH POLSEK + POLRES
        $tanahList = Tanah::whereIn('kategori', ['polsek', 'polres'])
            ->orderBy('kategori', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        
        return view('rumdin.create', compact('kategori', 'polsekNama', 'pageTitle', 'backRoute', 'tanahList'));
    }

    // ========== POLSEK SIDAMULIH ==========
    public function sidamulih()
    {
        $rumdins = Rumdin::with('tanah')->byPolsek('Sidamulih')->latest()->paginate(10);
        $pageTitle = 'Rumdin Polsek Sidamulih';
        $kategori = 'polsek_rumdin';
        $polsekNama = 'Sidamulih';
        $createRoute = 'rumdin.polsek.sidamulih.create';
        
        return view('rumdin.index', compact('rumdins', 'pageTitle', 'kategori', 'polsekNama', 'createRoute'));
    }

    public function createSidamulih()
    {
        $kategori = 'polsek_rumdin';
        $polsekNama = 'Sidamulih';
        $pageTitle = 'Tambah Data Rumdin Polsek Sidamulih';
        $backRoute = 'rumdin.polsek.sidamulih';
        // 🔥 AMBIL TANAH POLSEK + POLRES
        $tanahList = Tanah::whereIn('kategori', ['polsek', 'polres'])
            ->orderBy('kategori', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        
        return view('rumdin.create', compact('kategori', 'polsekNama', 'pageTitle', 'backRoute', 'tanahList'));
    }

    // ========== CRUD OPERATIONS ==========
    
    public function store(Request $request)
    {
        $rules = [
            'kategori' => 'required|in:polres_rusus,polres_satpolairud,polsek_rumdin',
            'tanah_id' => 'required|exists:tanah,id',
            'nama_bangunan' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'penghuni' => 'nullable|string|max:255',
            'luas' => 'required|numeric|min:0',
            'status' => 'required|in:Kosong,Dihuni',
            'kondisi' => 'required|in:B,RR,RB',
            'alamat' => 'required|string',
            'keterangan' => 'nullable|string',
        ];

        if ($request->kategori === 'polsek_rumdin') {
            $rules['polsek_nama'] = 'required|in:Pangandaran,Kalipucang,Sidamulih';
        }

        $validated = $request->validate($rules);

        $validated['created_by'] = Auth::id();
        $validated['updated_by'] = Auth::id();

        Rumdin::create($validated);

        $redirectRoute = $this->getRedirectRoute($validated['kategori'], $validated['polsek_nama'] ?? null);
        
        return redirect()->route($redirectRoute)->with('success', 'Data rumdin berhasil ditambahkan!');
    }

    /**
     * 🔥 SHOW METHOD - DENGAN LOAD CREATOR & UPDATER
     */
    public function show(Rumdin $rumdin)
    {
        $rumdin->load(['creator', 'updater', 'tanah']);
        return view('rumdin.show', compact('rumdin'));
    }

    public function edit(Rumdin $rumdin)
    {
        $pageTitle = 'Edit Data Rumdin';
        
        // 🔥 AMBIL TANAH POLSEK + POLRES (untuk semua kategori rumdin)
        $tanahList = Tanah::whereIn('kategori', ['polsek', 'polres'])
            ->orderBy('kategori', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        
        return view('rumdin.edit', compact('rumdin', 'pageTitle', 'tanahList'));
    }

    public function update(Request $request, Rumdin $rumdin)
    {
        $rules = [
            'tanah_id' => 'required|exists:tanah,id',
            'nama_bangunan' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'penghuni' => 'nullable|string|max:255',
            'luas' => 'required|numeric|min:0',
            'status' => 'required|in:Kosong,Dihuni',
            'kondisi' => 'required|in:B,RR,RB',
            'alamat' => 'required|string',
            'keterangan' => 'nullable|string',
        ];

        if ($rumdin->kategori === 'polsek_rumdin') {
            $rules['polsek_nama'] = 'required|in:Pangandaran,Kalipucang,Sidamulih';
        }

        $validated = $request->validate($rules);

        $validated['updated_by'] = Auth::id();

        $rumdin->update($validated);

        $redirectRoute = $this->getRedirectRoute($rumdin->kategori, $rumdin->polsek_nama);
        
        return redirect()->route($redirectRoute)->with('success', 'Data rumdin berhasil diperbarui!');
    }

    public function destroy(Rumdin $rumdin)
    {
        $kategori = $rumdin->kategori;
        $polsekNama = $rumdin->polsek_nama;
        
        $rumdin->delete();

        $redirectRoute = $this->getRedirectRoute($kategori, $polsekNama);
        
        return redirect()->route($redirectRoute)->with('success', 'Data rumdin berhasil dihapus!');
    }

    private function getRedirectRoute($kategori, $polsekNama = null)
    {
        switch ($kategori) {
            case 'polres_rusus':
                return 'rumdin.rusus';
            case 'polres_satpolairud':
                return 'rumdin.satpolairud';
            case 'polsek_rumdin':
                switch ($polsekNama) {
                    case 'Pangandaran':
                        return 'rumdin.polsek.pangandaran';
                    case 'Kalipucang':
                        return 'rumdin.polsek.kalipucang';
                    case 'Sidamulih':
                        return 'rumdin.polsek.sidamulih';
                }
        }
        
        return 'dashboard';
    }

    // ========== LAPORAN PDF ==========
    public function laporanPdf(Request $request)
    {
        $query = Rumdin::with('tanah');
        
        if ($request->has('kategori') && $request->kategori) {
            if ($request->kategori == 'polres_rusus') {
                $query->byKategori('polres_rusus');
            } elseif ($request->kategori == 'polres_satpolairud') {
                $query->byKategori('polres_satpolairud');
            } elseif ($request->kategori == 'polsek' && $request->has('polsek_nama')) {
                $query->byPolsek($request->polsek_nama);
            }
        }
        
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        if ($request->has('kondisi') && $request->kondisi) {
            $query->where('kondisi', $request->kondisi);
        }
        
        $data = $query->orderBy('created_at', 'desc')->get();
        
        $pdf = Pdf::loadView('rumdin.laporan-pdf', compact('data'));
        $pdf->setPaper('a4', 'landscape');
        $filename = 'Laporan-Rumdin-' . date('Y-m-d-His') . '.pdf';
        
        return $pdf->download($filename);
    }
}