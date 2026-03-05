@extends('layouts.app')

@section('title', 'Edit Data Kantor Polres')

@section('content')
<div class="content-body">
    <div class="form-container">
        <form action="{{ route('kantor.update', $kantor->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-building"></i> Informasi Kantor Polres
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
                                    <option value="{{ $tanah->id }}" {{ old('tanah_id', $kantor->tanah_id) == $tanah->id ? 'selected' : '' }}>
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
                                <i class="fas fa-info-circle"></i> Pilih tanah tempat kantor polres ini berada
                            </small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama Kantor <span class="required">*</span></label>
                            <input type="text" name="nama" id="nama" 
                                   class="form-control @error('nama') is-invalid @enderror" 
                                   value="{{ old('nama', $kantor->nama) }}" required>
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="luas_bangunan">Luas Bangunan (m²) <span class="required">*</span></label>
                            <input type="number" step="0.01" name="luas_bangunan" id="luas_bangunan" 
                                   class="form-control @error('luas_bangunan') is-invalid @enderror" 
                                   value="{{ old('luas_bangunan', $kantor->luas_bangunan) }}" required>
                            @error('luas_bangunan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="bangunan_di_atas">Bangunan Di Atas <span class="required">*</span></label>
                            <input type="text" name="bangunan_di_atas" id="bangunan_di_atas" 
                                   class="form-control @error('bangunan_di_atas') is-invalid @enderror" 
                                   value="{{ old('bangunan_di_atas', $kantor->bangunan_di_atas) }}" required>
                            @error('bangunan_di_atas')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="alamat">Alamat Lengkap <span class="required">*</span></label>
                            <textarea name="alamat" id="alamat" rows="3" 
                                      class="form-control @error('alamat') is-invalid @enderror" 
                                      required>{{ old('alamat', $kantor->alamat) }}</textarea>
                            @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="foto">Foto Kantor</label>
                            @if($kantor->foto)
                                <div class="foto-preview">
                                    <img src="{{ config('filesystem_path.url.kantor').'/'.$kantor->foto }}">
                                    <p class="text-muted">Foto saat ini. Upload baru untuk mengganti.</p>
                                </div>
                            @endif
                            <input type="file" name="foto" id="foto" 
                                   class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                            @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: JPG, PNG. Max: 2MB</small>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" rows="3" 
                                      class="form-control @error('keterangan') is-invalid @enderror" 
                                      placeholder="Keterangan tambahan (opsional)">{{ old('keterangan', $kantor->keterangan) }}</textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Update Data
                </button>
                <a href="{{ route('kantor.polres') }}" class="btn-cancel">
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

.row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -10px;
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
    background: white;
}

.form-control:focus {
    outline: none;
    border-color: #f59e0b;
    box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
}

.form-control.is-invalid {
    border-color: #dc3545;
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

.foto-preview {
    margin-bottom: 12px;
}

.foto-preview img {
    max-width: 200px;
    max-height: 150px;
    border-radius: 8px;
    border: 2px solid #e5e7eb;
    object-fit: cover;
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

@media (max-width: 768px) {
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