<?php

namespace App\Http\Controllers;

use App\Models\Tanah;
use App\Models\Kantor;
use App\Models\Rumdin;
use App\Models\Garasi;
use App\Models\Mushola;
use App\Models\Barak;
use App\Http\Requests\TanahRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TanahController extends Controller
{
    // Daftar nama Polsek
    private $polsekList = [
        'Polsek Padaherang',
        'Polsek Kalipucang',
        'Polsek Pangandaran',
        'Polsek Sidamulih',
        'Polsek Parigi',
        'Polsek Cijulang',
        'Polsek Cigugur',
        'Polsek Cimerak',
        'Polsek Langkaplancar',
        'Sat Polairud',
    ];

    // ========== POLRES ==========
    
    // List Tanah Polres
    public function polres()
    {
        $data = Tanah::where('kategori', 'polres')
            ->with(['creator', 'updater']) // 🔥 LOAD RELASI USER
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tanah.polres', compact('data'));
    }

    // Create Form untuk Polres
    public function createPolres()
    {
        $kategori = 'polres';
        return view('tanah.create', compact('kategori'));
    }

    // ========== POLSEK ==========
    
    // List Tanah Polsek
    public function polsek()
    {
        $data = Tanah::where('kategori', 'polsek')
            ->with(['creator', 'updater']) // 🔥 LOAD RELASI USER
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tanah.polsek', compact('data'));
    }

    // Create Form untuk Polsek
    public function createPolsek()
    {
        $kategori = 'polsek';
        $polsekList = $this->polsekList;
        return view('tanah.create', compact('kategori', 'polsekList'));
    }

    // ========== CRUD UMUM ==========

    // Store (untuk polres dan polsek)
    public function store(TanahRequest $request)
    {
        $data = $request->validated();
        
        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

    $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());

    // pindahkan langsung ke public/tanah_foto
    $file->move(config('filesystem_path.tanah'), $filename);

    // simpan HANYA nama file
    $data['foto'] = $filename;
        }

        $data['created_by'] = Auth::id(); // 🔥 SET CREATED BY
        
        Tanah::create($data);

        // ✅ Redirect berdasarkan jenis_lokasi DAN kategori
        if (isset($data['jenis_lokasi']) && $data['jenis_lokasi'] === 'kantor') {
            $route = $data['kategori'] === 'polres' ? 'tanah.polres.kantor' : 'tanah.polsek.kantor';
        } else {
            $route = $data['kategori'] === 'polres' ? 'tanah.polres' : 'tanah.polsek';
        }
        
        return redirect()->route($route)->with('success', 'Data tanah berhasil ditambahkan!');
    }

    // Show Detail
    public function show(Tanah $tanah)
    {
        // Load relasi bangunan DAN user
        $tanah->load([
            'kantors',
            'baraks',
            'rumdins',
            'garasis',
            'musholas',
            'creator',  // 🔥 LOAD USER PEMBUAT
            'updater'   // 🔥 LOAD USER PENGUPDATE
        ]);
        
        return view('tanah.show', compact('tanah'));
    }

    // Show Edit Form
    public function edit(Tanah $tanah)
    {
        $polsekList = $this->polsekList;
        $kategori = $tanah->kategori;
        return view('tanah.edit', compact('tanah', 'polsekList', 'kategori'));
    }

    // Update
    public function update(TanahRequest $request, Tanah $tanah)
    {
        $data = $request->validated();

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($tanah->foto) {
                $oldPath = config('filesystem_path.tanah') . '/' . $tanah->foto;

        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
            }
            $file = $request->file('foto');

    $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());

    // pindahkan langsung ke public/tanah_foto
    $file->move(config('filesystem_path.tanah'), $filename);

    // simpan HANYA nama file
    $data['foto'] = $filename;
        }

        $data['updated_by'] = Auth::id(); // 🔥 SET UPDATED BY
        
        $tanah->update($data);

        $route = $tanah->kategori === 'polres' ? 'tanah.polres' : 'tanah.polsek';
        
        return redirect()->route($route)->with('success', 'Data tanah berhasil diperbarui!');
    }

    // Delete
    public function destroy(Tanah $tanah)
    {
        $kategori = $tanah->kategori;
        
        // Hapus foto
        if ($tanah->foto) {
            $path = config('filesystem_path.tanah') . '/' . $tanah->foto;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $tanah->delete();

        $route = $kategori === 'polres' ? 'tanah.polres' : 'tanah.polsek';
        
        return redirect()->route($route)->with('success', 'Data tanah berhasil dihapus!');
    }

    // ========== LAPORAN PDF ==========
    
    public function laporanPdf(Request $request)
    {
        // Build query
        $query = Tanah::query()->with(['creator', 'updater']); // 🔥 LOAD USER

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter berdasarkan polsek (jika ada)
        if ($request->filled('polsek_nama')) {
            $query->where('polsek_nama', $request->polsek_nama);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $data = $query->orderBy('created_at', 'desc')->get();

        // Load PDF
        $pdf = Pdf::loadView('tanah.laporan-pdf', compact('data'));
        
        // Set paper size dan orientation
        $pdf->setPaper('a4', 'landscape');
        
        // Generate filename
        $filename = 'Laporan-Data-Tanah-' . date('Y-m-d-His') . '.pdf';
        
        // Download PDF
        return $pdf->download($filename);
    }

    // ========== GET BANGUNAN BY TANAH ID (AJAX - ALL BUILDINGS) ==========
    
    /**
     * Ambil SEMUA bangunan (Kantor, Rumdin, Garasi, Mushola, Barak) yang ada di tanah tertentu
     * Return JSON untuk AJAX
     */
    public function getBangunan($tanahId)
    {
        try {
            // Ambil data tanah
            $tanah = Tanah::findOrFail($tanahId);
            
            $bangunanList = [];
            $counter = 1;

            // ========== AMBIL DATA KANTOR ==========
            $kantorList = Kantor::where('tanah_id', $tanahId)
                               ->orderBy('created_at', 'desc')
                               ->get();

            foreach ($kantorList as $kantor) {
                $bangunanList[] = [
                    'nup' => $counter++,
                    'jenis' => 'Kantor',
                    'nama' => $kantor->nama,
                    'luas' => number_format($kantor->luas_bangunan, 2, ',', '.') . ' m²',
                    'kategori' => $kantor->kategori === 'kantor_polres' ? 'Polres' : 'Polsek',
                    'detail_url' => route('kantor.show', $kantor->id),
                    'badge_class' => 'badge-kantor'
                ];
            }

            // ========== AMBIL DATA RUMDIN ==========
            $rumdinList = Rumdin::where('tanah_id', $tanahId)
                               ->orderBy('created_at', 'desc')
                               ->get();

            foreach ($rumdinList as $rumdin) {
                $kategoriRumdin = '';
                if ($rumdin->kategori === 'polres_rusus') {
                    $kategoriRumdin = 'Polres Rusus';
                } elseif ($rumdin->kategori === 'polres_satpolairud') {
                    $kategoriRumdin = 'Polres Satpolairud';
                } elseif ($rumdin->kategori === 'polsek_rumdin') {
                    $kategoriRumdin = 'Polsek ' . $rumdin->polsek_nama;
                }

                $bangunanList[] = [
                    'nup' => $counter++,
                    'jenis' => 'Rumdin',
                    'nama' => $rumdin->nama_bangunan,
                    'luas' => number_format($rumdin->luas, 2, ',', '.') . ' m²',
                    'kategori' => $kategoriRumdin,
                    'penghuni' => $rumdin->penghuni ?? '-',
                    'status' => $rumdin->status,
                    'kondisi' => $rumdin->kondisi,
                    'detail_url' => route('rumdin.show', $rumdin->id),
                    'badge_class' => 'badge-rumdin'
                ];
            }

            // ========== AMBIL DATA BARAK ==========
            $barakList = Barak::where('tanah_id', $tanahId)
                             ->orderBy('created_at', 'desc')
                             ->get();

            foreach ($barakList as $barak) {
                $bangunanList[] = [
                    'nup' => $counter++,
                    'jenis' => 'Barak',
                    'nama' => $barak->nama,
                    'luas' => number_format($barak->luas_bangunan, 2, ',', '.') . ' m²',
                    'kategori' => $barak->bangunan_di_atas ?? '-',
                    'detail_url' => route('barak.show', $barak->id),
                    'badge_class' => 'badge-barak'
                ];
            }

            // ========== AMBIL DATA GARASI ==========
            $garasiList = Garasi::where('tanah_id', $tanahId)
                               ->orderBy('created_at', 'desc')
                               ->get();

            foreach ($garasiList as $garasi) {
                $bangunanList[] = [
                    'nup' => $counter++,
                    'jenis' => 'Garasi',
                    'nama' => $garasi->nama,
                    'luas' => number_format($garasi->luas_bangunan, 2, ',', '.') . ' m²',
                    'kategori' => $garasi->bangunan_di_atas ?? '-',
                    'detail_url' => route('garasi.show', $garasi->id),
                    'badge_class' => 'badge-garasi'
                ];
            }

            // ========== AMBIL DATA MUSHOLA ==========
            $musholaList = Mushola::where('tanah_id', $tanahId)
                                 ->orderBy('created_at', 'desc')
                                 ->get();

            foreach ($musholaList as $mushola) {
                $bangunanList[] = [
                    'nup' => $counter++,
                    'jenis' => 'Mushola',
                    'nama' => $mushola->nama,
                    'luas' => number_format($mushola->luas_bangunan, 2, ',', '.') . ' m²',
                    'kategori' => $mushola->bangunan_di_atas ?? '-',
                    'detail_url' => route('mushola.show', $mushola->id),
                    'badge_class' => 'badge-mushola'
                ];
            }

            // Return response JSON
            return response()->json([
                'success' => true,
                'tanah' => [
                    'nama' => $tanah->nama,
                    'kategori' => $tanah->kategori,
                    'polsek_nama' => $tanah->polsek_nama
                ],
                'bangunan' => $bangunanList,
                'total' => count($bangunanList)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data bangunan: ' . $e->getMessage()
            ], 500);
        }
    }
}