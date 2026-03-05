@extends('layouts.app')

@section('title', 'Data Tanah Polsek')

@section('content')
<div class="content-body">
    <div class="table-container">
        <!-- HEADER TABEL -->
        <div class="table-header">
            <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <div>
                    <div class="table-title">
                        <i class="fas fa-list"></i> Daftar Tanah Polsek
                    </div>
                    <div class="table-info" style="margin-top: 8px;">
                        <div style="margin-bottom: 4px;">
                            Total: <strong>{{ $data->count() }}</strong> data
                        </div>
                    </div>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button type="button" class="btn-report" onclick="openReportModal()">
                        <i class="fas fa-file-pdf"></i> Cetak Laporan
                    </button>
                    <a href="{{ route('tanah.polsek.create') }}" class="btn-add">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                </div>
            </div>
        </div>

        <!-- SEARCH CONTAINER -->
        <div class="search-container">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Cari berdasarkan nama atau alamat...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="data-table" id="dataTable">
                <thead>
                    <tr>
                        <th width="60" class="text-center">NO</th>
                        <th width="200">NAMA</th>
                        <th>ALAMAT</th>
                        <th width="120">STATUS</th>
                        <th width="180" class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td><strong>{{ $item->nama }}</strong></td>
                        <td>{{ Str::limit($item->alamat, 50) }}</td>
                        <td>
                            <span class="badge badge-{{ $item->status == 'Sertifikat' ? 'success' : 'warning' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="action-buttons">
                                <!-- ICON LIHAT BANGUNAN (BARU) -->
                                <button type="button" onclick="openBangunanModal({{ $item->id }})" class="btn-action btn-building" title="Lihat Bangunan">
                                    <i class="fas fa-building"></i>
                                </button>
                                <a href="{{ route('tanah.show', $item->id) }}" class="btn-action btn-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('tanah.edit', $item->id) }}" class="btn-action btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('tanah.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                        <td colspan="5" class="text-center" style="padding: 50px;">
                            <i class="fas fa-inbox" style="font-size: 56px; color: #ddd; margin-bottom: 15px;"></i>
                            <p style="color: #999; font-size: 15px;">Belum ada data tanah Polsek</p>
                            <a href="{{ route('tanah.polsek.create') }}" class="btn-add" style="margin-top: 15px; display: inline-flex;">
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

<!-- MODAL FILTER LAPORAN -->
<div id="reportModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-filter"></i> Filter Laporan Data Tanah</h3>
            <span class="close" onclick="closeReportModal()">&times;</span>
        </div>
        <form action="{{ route('tanah.laporan-pdf') }}" method="GET" target="_blank">
            <div class="modal-body">
                <div class="form-group">
                    <label>Kategori Satuan</label>
                    <select name="kategori" class="form-control" id="kategoriSelect" required onchange="togglePolsekField()">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="polres">Polres</option>
                        <option value="polsek">Polsek</option>
                    </select>
                </div>

                <div class="form-group" id="polsekField" style="display: none;">
                    <label>Nama Polsek</label>
                    <select name="polsek_nama" class="form-control">
                        <option value="">-- Semua Polsek --</option>
                        <option value="Polsek Padaherang">Polsek Padaherang</option>
                        <option value="Polsek Kalipucang">Polsek Kalipucang</option>
                        <option value="Polsek Pangandaran">Polsek Pangandaran</option>
                        <option value="Polsek Sidamulih">Polsek Sidamulih</option>
                        <option value="Polsek Parigi">Polsek Parigi</option>
                        <option value="Polsek Cijulang">Polsek Cijulang</option>
                        <option value="Polsek Cigugur">Polsek Cigugur</option>
                        <option value="Polsek Cimerak">Polsek Cimerak</option>
                        <option value="Polsek Langkaplancar">Polsek Langkaplancar</option>
                        <option value="Sat Polairud">Sat Polairud</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Status Tanah</label>
                    <select name="status" class="form-control">
                        <option value="">-- Semua Status --</option>
                        <option value="Sertifikat">Sertifikat</option>
                        <option value="Girik">Girik</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeReportModal()">Batal</button>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-download"></i> Download PDF
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL LIHAT BANGUNAN (BARU) -->
<div id="bangunanModal" class="modal">
    <div class="modal-content-large">
        <div class="modal-header">
            <h3>
                <i class="fas fa-building"></i> 
                Daftar Bangunan di <span id="modalTanahNama"></span>
            </h3>
            <span class="close" onclick="closeBangunanModal()">&times;</span>
        </div>
        <div class="modal-body">
            <!-- Loading State -->
            <div id="loadingBangunan" style="text-align: center; padding: 40px; display: none;">
                <i class="fas fa-spinner fa-spin" style="font-size: 36px; color: #f59e0b;"></i>
                <p style="margin-top: 15px; color: #6b7280;">Memuat data bangunan...</p>
            </div>

            <!-- Empty State -->
            <div id="emptyBangunan" style="text-align: center; padding: 40px; display: none;">
                <i class="fas fa-inbox" style="font-size: 56px; color: #ddd;"></i>
                <p style="margin-top: 15px; color: #999;">Belum ada bangunan di tanah ini</p>
            </div>

            <!-- Table Bangunan -->
            <div id="tableBangunan" style="display: none;">
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th width="60">NUP</th>
                                <th width="100">JENIS</th>
                                <th>NAMA BANGUNAN</th>
                                <th width="120">LUAS</th>
                                <th width="150">KATEGORI</th>
                                <th width="120" class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="bangunanTableBody">
                            <!-- Data akan diisi oleh JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-cancel" onclick="closeBangunanModal()">Tutup</button>
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

/* Button Add & Report */
.btn-add, .btn-report {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 22px;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
}

.btn-add {
    background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);
    color: white;
}

.btn-add:hover {
    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
    box-shadow: 0 2px 8px rgba(185, 28, 28, 0.3);
}

.btn-report {
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
    color: white;
}

.btn-report:hover {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    box-shadow: 0 2px 8px rgba(5, 150, 105, 0.3);
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

/* Badge untuk SEMUA jenis bangunan */
.badge-kantor {
    background: #dbeafe;
    color: #1e40af;
}

.badge-rumdin {
    background: #fce7f3;
    color: #9f1239;
}

.badge-barak {
    background: #e0e7ff;
    color: #4338ca;
}

.badge-garasi {
    background: #fef3c7;
    color: #92400e;
}

.badge-mushola {
    background: #dcfce7;
    color: #166534;
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

.btn-building {
    background: #8b5cf6;
    color: white;
}

.btn-building:hover {
    background: #7c3aed;
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

/* MODAL STYLES */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    animation: fadeIn 0.3s;
}

.modal-content {
    background-color: white;
    margin: 8% auto;
    width: 90%;
    max-width: 500px;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    animation: slideDown 0.3s;
}

.modal-content-large {
    background-color: white;
    margin: 5% auto;
    width: 90%;
    max-width: 900px;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    animation: slideDown 0.3s;
    max-height: 80vh;
    display: flex;
    flex-direction: column;
}

.modal-header {
    padding: 20px 24px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h3 {
    margin: 0;
    font-size: 18px;
    color: #1f2937;
    display: flex;
    align-items: center;
    gap: 10px;
}

.modal-header h3 i {
    color: #8b5cf6;
}

.close {
    color: #9ca3af;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    transition: color 0.2s;
}

.close:hover {
    color: #374151;
}

.modal-body {
    padding: 24px;
    overflow-y: auto;
    max-height: calc(80vh - 140px);
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #374151;
    font-size: 14px;
}

.form-control {
    width: 100%;
    padding: 10px 14px;
    border: 2px solid #e5e7eb;
    border-radius: 6px;
    font-size: 14px;
    transition: all 0.2s;
}

.form-control:focus {
    outline: none;
    border-color: #059669;
    box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
}

.modal-footer {
    padding: 16px 24px;
    border-top: 1px solid #e5e7eb;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.btn-cancel, .btn-submit {
    padding: 10px 20px;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-cancel {
    background: #f3f4f6;
    color: #374151;
}

.btn-cancel:hover {
    background: #e5e7eb;
}

.btn-submit {
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
    color: white;
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn-submit:hover {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    box-shadow: 0 2px 8px rgba(5, 150, 105, 0.3);
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideDown {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
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
    
    .modal-content-large {
        width: 95%;
        margin: 2% auto;
    }
}
</style>

<script>
// Modal Functions
function openReportModal() {
    document.getElementById('reportModal').style.display = 'block';
}

function closeReportModal() {
    document.getElementById('reportModal').style.display = 'none';
}

// Toggle Polsek field based on kategori
function togglePolsekField() {
    const kategori = document.getElementById('kategoriSelect').value;
    const polsekField = document.getElementById('polsekField');
    
    if (kategori === 'polsek') {
        polsekField.style.display = 'block';
    } else {
        polsekField.style.display = 'none';
    }
}

// ========== BANGUNAN MODAL FUNCTIONS (BARU) ==========

function openBangunanModal(tanahId) {
    const modal = document.getElementById('bangunanModal');
    const loading = document.getElementById('loadingBangunan');
    const empty = document.getElementById('emptyBangunan');
    const table = document.getElementById('tableBangunan');
    
    // Show modal
    modal.style.display = 'block';
    
    // Show loading, hide others
    loading.style.display = 'block';
    empty.style.display = 'none';
    table.style.display = 'none';
    
    // Fetch data via AJAX
    fetch(`/tanah/${tanahId}/bangunan`)
        .then(response => response.json())
        .then(data => {
            loading.style.display = 'none';
            
            if (data.success) {
                // Set judul modal
                document.getElementById('modalTanahNama').textContent = data.tanah.nama;
                
                if (data.total > 0) {
                    // Ada bangunan, tampilkan table
                    table.style.display = 'block';
                    renderBangunanTable(data.bangunan);
                } else {
                    // Tidak ada bangunan
                    empty.style.display = 'block';
                }
            } else {
                alert('Gagal memuat data: ' + data.message);
                closeBangunanModal();
            }
        })
        .catch(error => {
            loading.style.display = 'none';
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memuat data bangunan');
            closeBangunanModal();
        });
}

function renderBangunanTable(bangunanList) {
    const tbody = document.getElementById('bangunanTableBody');
    tbody.innerHTML = '';
    
    bangunanList.forEach(item => {
        const row = document.createElement('tr');
        
        // Buat kolom-kolom
        let html = `
            <td class="text-center"><strong>${item.nup}</strong></td>
            <td><span class="badge ${item.badge_class}">${item.jenis}</span></td>
            <td><strong>${item.nama}</strong></td>
            <td>${item.luas}</td>
            <td>${item.kategori}</td>
            <td class="text-center">
                <a href="${item.detail_url}" class="btn-action btn-info" title="Lihat Detail" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </td>
        `;
        
        row.innerHTML = html;
        tbody.appendChild(row);
    });
}

function closeBangunanModal() {
    document.getElementById('bangunanModal').style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    const reportModal = document.getElementById('reportModal');
    const bangunanModal = document.getElementById('bangunanModal');
    
    if (event.target == reportModal) {
        closeReportModal();
    }
    
    if (event.target == bangunanModal) {
        closeBangunanModal();
    }
}

// Search Function
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('dataTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    searchInput.addEventListener('keyup', function() {
        const searchFilter = this.value.toLowerCase();
        
        for (let i = 0; i < rows.length; i++) {
            if (rows[i].classList.contains('empty-row')) continue;
            
            const cells = rows[i].getElementsByTagName('td');
            
            const searchableContent = [
                cells[1] ? cells[1].textContent : '',
                cells[2] ? cells[2].textContent : ''
            ].join(' ').toLowerCase();
            
            if (searchableContent.includes(searchFilter)) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    });
});
</script>
@endsection