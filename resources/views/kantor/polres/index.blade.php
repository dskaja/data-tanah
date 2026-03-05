@extends('layouts.app')

@section('title', 'Data Kantor Polres')

@section('content')
<div class="content-body">
    <div class="table-container">
        <!-- HEADER TABEL -->
        <div class="table-header">
            <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <div>
                    <div class="table-title">
                        <i class="fas fa-briefcase"></i> Data Kantor Polres
                    </div>
                    <div class="table-info" style="margin-top: 5px;">
                        Total: <strong id="totalData">{{ $data->count() }}</strong> data
                    </div>
                </div>
                <div style="display: flex; gap: 10px;">
                    <!-- ✅ TOMBOL CETAK LAPORAN -->
                    <a href="{{ route('kantor.laporan-pdf', ['kategori' => 'kantor_polres']) }}" class="btn-add" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                        <i class="fas fa-file-pdf"></i> Cetak Laporan
                    </a>
                    <a href="{{ route('kantor.polres.create') }}" class="btn-add">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                </div>
            </div>
        </div>

        <!-- SEARCH BOX -->
        <div class="search-container">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Cari berdasarkan nama, alamat, atau keterangan...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="data-table" id="dataTable">
                <thead>
                    <tr>
                        <th class="col-no">NO</th>
                        <th class="col-nama">NAMA KANTOR</th>
                        <th class="col-luas">LUAS (M²)</th>
                        <th class="col-bangunan">BANGUNAN DI ATAS</th>
                        <th class="col-alamat">ALAMAT</th>
                        <th class="col-foto">FOTO</th>
                        <th class="col-aksi">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $item)
                    <tr>
                        <td class="col-no">{{ $index + 1 }}</td>
                        <td class="col-nama"><strong>{{ $item->nama }}</strong></td>
                        <td class="col-luas">{{ number_format($item->luas_bangunan, 2, ',', '.') }}</td>
                        <td class="col-bangunan">{{ $item->bangunan_di_atas }}</td>
                        <td class="col-alamat">{{ Str::limit($item->alamat, 50) }}</td>
                        <td class="col-foto">
                            @if($item->foto)
                                <a href="{{ $item->foto_url }}" target="_blank">
                                    <img src="{{ $item->foto_url }}" class="table-img" alt="Foto">
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="col-aksi">
                            <div class="action-buttons">
                                <a href="{{ route('kantor.show', $item->id) }}" class="btn-action btn-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('kantor.edit', $item->id) }}" class="btn-action btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('kantor.destroy', $item->id) }}" method="POST" style="display: inline;" 
                                      onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="empty-row">
                        <td colspan="7" class="text-center" style="padding: 50px;">
                            <i class="fas fa-inbox" style="font-size: 56px; color: #ddd; margin-bottom: 15px;"></i>
                            <p style="color: #999; font-size: 15px;">Belum ada data kantor</p>
                            <a href="{{ route('kantor.polres.create') }}" class="btn-add" style="margin-top: 15px; display: inline-flex;">
                                <i class="fas fa-plus"></i> Tambah Data Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
/* Table Container */
.table-container {
    background: white;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    border: 1px solid #e5e7eb;
}

.table-header {
    padding: 24px 28px;
    border-bottom: 1px solid #e5e7eb;
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
}

.table-title {
    font-size: 17px;
    font-weight: 600;
    color: #78350f;
    display: flex;
    align-items: center;
}

.table-title i {
    color: #92400e;
    margin-right: 10px;
}

.table-info {
    font-size: 14px;
    color: #92400e;
}

.table-info strong {
    color: #78350f;
    font-size: 15px;
    font-weight: 600;
}

/* Search Container */
.search-container {
    padding: 20px 28px;
    background: #fafafa;
    border-bottom: 1px solid #e5e7eb;
}

.search-box {
    position: relative;
    max-width: 500px;
}

.search-box i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #6b7280;
}

.search-box input {
    width: 100%;
    padding: 12px 15px 12px 45px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.3s;
}

.search-box input:focus {
    outline: none;
    border-color: #f59e0b;
    box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
}

/* Button Add */
.btn-add {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 22px;
    background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
}

.btn-add:hover {
    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
    box-shadow: 0 2px 8px rgba(185, 28, 28, 0.3);
}

/* Table */
.table-responsive {
    overflow-x: auto;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    table-layout: fixed;
}

.data-table thead {
    background: #f9fafb;
    border-bottom: 2px solid #e5e7eb;
}

.data-table th,
.data-table td {
    padding: 16px 14px;
    text-align: left;
    vertical-align: middle;
    overflow: hidden;
    text-overflow: ellipsis;
}

.data-table th {
    font-weight: 600;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    color: #374151;
}

/* Column Width Fixed */
.col-no {
    width: 60px;
    text-align: center !important;
}

.col-nama {
    width: 200px;
}

.col-luas {
    width: 140px;
    text-align: right !important;
}

.col-bangunan {
    width: 180px;
}

.col-alamat {
    width: auto;
    min-width: 200px;
}

.col-foto {
    width: 100px;
    text-align: center !important;
}

.col-aksi {
    width: 180px;
    text-align: center !important;
}

.data-table tbody tr {
    border-bottom: 1px solid #e5e7eb;
    transition: all 0.2s;
}

.data-table tbody tr:hover {
    background: #fef3c7;
}

.data-table td {
    color: #374151;
}

.table-img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 6px;
    border: 2px solid #e5e7eb;
    display: block;
    margin: 0 auto;
}

.text-muted {
    color: #9ca3af;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 6px;
    justify-content: center;
    align-items: center;
}

.btn-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 13px;
    text-decoration: none;
}

.btn-info {
    background: #3b82f6;
    color: white;
}

.btn-info:hover {
    background: #2563eb;
}

.btn-warning {
    background: #f59e0b;
    color: white;
}

.btn-warning:hover {
    background: #d97706;
}

.btn-danger {
    background: #ef4444;
    color: white;
}

.btn-danger:hover {
    background: #dc2626;
}

/* Alert */
.alert {
    padding: 16px 20px;
    border-radius: 6px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    border-left: 4px solid;
}

.alert-success {
    background: #d1fae5;
    color: #065f46;
    border-left-color: #10b981;
}

/* Responsive */
@media (max-width: 1200px) {
    .data-table {
        table-layout: auto;
        min-width: 1000px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('dataTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    const totalData = document.getElementById('totalData');
    
    searchInput.addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        let visibleCount = 0;
        
        for (let i = 0; i < rows.length; i++) {
            // Skip empty row
            if (rows[i].classList.contains('empty-row')) continue;
            
            const cells = rows[i].getElementsByTagName('td');
            let found = false;
            
            // Search in nama (index 1), bangunan_di_atas (index 3), alamat (index 4)
            const searchableContent = [
                cells[1] ? cells[1].textContent : '',
                cells[3] ? cells[3].textContent : '',
                cells[4] ? cells[4].textContent : ''
            ].join(' ').toLowerCase();
            
            if (searchableContent.includes(filter)) {
                found = true;
                visibleCount++;
            }
            
            rows[i].style.display = found ? '' : 'none';
        }
        
        totalData.textContent = visibleCount;
    });
});
</script>
@endsection