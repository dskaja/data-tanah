@extends('layouts.app')

@section('title', 'Tambah Data Tanah ' . ucfirst($kategori))

@section('content')

<div class="content-body">
    <div class="form-container">
        <form action="{{ route('tanah.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Hidden Input Kategori -->
            <input type="hidden" name="kategori" value="{{ $kategori }}">

            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-info-circle"></i> Informasi Dasar
                </div>

                <div class="row">
                    <!-- Nama Polsek (Hanya muncul jika kategori = polsek) -->
                    @if($kategori == 'polsek')
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="polsek_nama">Nama Polsek <span class="required">*</span></label>
                            <select name="polsek_nama" id="polsek_nama" class="form-control @error('polsek_nama') is-invalid @enderror" required>
                                <option value="">-- Pilih Polsek --</option>
                                @foreach($polsekList as $polsek)
                                <option value="{{ $polsek }}" {{ old('polsek_nama') == $polsek ? 'selected' : '' }}>
                                    {{ $polsek }}
                                </option>
                                @endforeach
                            </select>
                            @error('polsek_nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    @endif

                    <!-- Nama -->
                    <div class="col-md-{{ $kategori == 'polsek' ? '6' : '12' }}">
                        <div class="form-group">
                            <label for="nama">Nama Tanah <span class="required">*</span></label>
                            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" 
                                   value="{{ old('nama') }}" placeholder="Contoh: Tanah Kantor Polres" required>
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="alamat">Alamat Lengkap <span class="required">*</span></label>
                            <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" 
                                      placeholder="Masukkan alamat lengkap tanah" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-ruler-combined"></i> Ukuran Luas Tanah
                </div>

                <div class="row">
                    <!-- Luas Seluruhnya -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="luas_seluruhnya">Luas Seluruhnya (m²) <span class="required">*</span></label>
                            <input type="number" step="0.01" name="luas_seluruhnya" id="luas_seluruhnya" 
                                   class="form-control @error('luas_seluruhnya') is-invalid @enderror" 
                                   value="{{ old('luas_seluruhnya') }}" placeholder="0.00" required>
                            @error('luas_seluruhnya')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Luas Tanah untuk Bangunan -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="luas_tanah_bangunan">Luas Tanah Untuk Bangunan (m²) <span class="required">*</span></label>
                            <input type="number" step="0.01" name="luas_tanah_bangunan" id="luas_tanah_bangunan" 
                                   class="form-control @error('luas_tanah_bangunan') is-invalid @enderror" 
                                   value="{{ old('luas_tanah_bangunan') }}" placeholder="0.00" required>
                            @error('luas_tanah_untuk_bangunan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Luas Tanah Sarana Lingkungan -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="luas_tanah_sarana">Luas Tanah Sarana Lingkungan (m²) <span class="required">*</span></label>
                            <input type="number" step="0.01" name="luas_tanah_sarana" id="luas_tanah_sarana" 
                                   class="form-control @error('luas_tanah_sarana') is-invalid @enderror" 
                                   value="{{ old('luas_tanah_sarana') }}" placeholder="0.00" required>
                            @error('luas_tanah_sarana_lingkungan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-file-alt"></i> Informasi Tambahan
                </div>

                <div class="row">
                    <!-- Status -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span class="required">*</span></label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Sertifikat" {{ old('status') == 'Sertifikat' ? 'selected' : '' }}>Sertifikat</option>
                                <option value="Pinjam pakai" {{ old('status') == 'Pinjam pakai' ? 'selected' : '' }}>Pinjam Pakai</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Foto -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="foto">Foto Tanah (Opsional)</label>
                            <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" 
                                   accept="image/jpeg,image/png,image/jpg">
                            <small class="text-muted">Format: JPG, PNG. Max: 2MB</small>
                            @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <!-- Preview Foto -->
                            <div id="preview-container" style="display: none; margin-top: 10px;">
                                <img id="preview-image" src="" alt="Preview" style="max-width: 200px; border-radius: 8px; border: 2px solid #ddd;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Simpan Data
                </button>
                <a href="{{ $kategori == 'polres' ? route('tanah.polres') : route('tanah.polsek') }}" class="btn-cancel">
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

/* Khusus untuk input text, number, dan select */
input[type="text"].form-control,
input[type="number"].form-control,
select.form-control {
    height: 46px;
    line-height: normal;
}

/* Khusus untuk textarea */
textarea.form-control {
    resize: vertical;
    min-height: 90px;
    line-height: 1.5;
}

/* Placeholder styling */
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

/* Fix untuk select dropdown */
select.form-control {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 12px;
    padding-right: 35px;
    cursor: pointer;
}

/* Fix untuk file input */
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

<script>
// Preview foto sebelum upload
document.getElementById('foto').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
            document.getElementById('preview-container').style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endsection