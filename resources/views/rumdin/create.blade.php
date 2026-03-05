@extends('layouts.app')

@section('title', $pageTitle)

@section('content')

<div class="content-body">
    <div class="form-container">
        <form action="{{ route('rumdin.store') }}" method="POST">
            @csrf
            <input type="hidden" name="kategori" value="{{ $kategori }}">
            @if(isset($polsekNama))
            <input type="hidden" name="polsek_nama" value="{{ $polsekNama }}">
            @endif

            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-info-circle"></i> Informasi Lokasi
                </div>

                <div class="alert-info-box">
                    <p>Data ini akan disimpan di: 
                        <strong>
                            @if($kategori === 'polres_rusus')
                                Polres - Rusus
                            @elseif($kategori === 'polres_satpolairud')
                                Polres - Satpolairud
                            @else
                                Polsek {{ $polsekNama }}
                            @endif
                        </strong>
                    </p>
                </div>
            </div>

            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-home"></i> Informasi Bangunan
                </div>

                <div class="row">
                    {{-- TANAH ID --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tanah_id">Pilih Lokasi Tanah <span class="required">*</span></label>
                            <select name="tanah_id" id="tanah_id" 
                                    class="form-control @error('tanah_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Tanah --</option>
                                @foreach($tanahList as $tanah)
                                    <option value="{{ $tanah->id }}" {{ old('tanah_id') == $tanah->id ? 'selected' : '' }}>
                                        ID {{ $tanah->id }} - {{ $tanah->nama }} 
                                        @if($tanah->kategori === 'polsek')
                                            ({{ $tanah->polsek_nama }})
                                        @else
                                            (Polres)
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('tanah_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                <i class="fas fa-info-circle"></i> Pilih tanah tempat rumdin ini berada (termasuk tanah Polres)
                            </small>
                        </div>
                    </div>

                    <!-- Nama Bangunan -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_bangunan">Nama Bangunan <span class="required">*</span></label>
                            <input type="text" name="nama_bangunan" id="nama_bangunan" 
                                   class="form-control @error('nama_bangunan') is-invalid @enderror" 
                                   value="{{ old('nama_bangunan') }}" placeholder="Contoh: Rumah Dinas A1" required>
                            @error('nama_bangunan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Type -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type">Type <span class="required">*</span></label>
                            <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror" 
                                   value="{{ old('type') }}" placeholder="Contoh: Type 36, Type 45" required>
                            @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Penghuni -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="penghuni">Penghuni</label>
                            <input type="text" name="penghuni" id="penghuni" 
                                   class="form-control @error('penghuni') is-invalid @enderror" 
                                   value="{{ old('penghuni') }}" placeholder="Nama penghuni (opsional)">
                            @error('penghuni')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="alamat">Alamat Lengkap <span class="required">*</span></label>
                            <textarea name="alamat" id="alamat" rows="3" 
                                      class="form-control @error('alamat') is-invalid @enderror" 
                                      placeholder="Masukkan alamat lengkap" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-clipboard-list"></i> Detail Properti
                </div>

                <div class="row">
                    <!-- Luas -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="luas">Luas (m²) <span class="required">*</span></label>
                            <input type="number" step="0.01" name="luas" id="luas" 
                                   class="form-control @error('luas') is-invalid @enderror" 
                                   value="{{ old('luas') }}" placeholder="0.00" required>
                            @error('luas')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status <span class="required">*</span></label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Kosong" {{ old('status') == 'Kosong' ? 'selected' : '' }}>Kosong</option>
                                <option value="Dihuni" {{ old('status') == 'Dihuni' ? 'selected' : '' }}>Dihuni</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Kondisi -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kondisi">Kondisi <span class="required">*</span></label>
                            <select name="kondisi" id="kondisi" class="form-control @error('kondisi') is-invalid @enderror" required>
                                <option value="">-- Pilih Kondisi --</option>
                                <option value="B" {{ old('kondisi') == 'B' ? 'selected' : '' }}>Baik (B)</option>
                                <option value="RR" {{ old('kondisi') == 'RR' ? 'selected' : '' }}>Rusak Ringan (RR)</option>
                                <option value="RB" {{ old('kondisi') == 'RB' ? 'selected' : '' }}>Rusak Berat (RB)</option>
                            </select>
                            @error('kondisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" rows="3" 
                                      class="form-control @error('keterangan') is-invalid @enderror" 
                                      placeholder="Keterangan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Simpan Data
                </button>
                <a href="{{ route($backRoute) }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<style>
.form-container {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    padding: 30px;
}

.form-section {
    margin-bottom: 30px;
    padding-bottom: 30px;
    border-bottom: 2px solid #f0f0f0;
}

.form-section:last-of-type {
    border-bottom: none;
    margin-bottom: 20px;
}

.section-title {
    font-size: 18px;
    font-weight: 700;
    color: #333;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 3px solid #b91c1c;
    display: inline-block;
}

.section-title i {
    color: #b91c1c;
    margin-right: 10px;
}

.alert-info-box {
    background: #fef3c7;
    border-left: 4px solid #f59e0b;
    padding: 16px 20px;
    border-radius: 6px;
    margin-top: 10px;
}

.alert-info-box p {
    margin: 0;
    color: #78350f;
    font-size: 14px;
}

.row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -10px;
}

.col-md-4 {
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
    padding: 0 10px;
}

.col-md-6 {
    flex: 0 0 50%;
    max-width: 50%;
    padding: 0 10px;
}

.col-md-12 {
    flex: 0 0 100%;
    max-width: 100%;
    padding: 0 10px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
    font-size: 14px;
}

.required {
    color: #dc3545;
}

.form-control {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.3s;
    background-color: #ffffff;
    color: #333333;
    box-sizing: border-box;
    font-family: inherit;
}

input[type="text"].form-control,
input[type="number"].form-control,
select.form-control {
    height: 46px;
    line-height: normal;
}

textarea.form-control {
    resize: vertical;
    min-height: 90px;
    line-height: 1.5;
}

.form-control::placeholder {
    color: #999;
    opacity: 0.7;
}

.form-control:focus {
    outline: none;
    border-color: #f59e0b;
    box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
    background-color: #ffffff;
}

.form-control.is-invalid {
    border-color: #dc3545;
    background-color: #ffffff;
}

.invalid-feedback {
    display: block;
    color: #dc3545;
    font-size: 13px;
    margin-top: 5px;
}

.text-muted {
    color: #6c757d;
    font-size: 12px;
    display: block;
    margin-top: 5px;
}

.form-actions {
    display: flex;
    gap: 10px;
    justify-content: flex-end;
    padding-top: 20px;
}

.btn-submit {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 30px;
    background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-submit:hover {
    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(185, 28, 28, 0.3);
}

.btn-cancel {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 30px;
    background: #6c757d;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
}

.btn-cancel:hover {
    background: #5a6268;
    transform: translateY(-2px);
}

select.form-control {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 12px;
    padding-right: 35px;
    cursor: pointer;
}

input[type="file"].form-control {
    padding: 10px 15px;
    cursor: pointer;
}

@media (max-width: 768px) {
    .col-md-4,
    .col-md-6,
    .col-md-12 {
        flex: 0 0 100%;
        max-width: 100%;
    }
    
    .form-container {
        padding: 20px;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .btn-submit,
    .btn-cancel {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection