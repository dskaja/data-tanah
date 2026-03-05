@extends('layouts.app')

@section('title', 'Detail Rumah Dinas')

@section('content')
<div class="content-body">
    <div class="detail-container">
        <!-- Header dengan Judul dan Button Kembali -->
        <div class="detail-header">
            <div class="header-content">
                <h1 class="detail-title">
                    <i class="fas fa-home"></i> Detail Rumah Dinas
                </h1>
                <p class="detail-subtitle">Informasi lengkap tentang rumah dinas</p>
            </div>
            @php
                $backRoute = match($rumdin->kategori) {
                    'polres_rusus' => 'rumdin.rusus',
                    'polres_satpolairud' => 'rumdin.satpolairud',
                    'polsek_rumdin' => match($rumdin->polsek_nama) {
                        'Pangandaran' => 'rumdin.polsek.pangandaran',
                        'Kalipucang' => 'rumdin.polsek.kalipucang',
                        'Sidamulih' => 'rumdin.polsek.sidamulih',
                        default => 'dashboard'
                    },
                    default => 'dashboard'
                };
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
                    <div class="detail-label">Kategori Lokasi</div>
                    <div class="detail-value">
                        <span class="badge badge-primary">
                            {{ $rumdin->kategori_label }}
                        </span>
                    </div>
                </div>

                @if($rumdin->kategori === 'polsek_rumdin')
                <div class="detail-item">
                    <div class="detail-label">Nama Polsek</div>
                    <div class="detail-value"><strong>{{ $rumdin->polsek_nama }}</strong></div>
                </div>
                @endif

                <div class="detail-item">
                    <div class="detail-label">NUP</div>
                    <div class="detail-value"><strong>#{{ $rumdin->id }}</strong></div>
                </div>
            </div>
        </div>

        <!-- Informasi Bangunan -->
        <div class="detail-section">
            <div class="section-header">
                <i class="fas fa-building"></i> Informasi Bangunan
            </div>
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">Nama Bangunan</div>
                    <div class="detail-value"><strong>{{ $rumdin->nama_bangunan }}</strong></div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Type</div>
                    <div class="detail-value">{{ $rumdin->type }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Penghuni</div>
                    <div class="detail-value">{{ $rumdin->penghuni ?? '-' }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Luas Bangunan</div>
                    <div class="detail-value">
                        <strong style="font-size: 18px; color: #b91c1c;">
                            {{ number_format($rumdin->luas, 2, ',', '.') }} m²
                        </strong>
                    </div>
                </div>

                <div class="detail-item full-width">
                    <div class="detail-label">Alamat Lengkap</div>
                    <div class="detail-value">{{ $rumdin->alamat }}</div>
                </div>
            </div>
        </div>

        <!-- Status & Kondisi -->
        <div class="detail-section">
            <div class="section-header">
                <i class="fas fa-clipboard-list"></i> Status & Kondisi
            </div>
            <div class="status-grid">
                <div class="status-card">
                    <div class="status-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <div class="status-content">
                        <div class="status-label">Status Hunian</div>
                        <div class="status-badge">
                            <span class="badge badge-{{ $rumdin->status == 'Dihuni' ? 'success' : 'warning' }}">
                                {{ $rumdin->status }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="status-card">
                    <div class="status-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div class="status-content">
                        <div class="status-label">Kondisi Bangunan</div>
                        <div class="status-badge">
                            <span class="badge badge-{{ $rumdin->kondisi == 'B' ? 'success' : ($rumdin->kondisi == 'RR' ? 'warning' : 'danger') }}">
                                {{ $rumdin->kondisi_label }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            @if($rumdin->keterangan)
            <div class="detail-grid" style="margin-top: 20px;">
                <div class="detail-item full-width">
                    <div class="detail-label">Keterangan</div>
                    <div class="detail-value" style="background: #fef3c7; padding: 15px; border-radius: 8px; border-left: 4px solid #f59e0b;">
                        {{ $rumdin->keterangan }}
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Informasi Sistem -->
        <div class="detail-section">
            <div class="section-header">
                <i class="fas fa-info-circle"></i> Informasi Sistem
            </div>
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">Dibuat Oleh</div>
                    <div class="detail-value">
                        @if($rumdin->creator)
                            <span class="badge badge-info">
                                <i class="fas fa-user"></i> {{ $rumdin->creator->name ?? $rumdin->creator->username }}
                            </span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Diperbarui Oleh</div>
                    <div class="detail-value">
                        @if($rumdin->updater)
                            <span class="badge badge-info">
                                <i class="fas fa-user-edit"></i> {{ $rumdin->updater->name ?? $rumdin->updater->username }}
                            </span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Tanggal Dibuat</div>
                    <div class="detail-value">{{ $rumdin->created_at->format('d F Y, H:i') }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Terakhir Diupdate</div>
                    <div class="detail-value">{{ $rumdin->updated_at->format('d F Y, H:i') }}</div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-section">
            <a href="{{ route('rumdin.edit', $rumdin) }}" class="btn-action btn-edit">
                <i class="fas fa-edit"></i> Edit Data
            </a>
            <form action="{{ route('rumdin.destroy', $rumdin) }}" method="POST" style="display: inline;" 
                  onsubmit="return confirm('Yakin ingin menghapus data rumah dinas ini?')">
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

/* Status Cards */
.status-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.status-card {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    transition: all 0.3s;
}

.status-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.status-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
}

.status-content {
    flex: 1;
}

.status-label {
    font-size: 12px;
    color: #6c757d;
    font-weight: 600;
    margin-bottom: 8px;
}

.status-badge {
    margin-top: 5px;
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

.badge-success {
    background: #d1fae5;
    color: #065f46;
}

.badge-warning {
    background: #fef3c7;
    color: #92400e;
}

.badge-danger {
    background: #fee2e2;
    color: #991b1b;
}

.badge-info {
    background: #dbeafe;
    color: #1e40af;
}

.text-muted {
    color: #6c757d;
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
    
    .detail-grid,
    .status-grid {
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