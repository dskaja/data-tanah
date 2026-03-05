@extends('layouts.app')

@section('title', 'Detail Data Tanah')

@section('content')
<div class="content-body">
    <div class="detail-container">
        <!-- Header dengan Judul dan Button Kembali -->
        <div class="detail-header">
            <div class="header-content">
                <h1 class="detail-title">
                    <i class="fas fa-layer-group"></i> Detail Data Tanah {{ $tanah->kategori == 'polres' ? 'Polres' : 'Polsek' }}
                </h1>
                <p class="detail-subtitle">Informasi lengkap tentang data tanah</p>
            </div>
            <a href="{{ $tanah->kategori == 'polres' ? route('tanah.polres') : route('tanah.polsek') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- Informasi Dasar -->
        <div class="detail-section">
            <div class="section-header">
                <i class="fas fa-info-circle"></i> Informasi Dasar
            </div>
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">Kategori</div>
                    <div class="detail-value">
                        <span class="badge badge-{{ $tanah->kategori == 'polres' ? 'primary' : 'secondary' }}">
                            {{ $tanah->kategori == 'polres' ? 'POLRES' : 'POLSEK' }}
                        </span>
                    </div>
                </div>

                @if($tanah->kategori == 'polsek')
                <div class="detail-item">
                    <div class="detail-label">Nama Polsek</div>
                    <div class="detail-value">{{ $tanah->polsek_nama }}</div>
                </div>
                @endif

                <div class="detail-item">
                    <div class="detail-label">NUP</div>
                    <div class="detail-value"><strong>#{{ $tanah->id }}</strong></div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Nama Tanah</div>
                    <div class="detail-value"><strong>{{ $tanah->nama }}</strong></div>
                </div>

                <div class="detail-item full-width">
                    <div class="detail-label">Alamat Lengkap</div>
                    <div class="detail-value">{{ $tanah->alamat }}</div>
                </div>
            </div>
        </div>

        <!-- Ukuran Luas Tanah -->
        <div class="detail-section">
            <div class="section-header">
                <i class="fas fa-ruler-combined"></i> Ukuran Luas Tanah
            </div>
            <div class="luas-grid">
                <div class="luas-card">
                    <div class="luas-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="fas fa-map"></i>
                    </div>
                    <div class="luas-content">
                        <div class="luas-label">Luas Seluruhnya</div>
                        <div class="luas-value">{{ number_format($tanah->luas_seluruhnya, 2, ',', '.') }} m²</div>
                    </div>
                </div>

                <div class="luas-card">
                    <div class="luas-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="luas-content">
                        <div class="luas-label">Luas Tanah Untuk Bangunan</div>
                        <div class="luas-value">{{ number_format($tanah->luas_tanah_bangunan, 2, ',', '.') }} m²</div>
                    </div>
                </div>

                <div class="luas-card">
                    <div class="luas-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        <i class="fas fa-road"></i>
                    </div>
                    <div class="luas-content">
                        <div class="luas-label">Luas Tanah Sarana Lingkungan</div>
                        <div class="luas-value">{{ number_format($tanah->luas_tanah_sarana, 2, ',', '.') }} m²</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status & Info Tambahan -->
        <div class="detail-section">
            <div class="section-header">
                <i class="fas fa-file-alt"></i> Informasi Tambahan
            </div>
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">Status Kepemilikan</div>
                    <div class="detail-value">
                        <span class="badge badge-{{ $tanah->status == 'Sertifikat' ? 'success' : 'warning' }}">
                            {{ $tanah->status }}
                        </span>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Tanggal Dibuat</div>
                    <div class="detail-value">{{ $tanah->created_at->format('d F Y, H:i') }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Terakhir Diupdate</div>
                    <div class="detail-value">{{ $tanah->updated_at->format('d F Y, H:i') }}</div>
                </div>

                <!-- 🔥 DIBUAT OLEH - INI YANG PENTING -->
                <div class="detail-item">
                    <div class="detail-label">Dibuat Oleh</div>
                    <div class="detail-value">
                        @if($tanah->creator)
                            <span class="badge badge-info">
                                <i class="fas fa-user"></i> {{ $tanah->creator->name ?? $tanah->creator->username }}
                            </span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </div>
                </div>

                <!-- 🔥 DIUPDATE OLEH (jika ada) -->
                @if($tanah->updated_by)
                <div class="detail-item">
                    <div class="detail-label">Diupdate Oleh</div>
                    <div class="detail-value">
                        @if($tanah->updater)
                            <span class="badge badge-info">
                                <i class="fas fa-user-edit"></i> {{ $tanah->updater->name ?? $tanah->updater->username }}
                            </span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Keterangan (jika ada) -->
        @if($tanah->keterangan)
        <div class="detail-section">
            <div class="section-header">
                <i class="fas fa-sticky-note"></i> Keterangan
            </div>
            <div class="keterangan-box">
                {{ $tanah->keterangan }}
            </div>
        </div>
        @endif

        <!-- Foto Tanah -->
        @if($tanah->foto)
        <div class="detail-section">
            <div class="section-header">
                <i class="fas fa-camera"></i> Foto Tanah
            </div>
            <div class="foto-container">
                <img src="{{ asset(config('filesystem_path.url.tanah') . '/' . $tanah->foto) }}" class="foto-tanah">
            </div>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="action-section">
            <a href="{{ route('tanah.edit', $tanah->id) }}" class="btn-action btn-edit">
                <i class="fas fa-edit"></i> Edit Data
            </a>
            <form action="{{ route('tanah.destroy', $tanah->id) }}" method="POST" style="display: inline;" 
                  onsubmit="return confirm('Yakin ingin menghapus data tanah ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-action btn-delete">
                    <i class="fas fa-trash"></i> Hapus Data
                </button>
            </form>
        </div>
    </div>
</div>

<style>
.detail-container {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    overflow: hidden;
}

/* Header dengan Button Kembali */
.detail-header {
    padding: 30px;
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    border-bottom: 2px solid #f0f0f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-content {
    flex: 1;
}

.detail-title {
    font-size: 24px;
    font-weight: 700;
    color: #78350f;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
}

.detail-title i {
    color: #92400e;
}

.detail-subtitle {
    color: #92400e;
    font-size: 14px;
    margin: 8px 0 0 0;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 22px;
    background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
}

.btn-back:hover {
    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(185, 28, 28, 0.3);
    color: white;
}

.detail-section {
    padding: 30px;
    border-bottom: 2px solid #f0f0f0;
}

.detail-section:last-of-type {
    border-bottom: none;
}

.section-header {
    font-size: 18px;
    font-weight: 700;
    color: #333;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 3px solid #b91c1c;
    display: flex;
    align-items: center;
    gap: 12px;
}

.section-header i {
    color: #b91c1c;
}

.detail-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.detail-item.full-width {
    grid-column: 1 / -1;
}

.detail-label {
    font-size: 13px;
    font-weight: 600;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.detail-value {
    font-size: 15px;
    color: #333;
    font-weight: 500;
}

/* Luas Cards */
.luas-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.luas-card {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    transition: all 0.3s;
}

.luas-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.luas-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    flex-shrink: 0;
}

.luas-content {
    flex: 1;
}

.luas-label {
    font-size: 12px;
    color: #6c757d;
    font-weight: 600;
    margin-bottom: 5px;
}

.luas-value {
    font-size: 20px;
    font-weight: 700;
    color: #333;
}

/* Badges */
.badge {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
}

.badge-primary {
    background: #b91c1c;
    color: white;
}

.badge-secondary {
    background: #1f2937;
    color: white;
}

.badge-success {
    background: #d1fae5;
    color: #065f46;
}

.badge-warning {
    background: #fef3c7;
    color: #92400e;
}

.badge-info {
    background: #dbeafe;
    color: #1e40af;
}

.text-muted {
    color: #6c757d;
}

/* Keterangan Box */
.keterangan-box {
    background: #f8f9fa;
    border-left: 4px solid #b91c1c;
    padding: 20px;
    border-radius: 8px;
    color: #333;
    line-height: 1.6;
}

/* Foto Container */
.foto-container {
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f8f9fa;
    border-radius: 12px;
    padding: 20px;
}

.foto-tanah {
    max-width: 100%;
    max-height: 500px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* Action Section */
.action-section {
    padding: 25px 30px;
    background: #f8f9fa;
    display: flex;
    gap: 12px;
    justify-content: flex-end;
}

.btn-action {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
}

.btn-edit {
    background: #f59e0b;
    color: white;
}

.btn-edit:hover {
    background: #d97706;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    color: white;
}

.btn-delete {
    background: #ef4444;
    color: white;
}

.btn-delete:hover {
    background: #dc2626;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

/* Responsive */
@media (max-width: 992px) {
    .luas-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .detail-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .btn-back {
        width: 100%;
        justify-content: center;
    }
    
    .detail-grid {
        grid-template-columns: 1fr;
    }
    
    .detail-section {
        padding: 20px;
    }
    
    .action-section {
        flex-direction: column;
    }
    
    .btn-action {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection