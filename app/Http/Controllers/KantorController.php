<?php

namespace App\Http\Controllers;

use App\Models\Kantor;
use App\Models\Tanah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class KantorController extends Controller
{
    // Daftar Polsek
    private $daftarPolsek = [
        'Kalipucang',
        'Pangandaran',
        'Parigi',
        'Cijulang',
        'Cimerak',
        'Cigugur',
        'Langkaplancar',
        'Mangunjaya',
        'Padaherang',
        'Sindangkasih'
    ];

    // ========== KANTOR POLRES ==========
    
    public function kantorPolres()
    {
        $data = Kantor::with('tanah')
                      ->where('kategori', 'kantor_polres')
                      ->orderBy('created_at', 'desc')
                      ->get();

        return view('kantor.polres.index', compact('data'));
    }

    public function createKantorPolres()
    {
        // 🔥 KANTOR POLRES: HANYA TANAH POLRES
        $tanahList = Tanah::where('kategori', 'polres')
                          ->orderBy('id', 'asc')
                          ->get();
        
        return view('kantor.polres.create', compact('tanahList'));
    }

    // ========== KANTOR POLSEK ==========
    
    public function kantorPolsek(Request $request)
    {
        $polsekNama = $request->query('polsek', 'Kalipucang');
        $polsekNama = ucfirst(strtolower($polsekNama));

        $data = Kantor::with('tanah')
                      ->where('kategori', 'kantor_polsek')
                      ->where('polsek_nama', $polsekNama)
                      ->orderBy('created_at', 'desc')
                      ->get();

        $totalSemuaPolsek = Kantor::where('kategori', 'kantor_polsek')->count();

        return view('kantor.polsek.index', compact('data', 'polsekNama', 'totalSemuaPolsek'));
    }

    public function createKantorPolsek(Request $request)
    {
        $selectedPolsek = $request->query('polsek');
        
        if ($selectedPolsek) {
            $selectedPolsek = ucfirst(strtolower($selectedPolsek));
        }

        // 🔥 KANTOR POLSEK: TANAH POLSEK + POLRES
        $tanahList = Tanah::whereIn('kategori', ['polsek', 'polres'])
                          ->orderBy('kategori', 'asc')
                          ->orderBy('id', 'asc')
                          ->get();

        return view('kantor.polsek.create', [
            'daftarPolsek' => $this->daftarPolsek,
            'selectedPolsek' => $selectedPolsek,
            'tanahList' => $tanahList
        ]);
    }

    // ========== CRUD OPERATIONS ==========

    public function store(Request $request)
    {
        Log::info('🎯 MASUK KE KANTORCONTROLLER@STORE');
        Log::info('📦 Data yang diterima:', $request->all());

        try {
            $rules = [
                'kategori' => 'required|in:kantor_polres,kantor_polsek',
                'tanah_id' => 'required|exists:tanah,id',
                'nama' => 'required|string|max:255',
                'luas_bangunan' => 'required|numeric|min:0',
                'bangunan_di_atas' => 'required|string|max:255',
                'alamat' => 'required|string',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'keterangan' => 'nullable|string',
            ];

            if ($request->kategori === 'kantor_polsek') {
                $rules['polsek_nama'] = 'required|string';
            }

            Log::info('✅ Mulai validasi...');
            $validated = $request->validate($rules);
            Log::info('✅ Validasi berhasil');

            $data = $request->except('foto');
            $data['created_by'] = auth()->id();
            $data['updated_by'] = auth()->id();
            
            if ($request->kategori === 'kantor_polres') {
                $data['polsek_nama'] = null;
            }

            if ($request->hasFile('foto')) {
                
    $file = $request->file('foto');

    $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());

    // pindahkan langsung ke public/kantor_foto
    $file->move(config('filesystem_path.kantor'), $filename);

    // simpan HANYA nama file
    $data['foto'] = $filename;
                
                Log::info('📷 Foto berhasil diupload:', ['path' => $filename]);
            }

            $kantor = Kantor::create($data);
            
            Log::info('💾 Data kantor berhasil disimpan:', $kantor->toArray());

            if ($request->kategori === 'kantor_polsek') {
                return redirect()
                    ->route('kantor.polsek', ['polsek' => strtolower($request->polsek_nama)])
                    ->with('success', '✅ Data kantor berhasil ditambahkan!');
            }

            return redirect()
                ->route('kantor.polres')
                ->with('success', '✅ Data kantor berhasil ditambahkan!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('❌ Validation Error:', $e->errors());
            return back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', '❌ Validasi gagal, periksa kembali data Anda!');
            
        } catch (\Exception $e) {
            Log::error('❌ Error menyimpan data kantor: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return back()
                ->withInput()
                ->with('error', '❌ Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * 🔥 SHOW METHOD - DENGAN LOAD CREATOR & UPDATER
     */
    public function show($id)
    {
        $kantor = Kantor::with(['creator', 'updater', 'tanah'])->findOrFail($id);
        
        return view('kantor.show', compact('kantor'));
    }

    public function edit($id)
    {
        $kantor = Kantor::findOrFail($id);
        
        if ($kantor->kategori === 'kantor_polres') {
            // 🔥 KANTOR POLRES: HANYA TANAH POLRES
            $tanahList = Tanah::where('kategori', 'polres')
                              ->orderBy('id', 'asc')
                              ->get();
            
            return view('kantor.polres.edit', [
                'kantor' => $kantor,
                'tanahList' => $tanahList
            ]);
        } else {
            // 🔥 KANTOR POLSEK: TANAH POLSEK + POLRES
            $tanahList = Tanah::whereIn('kategori', ['polsek', 'polres'])
                              ->orderBy('kategori', 'asc')
                              ->orderBy('id', 'asc')
                              ->get();
            
            return view('kantor.polsek.edit', [
                'kantor' => $kantor,
                'daftarPolsek' => $this->daftarPolsek,
                'tanahList' => $tanahList
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $kantor = Kantor::findOrFail($id);
            
            Log::info('📝 Update data kantor ID: ' . $id, $request->all());

            $rules = [
                'kategori' => 'required|in:kantor_polres,kantor_polsek',
                'tanah_id' => 'required|exists:tanah,id',
                'nama' => 'required|string|max:255',
                'luas_bangunan' => 'required|numeric|min:0',
                'bangunan_di_atas' => 'required|string|max:255',
                'alamat' => 'required|string',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'keterangan' => 'nullable|string',
            ];

            if ($request->kategori === 'kantor_polsek') {
                $rules['polsek_nama'] = 'required|string';
            }

            $validated = $request->validate($rules);

            $data = $request->except('foto');
            $data['updated_by'] = auth()->id();
            
            if ($request->kategori === 'kantor_polres') {
                $data['polsek_nama'] = null;
            }

            if ($request->hasFile('foto')) {
              if (!empty($kantor->foto)) {
        $oldPath = config('filesystem_path.kantor') . '/' . $kantor->foto;

        if (file_exists($oldPath)) {
            unlink($oldPath);
            Log::info('🗑️ Foto lama dihapus:', ['path' => $oldPath]);
        }
    }


                $file = $request->file('foto');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(config('filesystem_path.kantor'), $filename);
                $data['foto'] = $filename;
                
                Log::info('📷 Foto baru diupload:', ['path' => $filename]);
            }

            $kantor->update($data);
            
            Log::info('✅ Data kantor berhasil diupdate');

            if ($kantor->kategori === 'kantor_polsek') {
                return redirect()
                    ->route('kantor.polsek', ['polsek' => strtolower($kantor->polsek_nama)])
                    ->with('success', '✅ Data kantor berhasil diupdate!');
            }

            return redirect()
                ->route('kantor.polres')
                ->with('success', '✅ Data kantor berhasil diupdate!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('❌ Validation Error pada update:', $e->errors());
            return back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', '❌ Validasi gagal, periksa kembali data Anda!');
            
        } catch (\Exception $e) {
            Log::error('❌ Error update data kantor: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return back()
                ->withInput()
                ->with('error', '❌ Gagal mengupdate data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $kantor = Kantor::findOrFail($id);
            
            Log::info('🗑️ Menghapus data kantor ID: ' . $id);
            
            if ($kantor->foto) {
                $path = config('filesystem_path.kantor') . '/' . $kantor->foto;

    if(file_exists($path)){
        unlink($path);
    }
            }

            $kantor->delete();
            
            Log::info('✅ Data kantor berhasil dihapus');

            return redirect()
                ->back()
                ->with('success', '✅ Data kantor berhasil dihapus!');

        } catch (\Exception $e) {
            Log::error('❌ Error menghapus data kantor: ' . $e->getMessage());
            
            return back()
                ->with('error', '❌ Gagal menghapus data: ' . $e->getMessage());
        }
    }

    // ========== LAPORAN PDF ==========
    public function laporanPdf(Request $request)
    {
        $query = Kantor::with('tanah');
        
        if ($request->has('kategori') && $request->kategori) {
            $query->where('kategori', $request->kategori);
            
            if ($request->kategori == 'kantor_polsek' && $request->has('polsek_nama')) {
                $query->where('polsek_nama', $request->polsek_nama);
            }
        }
        
        $data = $query->orderBy('created_at', 'desc')->get();
        
        $pdf = Pdf::loadView('kantor.laporan-pdf', compact('data'));
        $pdf->setPaper('a4', 'landscape');
        $filename = 'Laporan-Kantor-' . date('Y-m-d-His') . '.pdf';
        
        return $pdf->download($filename);
    }
}