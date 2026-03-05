@extends('layouts.app')

@section('title', 'Tambah Data Kantor Polsek')

@section('content')
<div class="content-body">
    <div class="form-container">
        
        {{-- Header --}}
        <div class="form-header">
            <h2>
                <i class="fas fa-building"></i> 
                Tambah Data Kantor Polsek
            </h2>
            <p class="subtitle">Lengkapi form di bawah untuk menambah data bangunan kantor</p>
        </div>

        {{-- Form --}}
        <form action="{{ route('kantor.store') }}" method="POST" enctype="multipart/form-data" id="formKantor">
            @csrf
            <input type="hidden" name="kategori" value="kantor_polsek">

            {{-- Alert Error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <div class="alert-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="alert-content">
                        <strong>Whoops!</strong> Ada masalah dengan input Anda:<br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-info-circle"></i> Informasi Lokasi
                </div>

                <div class="alert-info-box">
                    <i class="fas fa-info-circle"></i>
                    <p>Pilih Polsek tujuan penyimpanan data</p>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="polsek_nama">Pilih Polsek <span class="required">*</span></label>
                            <select name="polsek_nama" id="polsek_nama" 
                                    class="form-control @error('polsek_nama') is-invalid @enderror" required>
                                <option value="">-- Pilih Polsek --</option>
                                @foreach($daftarPolsek as $polsek)
                                    <option value="{{ $polsek }}" 
                                        {{ (old('polsek_nama', $selectedPolsek ?? '') == $polsek || old('polsek_nama', strtolower($selectedPolsek ?? '')) == strtolower($polsek)) ? 'selected' : '' }}>
                                        {{ $polsek }}
                                    </option>
                                @endforeach
                            </select>
                            @error('polsek_nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-briefcase"></i> Informasi Kantor
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
                                <i class="fas fa-info-circle"></i> Pilih tanah tempat kantor ini berada (termasuk tanah Polres)
                            </small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama Kantor <span class="required">*</span></label>
                            <input type="text" name="nama" id="nama" 
                                   class="form-control @error('nama') is-invalid @enderror" 
                                   value="{{ old('nama') }}" placeholder="Contoh: Kantor Polsek Utama" required>
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
                                   value="{{ old('luas_bangunan') }}" placeholder="0.00" required>
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
                                   value="{{ old('bangunan_di_atas') }}" placeholder="Contoh: Tanah Negara" required>
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
                                      placeholder="Masukkan alamat lengkap kantor" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="foto">Foto Kantor</label>
                            <input type="file" name="foto" id="foto" 
                                   class="form-control @error('foto') is-invalid @enderror" 
                                   accept="image/jpeg,image/png,image/jpg">
                            @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                <i class="fas fa-info-circle"></i> Format: JPG, PNG. Max: 2MB
                            </small>
                        </div>
                    </div>

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

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Simpan Data
                </button>
                @if($selectedPolsek)
                    <a href="{{ route('kantor.polsek', ['polsek' => strtolower($selectedPolsek)]) }}" class="btn-cancel">
                        <i class="fas fa-times"></i> Batal
                    </a>
                @else
                    <a href="{{ route('kantor.polsek') }}" class="btn-cancel">
                        <i class="fas fa-times"></i> Batal
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<style>
.content-body {
    padding: 20px;
}

.form-container {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    padding: 30px;
    max-width: 1200px;
    margin: 0 auto;
}

.form-header {
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 3px solid #b91c1c;
}

.form-header h2 {
    font-size: 24px;
    font-weight: 700;
    color: #333;
    margin: 0 0 10px 0;
    display: flex;
    align-items: center;
    gap: 12px;
}

.form-header h2 i {
    color: #b91c1c;
}

.form-header .subtitle {
    color: #666;
    font-size: 14px;
    margin: 0;
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
    display: inline-flex;
    align-items: center;
    gap: 10px;
}

.section-title i {
    color: #b91c1c;
}

.alert {
    padding: 16px 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    display: flex;
    align-items: flex-start;
    gap: 15px;
}

.alert-icon {
    font-size: 20px;
    flex-shrink: 0;
}

.alert-content {
    flex: 1;
}

.alert-danger {
    background-color: #fee2e2;
    border: 1px solid #fecaca;
    color: #991b1b;
}

.alert-danger .alert-icon {
    color: #dc2626;
}

.alert ul {
    margin: 10px 0 0 0;
    padding-left: 20px;
}

.alert-info-box {
    background: #fef3c7;
    border-left: 4px solid #f59e0b;
    padding: 16px 20px;
    border-radius: 6px;
    margin-top: 10px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.alert-info-box i {
    color: #f59e0b;
    font-size: 20px;
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
    border-top: 2px solid #f0f0f0;
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
    box-shadow: 0 2px 8px rgba(185, 28, 28, 0.2);
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
    box-shadow: 0 2px 8px rgba(108, 117, 125, 0.2);
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
    .col-md-6,
    .col-md-12 {
        flex: 0 0 100%;
        max-width: 100%;
    }
    
    .form-container {
        padding: 20px;
    }
    
    .form-header h2 {
        font-size: 20px;
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
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formKantor');
    
    form.addEventListener('submit', function(e) {
        console.log('%c=== FORM SUBMIT DEBUG ===', 'color: #10b981; font-weight: bold;');
        console.log('Form Action:', form.action);
        console.log('Form Method:', form.method);
        
        const formData = new FormData(form);
        console.log('Form Data:');
        for (let [key, value] of formData.entries()) {
            console.log(`  ${key}:`, value);
        }
    });
});
</script>
@endsection