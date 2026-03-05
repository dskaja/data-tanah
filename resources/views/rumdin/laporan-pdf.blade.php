<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Rumah Dinas</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            padding: 15px;
            font-size: 9px;
            line-height: 1.4;
            background: white;
        }
        
        .kop-surat {
            text-align: center;
            border-bottom: 3px solid #991b1b;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        
        .kop-surat h1 {
            color: #991b1b;
            font-size: 16px;
            margin-bottom: 3px;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;
        }
        
        .kop-surat h2 {
            color: #1f2937;
            font-size: 14px;
            margin-bottom: 6px;
            font-weight: 600;
        }
        
        .kop-surat p {
            color: #6b7280;
            font-size: 9px;
            margin: 2px 0;
        }
        
        .info-section {
            margin-bottom: 15px;
            background: #fef3c7;
            padding: 10px;
            border-left: 4px solid #f59e0b;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
        }
        
        .info-label {
            font-weight: 700;
            color: #92400e;
            font-size: 9px;
        }
        
        .info-value {
            color: #78350f;
            font-size: 9px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
        }
        
        th {
            background: #991b1b;
            color: white;
            padding: 8px 4px;
            text-align: left;
            font-size: 8px;
            font-weight: 700;
            text-transform: uppercase;
            border: 1px solid #991b1b;
        }
        
        td {
            padding: 6px 4px;
            border: 1px solid #e5e7eb;
            font-size: 8px;
            color: #374151;
        }
        
        tr:nth-child(even) {
            background-color: #fefce8;
        }
        
        tr:nth-child(odd) {
            background-color: #ffffff;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        .badge {
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 7px;
            font-weight: 700;
            display: inline-block;
        }
        
        .badge-dihuni {
            background: #3b82f6;
            color: white;
        }
        
        .badge-kosong {
            background: #6b7280;
            color: white;
        }
        
        .badge-b {
            background: #10b981;
            color: white;
        }
        
        .badge-rr {
            background: #f59e0b;
            color: white;
        }
        
        .badge-rb {
            background: #ef4444;
            color: white;
        }
        
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        
        .signature-section {
            display: inline-block;
            text-align: center;
            margin-top: 10px;
        }
        
        .footer-text {
            clear: both;
            margin-top: 80px;
            text-align: center;
            font-size: 8px;
            color: #9ca3af;
            padding-top: 10px;
            border-top: 1px solid #e5e7eb;
        }
        
        .summary-table {
            width: 100%;
            margin-bottom: 15px;
        }
        
        .summary-table td {
            padding: 8px;
            border: 1px solid #e5e7eb;
            font-size: 9px;
        }
        
        .summary-label {
            background: #fef3c7;
            font-weight: 700;
            width: 40%;
            color: #92400e;
        }
        
        .summary-value {
            background: white;
            font-weight: 600;
            color: #374151;
        }
    </style>
</head>
<body>
    <!-- Kop Surat -->
    <div class="kop-surat">
        <h1>KEPOLISIAN NEGARA REPUBLIK INDONESIA<br>
            DAERAH JAWA BARAT<br>
            RESOR PANGANDARAN
        </h1>
        <h2>LAPORAN DATA RUMAH DINAS</h2>
        <p>Jl. Raya Cijulang No.69, Wonoharjo</p>
        <p>Kec. Pangandaran, Kab. Pangandaran, Jawa Barat 46396</p>
    </div>
    
    <!-- Info Section -->
    <div class="info-section">
        <div class="info-row">
            <span class="info-label">Tanggal Cetak:</span>
            <span class="info-value">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Waktu Cetak:</span>
            <span class="info-value">{{ \Carbon\Carbon::now()->format('H:i') }} WIB</span>
        </div>
        @if(request('kategori'))
        <div class="info-row">
            <span class="info-label">Kategori:</span>
            <span class="info-value">
                @if(request('kategori') == 'polres_rusus') POLRES RUSUS
                @elseif(request('kategori') == 'polres_satpolairud') POLRES SATPOLAIRUD
                @elseif(request('kategori') == 'polsek' && request('polsek_nama')) POLSEK {{ strtoupper(request('polsek_nama')) }}
                @else SEMUA KATEGORI
                @endif
            </span>
        </div>
        @endif
        @if(request('status'))
        <div class="info-row">
            <span class="info-label">Status:</span>
            <span class="info-value">{{ request('status') }}</span>
        </div>
        @endif
        @if(request('kondisi'))
        <div class="info-row">
            <span class="info-label">Kondisi:</span>
            <span class="info-value">
                @if(request('kondisi') == 'B') Baik
                @elseif(request('kondisi') == 'RR') Rusak Ringan
                @else Rusak Berat
                @endif
            </span>
        </div>
        @endif
    </div>
    
    <!-- Summary Table -->
    <table class="summary-table">
        <tr>
            <td class="summary-label">Total Rumah Dinas</td>
            <td class="summary-value"><strong>{{ $data->count() }} Unit</strong></td>
            <td class="summary-label">Total Luas</td>
            <td class="summary-value"><strong>{{ number_format($data->sum('luas'), 2, ',', '.') }} m²</strong></td>
        </tr>
        <tr>
            <td class="summary-label">Status Dihuni</td>
            <td class="summary-value"><strong>{{ $data->where('status', 'Dihuni')->count() }} Unit</strong></td>
            <td class="summary-label">Status Kosong</td>
            <td class="summary-value"><strong>{{ $data->where('status', 'Kosong')->count() }} Unit</strong></td>
        </tr>
        <tr>
            <td class="summary-label">Kondisi Baik</td>
            <td class="summary-value"><strong>{{ $data->where('kondisi', 'B')->count() }} Unit</strong></td>
            <td class="summary-label">Rusak Ringan</td>
            <td class="summary-value"><strong>{{ $data->where('kondisi', 'RR')->count() }} Unit</strong></td>
        </tr>
    </table>
    
    <!-- Main Table -->
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 20px;">No</th>
                <th style="width: 80px;">Nama Bangunan</th>
                <th style="width: 30px;">Nomor</th>
                <th style="width: 50px;">Type</th>
                <th style="width: 80px;">Penghuni</th>
                <th class="text-right" style="width: 45px;">Luas (m²)</th>
                <th class="text-center" style="width: 40px;">Status</th>
                <th class="text-center" style="width: 35px;">Kondisi</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
            <tr>
                <td class="text-center"><strong>{{ $index + 1 }}</strong></td>
                <td><strong>{{ $item->nama_bangunan }}</strong></td>
                <td class="text-center">{{ $item->nomor }}</td>
                <td>{{ $item->type }}</td>
                <td>{{ $item->penghuni ?? '-' }}</td>
                <td class="text-right">{{ number_format($item->luas, 2, ',', '.') }}</td>
                <td class="text-center">
                    <span class="badge badge-{{ strtolower($item->status) }}">
                        {{ $item->status }}
                    </span>
                </td>
                <td class="text-center">
                    <span class="badge badge-{{ strtolower($item->kondisi) }}">
                        {{ $item->kondisi }}
                    </span>
                </td>
                <td>{{ $item->alamat }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">Tidak ada data rumah dinas</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <!-- Footer & Signature -->
    <div class="footer">
        <div class="signature-section">
            <p style="margin-bottom: 2px; font-size: 9px;">Pangandaran, {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM YYYY') }}</p>
            <p style="margin-bottom: 50px; font-weight: 700; font-size: 10px;">KABAG LOG</p>
            <p style="margin-bottom: 0px;"><strong>WAHYU HIDAYAT, S.H.</strong></p>
            <div style="margin: 2px auto; border-top: 1px solid #000; width: 250px;"></div>
            <p style="margin-top: 2px; font-size: 8px;"><strong>AJUN KOMISARIS POLISI NRP 77050073</strong></p>
        </div>
    </div> 
    
    <!-- Footer Text -->
    <div class="footer-text">
        Dokumen ini dicetak secara otomatis dari Sistem Pengelolaan Data Rumah Dinas<br>
        © {{ date('Y') }} Kepolisian Republik Indonesia
    </div>
</body>
</html>