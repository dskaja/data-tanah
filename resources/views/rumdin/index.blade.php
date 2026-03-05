@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
<div class="content-body">
    <div class="table-container">
        <!-- HEADER TABEL -->
        <div class="table-header">
            <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <div>
                    <div class="table-title">
                        <i class="fas fa-list"></i> {{ $pageTitle }}
                    </div>
                    <div class="table-info" style="margin-top: 8px;">
                        <div style="margin-bottom: 4px;">
                            Total: <strong>{{ $rumdins->total() }}</strong> data
                        </div>
                    </div>
                </div>
                <div style="display: flex; gap: 10px;">
                    <!-- ✅ TOMBOL CETAK LAPORAN DENGAN DROPDOWN -->
                    <div class="dropdown-cetak">
                        <button class="btn-add" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);" onclick="toggleDropdown()">
                            <i class="fas fa-file-pdf"></i> Cetak Laporan
                            <i class="fas fa-chevron-down" style="font-size: 11px; margin-left: 5px;"></i>
                        </button>
                        <div class="dropdown-content" id="dropdownCetak">
                            <a href="{{ route('rumdin.laporan-pdf', ['kategori' => $kategori ?? '', 'polsek_nama' => $polsekNama ?? '']) }}">
                                <i class="fas fa-file-alt"></i> Semua Data
                            </a>
                            <a href="{{ route('rumdin.laporan-pdf', ['kategori' => $kategori ?? '', 'polsek_nama' => $polsekNama ?? '', 'status' => 'Dihuni']) }}">
                                <i class="fas fa-check-circle"></i> Yang Dihuni
                            </a>
                            <a href="{{ route('rumdin.laporan-pdf', ['kategori' => $kategori ?? '', 'polsek_nama' => $polsekNama ?? '', 'status' => 'Kosong']) }}">
                                <i class="fas fa-times-circle"></i> Yang Kosong
                            </a>
                            <a href="{{ route('rumdin.laporan-pdf', ['kategori' => $kategori ?? '', 'polsek_nama' => $polsekNama ?? '', 'kondisi' => 'B']) }}">
                                <i class="fas fa-thumbs-up"></i> Kondisi Baik
                            </a>
                            <a href="{{ route('rumdin.laporan-pdf', ['kategori' => $kategori ?? '', 'polsek_nama' => $polsekNama ?? '', 'kondisi' => 'RR']) }}">
                                <i class="fas fa-exclamation-triangle"></i> Rusak Ringan
                            </a>
                            <a href="{{ route('rumdin.laporan-pdf', ['kategori' => $kategori ?? '', 'polsek_nama' => $polsekNama ?? '', 'kondisi' => 'RB']) }}">
                                <i class="fas fa-times"></i> Rusak Berat
                            </a>
                        </div>
                    </div>
                    <a href="{{ route($createRoute) }}" class="btn-add">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                </div>
            </div>
        </div>

        <!-- SEARCH CONTAINER -->
        <div class="search-container">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Cari berdasarkan nama bangunan, penghuni, atau type...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="data-table" id="dataTable">
                <thead>
                    <tr>
                        <th width="50">NO</th>
                        <th width="250">NAMA BANGUNAN</th>
                        <th width="200">PENGHUNI</th>
                        <th width="140">TYPE</th>
                        <th width="100">LUAS</th>
                        <th width="120">STATUS</th>
                        <th width="100">KONDISI</th>
                        <th width="150" class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rumdins as $index => $rumdin)
                    <tr>
                        <td class="text-center">
                            <strong style="color: #6b7280;">{{ $rumdins->firstItem() + $index }}</strong>
                        </td>
                        <td>
                            <strong style="color: #1f2937;">{{ $rumdin->nama_bangunan }}</strong>
                        </td>
                        <td>
                            @if($rumdin->penghuni)
                                <span style="color: #374151;">{{ $rumdin->penghuni }}</span>
                            @else
                                <span style="color: #9ca3af; font-style: italic;">-</span>
                            @endif
                        </td>
                        <td>{{ $rumdin->type }}</td>
                        <td>{{ number_format($rumdin->luas, 0) }} m²</td>
                        <td>
                            <span class="badge badge-{{ $rumdin->status == 'Dihuni' ? 'success' : 'warning' }}">
                                {{ $rumdin->status }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-{{ $rumdin->kondisi == 'B' ? 'success' : ($rumdin->kondisi == 'RR' ? 'warning' : 'danger') }}">
                                {{ $rumdin->kondisi }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="action-buttons">
                                <a href="{{ route('rumdin.show', $rumdin) }}" class="btn-action btn-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('rumdin.edit', $rumdin) }}" class="btn-action btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('rumdin.destroy', $rumdin) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                        <td colspan="8" class="text-center" style="padding: 50px;">
                            <i class="fas fa-inbox" style="font-size: 56px; color: #ddd; margin-bottom: 15px;"></i>
                            <p style="color: #999; font-size: 15px;">Belum ada data rumah dinas</p>
                            <a href="{{ route($createRoute) }}" class="btn-add" style="margin-top: 15px; display: inline-flex;">
                                <i class="fas fa-plus"></i> Tambah Data Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($rumdins->hasPages())
        <div style="padding: 20px 28px; border-top: 1px solid #e5e7eb;">
            {{ $rumdins->links('vendor.pagination.custom') }}
        </div>
        @endif
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

/* Dropdown Cetak */
.dropdown-cetak {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background-color: white;
    min-width: 220px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    z-index: 1000;
    border-radius: 6px;
    overflow: hidden;
    margin-top: 5px;
    border: 1px solid #e5e7eb;
    max-height: 300px;
    overflow-y: auto;
}

.dropdown-content::-webkit-scrollbar {
    width: 6px;
}

.dropdown-content::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.dropdown-content::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 3px;
}

.dropdown-content::-webkit-scrollbar-thumb:hover {
    background: #9ca3af;
}

.dropdown-content a {
    color: #374151;
    padding: 12px 16px;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    transition: all 0.2s;
}

.dropdown-content a:hover {
    background-color: #fef3c7;
    color: #92400e;
}

.dropdown-content a i {
    width: 18px;
    text-align: center;
    color: #6b7280;
}

/* Table */
.table-responsive {
    overflow-x: auto;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

.data-table thead {
    background: #f9fafb;
    border-bottom: 2px solid #e5e7eb;
}

.data-table th {
    padding: 16px 14px;
    text-align: left;
    font-weight: 600;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    color: #374151;
    vertical-align: middle;
}

.data-table tbody tr {
    border-bottom: 1px solid #e5e7eb;
    transition: all 0.2s;
}

.data-table tbody tr:hover {
    background: #fef3c7;
}

.data-table td {
    padding: 16px 14px;
    color: #374151;
    vertical-align: middle;
}

.text-center {
    text-align: center !important;
}

/* Badge */
.badge {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
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

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 6px;
    justify-content: center;
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

@media (max-width: 768px) {
    .search-box {
        max-width: 100%;
    }
    
    .table-header > div {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start !important;
    }
    
    .dropdown-content {
        right: auto;
        left: 0;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('dataTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    searchInput.addEventListener('keyup', function() {
        const searchFilter = this.value.toLowerCase();
        
        for (let i = 0; i < rows.length; i++) {
            if (rows[i].classList.contains('empty-row')) continue;
            
            const cells = rows[i].getElementsByTagName('td');
            
            // Search in nama bangunan (index 1), penghuni (index 2), type (index 3)
            const searchableContent = [
                cells[1] ? cells[1].textContent : '',
                cells[2] ? cells[2].textContent : '',
                cells[3] ? cells[3].textContent : ''
            ].join(' ').toLowerCase();
            
            if (searchableContent.includes(searchFilter)) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    });
});

// Dropdown Toggle Function
function toggleDropdown() {
    const dropdown = document.getElementById("dropdownCetak");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}

// Close dropdown when clicking outside
window.onclick = function(event) {
    if (!event.target.closest('.dropdown-cetak')) {
        const dropdown = document.getElementById("dropdownCetak");
        if (dropdown) {
            dropdown.style.display = "none";
        }
    }
}
</script>
@endsection