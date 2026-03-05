@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    .hero-section {
        position: relative;
        height: 400px;
        background: linear-gradient(135deg, rgba(139, 0, 0, 0.85) 0%, rgba(184, 134, 11, 0.75) 100%),
                    url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1600&q=80') center/cover;
        border-radius: 20px;
        margin-bottom: 3rem;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        overflow: hidden;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
        padding: 2rem;
    }
    
    .hero-content h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }
    
    .hero-content p {
        font-size: 1.2rem;
        margin: 0.5rem 0;
        opacity: 0.95;
    }

    /* ========== 3 CARDS GRID ========== */
    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }
    
    .stats-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border-left: 5px solid;
        position: relative;
        overflow: hidden;
    }
    
    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 120px;
        height: 120px;
        background: currentColor;
        opacity: 0.05;
        border-radius: 50%;
        transform: translate(40%, -40%);
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    }
    
    .stats-card.tanah {
        border-left-color: #8B4513;
    }
    
    .stats-card.bangunan {
        border-left-color: #B8860B;
    }
    
    .stats-card.terbaru {
        border-left-color: #2E8B57;
    }
    
    .card-header {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .card-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1.8rem;
        color: white;
    }
    
    .stats-card.tanah .card-icon {
        background: linear-gradient(135deg, #8B4513, #A0522D);
    }
    
    .stats-card.bangunan .card-icon {
        background: linear-gradient(135deg, #B8860B, #DAA520);
    }
    
    .stats-card.terbaru .card-icon {
        background: linear-gradient(135deg, #2E8B57, #3CB371);
    }
    
    .card-title {
        font-size: 0.95rem;
        color: #666;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .card-number {
        font-size: 3rem;
        font-weight: 700;
        color: #333;
        margin: 0.5rem 0;
    }
    
    .card-subtitle {
        font-size: 0.9rem;
        color: #999;
    }

    .info-section {
        background: white;
        border-radius: 16px;
        padding: 2.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }
    
    .info-section h2 {
        color: #8B0000;
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 1rem;
        text-align: center;
    }
    
    .info-section p {
        color: #666;
        line-height: 1.8;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin: 2rem 0;
    }
    
    .feature-item {
        text-align: center;
        padding: 1.5rem;
        background: #FFF9F0;
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    
    .feature-item:hover {
        background: #FFF3E0;
        transform: translateY(-3px);
    }
    
    .feature-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 1rem;
        background: linear-gradient(135deg, #8B0000, #B8860B);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.8rem;
    }
    
    .feature-title {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }
    
    .feature-desc {
        font-size: 0.85rem;
        color: #666;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 2rem;
    }
    
    .btn-custom {
        padding: 0.9rem 2rem;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        cursor: pointer;
        font-size: 1rem;
    }
    
    .btn-primary-custom {
        background: linear-gradient(135deg, #8B0000, #A52A2A);
        color: white;
        box-shadow: 0 4px 15px rgba(139, 0, 0, 0.3);
    }
    
    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #A52A2A, #8B0000);
        box-shadow: 0 6px 20px rgba(139, 0, 0, 0.4);
        transform: translateY(-2px);
        color: white;
    }
    
    .btn-secondary-custom {
        background: linear-gradient(135deg, #B8860B, #DAA520);
        color: white;
        box-shadow: 0 4px 15px rgba(184, 134, 11, 0.3);
    }
    
    .btn-secondary-custom:hover {
        background: linear-gradient(135deg, #DAA520, #B8860B);
        box-shadow: 0 6px 20px rgba(184, 134, 11, 0.4);
        transform: translateY(-2px);
        color: white;
    }

    @media (max-width: 768px) {
        .dashboard-cards {
            grid-template-columns: 1fr;
        }
        
        .hero-content h1 {
            font-size: 2rem;
        }
    }
</style>

<div class="hero-section">
    <div class="hero-content">
        <h1>Sistem Informasi Data Tanah & Bangunan</h1>
        <p><strong>POLRES PANGANDARAN</strong></p>
        <p>Sistem Manajemen Aset Digital Terintegrasi</p>
    </div>
</div>

<!-- 🔥 HANYA 3 CARDS -->
<div class="dashboard-cards">
    <!-- Card 1: Total Data Tanah -->
    <div class="stats-card tanah">
        <div class="card-header">
            <div class="card-icon">
                <i class="fas fa-map-marked-alt"></i>
            </div>
            <div>
                <div class="card-title">Total Tanah</div>
            </div>
        </div>
        <div class="card-number">{{ $totalTanah }}</div>
        <div class="card-subtitle">Data tanah keseluruhan</div>
    </div>
    
    <!-- Card 2: Total Bangunan -->
    <div class="stats-card bangunan">
        <div class="card-header">
            <div class="card-icon">
                <i class="fas fa-city"></i>
            </div>
            <div>
                <div class="card-title">Total Bangunan</div>
            </div>
        </div>
        <div class="card-number">{{ $totalBangunan }}</div>
        <div class="card-subtitle">Kantor, Rumdin, Barak, Mushola, Garasi</div>
    </div>
    
    <!-- Card 3: Data Terbaru -->
    <div class="stats-card terbaru">
        <div class="card-header">
            <div class="card-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div>
                <div class="card-title">Data Terbaru</div>
            </div>
        </div>
        <div class="card-number">{{ $updateHariIni }}</div>
        <div class="card-subtitle">Diupdate hari ini</div>
    </div>
</div>

<div class="info-section">
    <h2>Tentang Sistem</h2>
    <p>Sistem Informasi Data Tanah dan Bangunan Polres Pangandaran adalah platform digital yang dirancang untuk mengelola, memantau, dan mengadministrasikan seluruh aset properti milik Polres Pangandaran secara efektif dan efisien.</p>
    
    <div class="features-grid">
        <div class="feature-item">
            <div class="feature-icon">
                <i class="fas fa-database"></i>
            </div>
            <div class="feature-title">Data Terintegrasi</div>
            <div class="feature-desc">Semua data tersimpan dalam satu sistem terpadu</div>
        </div>
        
        <div class="feature-item">
            <div class="feature-icon">
                <i class="fas fa-tasks"></i>
            </div>
            <div class="feature-title">Pengelolaan Cepat</div>
            <div class="feature-desc">Kelola data tanah dan bangunan dengan mudah</div>
        </div>
        
        <div class="feature-item">
            <div class="feature-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="feature-title">Laporan Real-time</div>
            <div class="feature-desc">Akses laporan dan statistik kapan saja</div>
        </div>
        
        <div class="feature-item">
            <div class="feature-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="feature-title">Multi User</div>
            <div class="feature-desc">Mendukung akses berbagai tingkat pengguna</div>
        </div>
    </div>
    
    <div class="action-buttons">
        <a href="{{ route('tanah.polres') }}" class="btn-custom btn-primary-custom">
            <i class="fas fa-map-marked-alt"></i>
            Data Tanah Polres
        </a>
        <a href="{{ route('tanah.polsek') }}" class="btn-custom btn-secondary-custom">
            <i class="fas fa-map-marker-alt"></i>
            Data Tanah Polsek
        </a>
    </div>
</div>

@endsection