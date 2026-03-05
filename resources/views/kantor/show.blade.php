@extends('layouts.app')

@section('title', 'Detail Data Kantor')

@section('content')
<div class="content-body">
    <div class="detail-container">
        <!-- Header dengan Judul dan Button Kembali -->
        <div class="detail-header">
            <div class="header-content">
                <h1 class="detail-title">
                    <i class="fas fa-briefcase"></i> Detail Data Kantor
                </h1>
                <p class="detail-subtitle">Informasi lengkap tentang kantor</p>
            </div>
            @php
                $backRoute = $kantor->kategori == 'kantor_polres' ? 'kantor.polres' : 'kantor.polsek';
            @endphp
            <a href="{{ route($backRoute) }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- Informasi Lokasi -->
        <div class="detail-section">
            <div class="section-header">
                <i class="fas fa-map-marker-alt"></i> Informasi Lokasi
            </div>
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">Kategori</div>
                    <div class="detail-value">
                        <span class="badge badge-warning">
                            {{ $kantor->kategori_label }}
                        </span>
                    </div>
                </div>

                @if($kantor->kategori === 'kantor_polsek')
                <div class="detail-item">
                    <div class="detail-label">Nama Polsek</div>
                    <div class="detail-value">
                        <span class="badge badge-primary">{{ $kantor->polsek_nama }}</span>
                    </div>
                </div>
                @endif

                <div class="detail-item">
                    <div class="detail-label">NUP</div>
                    <div class="detail-value"><strong>#{{ $kantor->id }}</strong></div>
                </div>
            </div>
        </div>

        <!-- Informasi Kantor -->
        <div class="detail-section">
            <div class="section-header">
                <i class="fas fa-building"></i> Informasi Kantor
            </div>
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">Nama Kantor</div>
                    <div class="detail-value"><strong>{{ $kantor->nama }}</strong></div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Luas Bangunan</div>
                    <div class="detail-value">
                        <strong style="font-size: 18px; color: #b91c1c;">
                            {{ number_format($kantor->luas_bangunan, 2, ',', '.') }} m²
                        </strong>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Bangunan Di Atas</div>
                    <div class="detail-value">{{ $kantor->bangunan_di_atas }}</div>
                </div>

                <div class="detail-item full-width">
                    <div class="detail-label">Alamat Lengkap</div>
                    <div class="detail-value">{{ $kantor->alamat }}</div>
                </div>

                @if($kantor->keterangan)
                <div class="detail-item full-width">
                    <div class="detail-label">Keterangan</div>
                    <div class="detail-value" style="background: #fef3c7; padding: 15px; border-radius: 8px; border-left: 4px solid #f59e0b;">
                        {{ $kantor->keterangan }}
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Foto -->
        @if($kantor->foto)
        <div class="detail-section">
            <div class="section-header">
                <i class="fas fa-image"></i> Foto Kantor
            </div>
            <div class="photo-container">
                <a href="{{ $kantor->foto_url }}" target="_blank">
                    <img src="{{ $kantor->foto_url }}" alt="Foto Kantor" class="detail-photo">
                </a>
            </div>
        </div>
        @endif

        <!-- Informasi Sistem -->
        <div class="detail-section">
            <div class="section-header">
                <i class="fas fa-info-circle"></i> Informasi Sistem
            </div>
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">Dibuat Oleh</div>
                    <div class="detail-value">
                        @if($kantor->creator)
                            <span class="badge badge-info">
                                <i class="fas fa-user"></i> {{ $kantor->creator->name ?? $kantor->creator->username }}
                            </span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Diperbarui Oleh</div>
                    <div class="detail-value">
                        @if($kantor->updater)
                            <span class="badge badge-info">
                                <i class="fas fa-user-edit"></i> {{ $kantor->updater->name ?? $kantor->updater->username }}
                            </span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Tanggal Dibuat</div>
                    <div class="detail-value">{{ $kantor->created_at->format('d F Y, H:i') }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Terakhir Diupdate</div>
                    <div class="detail-value">{{ $kantor->updated_at->format('d F Y, H:i') }}</div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-section">
            <a href="{{ route('kantor.edit', $kantor->id) }}" class="btn-action btn-edit">
                <i class="fas fa-edit"></i> Edit Data
            </a>
            <form action="{{ route('kantor.destroy', $kantor->id) }}" method="POST" style="display: inline;" 
                  onsubmit="return confirm('Yakin ingin menghapus data kantor ini?')">
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

.photo-container {
    text-align: center;
}

.detail-photo {
    max-width: 100%;
    max-height: 500px;
    border-radius: 12px;
    border: 3px solid #e5e7eb;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.badge {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
}

.badge-warning {
    background: #fef3c7;
    color: #78350f;
}

.badge-primary {
    background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);
    color: white;
}

.badge-info {
    background: #dbeafe;
    color: #1e40af;
}

.text-muted {
    color: #6c757d;
}

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