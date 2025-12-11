@extends('layouts.app')

@section('title', 'Kelola Pembayaran')

@section('content')
<style>
:root {
    --sky-blue: #0EA5E9;
    --cyan: #06B6D4;
    --teal: #14B8A6;
    --green: #10B981;
    --amber: #F59E0B;
    --red: #EF4444;
    --text-primary: #0F172A;
    --text-secondary: #64748B;
    --border: #E5E7EB;
}

.payment-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
    animation: fadeIn 0.6s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* === STATS GRID === */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    margin-bottom: 20px;
}

.stat-card {
    background: white;
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 16px;
    transition: all 0.2s;
}

.stat-card:hover {
    border-color: var(--sky-blue);
    box-shadow: 0 4px 12px rgba(14, 165, 233, 0.1);
}

.stat-label {
    font-size: 0.7rem;
    font-weight: 700;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
}

.stat-value {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 4px;
    line-height: 1;
}

.stat-desc {
    font-size: 0.75rem;
    color: var(--text-secondary);
}

.stat-blue { border-left: 4px solid var(--sky-blue); }
.stat-warning { border-left: 4px solid var(--amber); }
.stat-green { border-left: 4px solid var(--green); }
.stat-orange { border-left: 4px solid #F97316; }

/* === ALERTS === */
.alert {
    padding: 10px 14px;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.alert-success {
    background: #D1FAE5;
    color: #065F46;
    border: 1px solid #A7F3D0;
}

.alert-error {
    background: #FEE2E2;
    color: #991B1B;
    border: 1px solid #FECACA;
}

/* === MAIN SECTION === */
.payment-section {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.6);
    border-radius: 16px;
    padding: 28px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
}

.qris-grid {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 24px;
    margin-bottom: 28px;
    padding-bottom: 28px;
    border-bottom: 2px solid var(--border);
}

/* === QRIS SECTION === */
.qris-left {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.section-title {
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.qris-wrapper {
    position: relative;
    width: 100%;
    aspect-ratio: 1;
    border-radius: 12px;
    border: 2px dashed var(--border);
    background: linear-gradient(135deg, #F0F9FF, #E0F2FE);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    transition: all 0.3s;
}

.qris-wrapper:hover {
    border-color: var(--sky-blue);
}

.qris-wrapper.has-image {
    border-style: solid;
    background: white;
}

.qris-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 12px;
}

.qris-btns {
    position: absolute;
    top: 10px;
    right: 10px;
    display: flex;
    gap: 6px;
    z-index: 10;
}

.qris-btn {
    width: 34px;
    height: 34px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
}

.qris-btn-edit { background: var(--sky-blue); color: white; }
.qris-btn-edit:hover { background: #0284C7; }

.qris-btn-delete { background: var(--red); color: white; }
.qris-btn-delete:hover { background: #DC2626; }

.qris-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 16px;
    color: #94A3B8;
}

.qris-placeholder svg {
    width: 60px;
    height: 60px;
    margin-bottom: 10px;
    opacity: 0.5;
}

.qris-placeholder-text {
    font-size: 0.8rem;
    font-weight: 600;
    color: #64748B;
    margin-bottom: 4px;
}

.qris-placeholder-sub {
    font-size: 0.7rem;
    color: #94A3B8;
}

/* === FORM SECTION === */
.qris-form {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.form-group.full {
    grid-column: 1 / -1;
}

.form-label {
    font-size: 0.8rem;
    font-weight: 700;
    color: var(--text-primary);
}

.form-label span { color: var(--red); }

.form-input,
.form-select {
    width: 100%;
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 9px 12px;
    font-size: 0.875rem;
    outline: none;
    transition: 0.16s;
    background: white;
}

.form-input:focus {
    border-color: var(--sky-blue);
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
}

/* CUSTOM SELECT */
.custom-select {
    position: relative;
    width: 100%;
}

.custom-select-trigger {
    width: 100%;
    padding: 12px 40px 12px 14px;
    border: 1px solid var(--border);
    border-radius: 10px;
    background: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: all 0.2s;
    user-select: none;
    font-size: 0.9375rem;
}

.custom-select-trigger span {
    font-size: 0.9375rem;
    color: var(--text-primary);
}

.custom-select-trigger.placeholder span {
    color: #9CA3AF;
    font-style: italic;
}

.custom-select-trigger svg {
    color: var(--text-secondary);
    transition: transform 0.2s;
    flex-shrink: 0;
}

.custom-select.active .custom-select-trigger {
    border-color: var(--sky-blue);
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
}

.custom-select.active .custom-select-trigger svg {
    transform: rotate(180deg);
    color: var(--sky-blue);
}

.custom-options {
    position: absolute;
    top: calc(100% + 4px);
    left: 0;
    right: 0;
    background: white;
    border: 1px solid var(--border);
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    max-height: 200px;
    overflow-y: auto;
    z-index: 100;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.2s;
}

.custom-select.active .custom-options {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.custom-option {
    padding: 12px 16px;
    font-size: 0.9375rem;
    color: var(--text-primary);
    cursor: pointer;
    transition: all 0.15s;
    user-select: none;
}

.custom-option.placeholder {
    color: #9CA3AF;
    font-style: italic;
}

.custom-option:hover {
    background: #EFF6FF;
    color: var(--sky-blue);
}

.custom-option.selected {
    background: var(--sky-blue);
    color: white;
    font-weight: 600;
}

.form-help {
    font-size: 0.7rem;
    color: var(--text-secondary);
}

/* Info Display */
.info-display {
    background: #F9FAFB;
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 12px 14px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.info-icon {
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, var(--sky-blue), var(--cyan));
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.info-content { flex: 1; }

.info-label {
    font-size: 0.7rem;
    color: var(--text-secondary);
    margin-bottom: 2px;
}

.info-value {
    font-weight: 700;
    color: var(--text-primary);
    font-size: 0.875rem;
}

/* Tombol Simpan */
.btn-save {
    max-width: 260px;
    margin: 10px auto 0;
    background: var(--sky-blue);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 0.875rem;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-save:hover { background: #0284C7; }

/* === TABLE SECTION === */
.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    gap: 16px;
    flex-wrap: wrap;
    background: linear-gradient(135deg, #F0F9FF, #E0F2FE);
    padding: 16px 20px;
    border-radius: 12px;
    border: 1px solid #BAE6FD;
}

.table-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 8px;
}

.filter-box {
    display: flex;
    align-items: center;
    gap: 8px;
}

.filter-box label {
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--text-secondary);
}

/* Dropdown Filter */
.filter-select-wrapper { position: relative; }
.filter-select { display: none; }

.filter-custom-select {
    position: relative;
    width: 160px;
}

.filter-custom-trigger {
    width: 100%;
    padding: 8px 40px 8px 14px;
    border: 1.5px solid var(--sky-blue);
    border-radius: 10px;
    background: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: all 0.2s;
    user-select: none;
}

.filter-custom-trigger span {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
}

.filter-custom-trigger svg {
    color: var(--sky-blue);
    transition: transform 0.2s;
    flex-shrink: 0;
    width: 18px;
    height: 18px;
}

.filter-custom-select.active .filter-custom-trigger {
    border-color: var(--cyan);
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.15);
}

.filter-custom-select.active .filter-custom-trigger svg {
    transform: rotate(180deg);
}

.filter-custom-options {
    position: absolute;
    top: calc(100% + 4px);
    left: 0;
    right: 0;
    background: white;
    border: 1px solid var(--border);
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    max-height: 180px;
    overflow-y: auto;
    z-index: 100;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.2s;
}

.filter-custom-select.active .filter-custom-options {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.filter-custom-option {
    padding: 10px 14px;
    font-size: 0.875rem;
    color: var(--text-primary);
    cursor: pointer;
    transition: all 0.15s;
    user-select: none;
}

.filter-custom-option:hover {
    background: #EFF6FF;
    color: var(--sky-blue);
}

.filter-custom-option.selected {
    background: var(--sky-blue);
    color: white;
    font-weight: 600;
}

.btn-apply {
    background: var(--sky-blue);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 8px 16px;
    font-size: 0.875rem;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-apply:hover { background: #0284C7; }

/* Table Wrapper */
.table-wrapper {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid var(--border);
}

.table-responsive { overflow-x: auto; }

/* Modern Table */
.modern-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}

.modern-table thead {
    background: linear-gradient(135deg, var(--sky-blue) 0%, var(--cyan) 100%);
}

.modern-table thead th {
    padding: 14px 16px;
    text-align: center;
    font-size: 0.75rem;
    font-weight: 700;
    color: white;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    white-space: nowrap;
}

.modern-table tbody tr {
    border-bottom: 1px solid var(--border);
    background: white;
    transition: background 0.2s;
}

.modern-table tbody tr:hover { background: #F9FAFB; }
.modern-table tbody tr:last-child { border-bottom: none; }

.modern-table tbody td {
    padding: 16px;
    font-size: 0.875rem;
    color: var(--text-primary);
    vertical-align: middle;
    border-right: 1px solid #F3F4F6;
}

.modern-table tbody td:last-child { border-right: none; }

.th-number, .td-number { width: 70px; text-align: center; }
.th-tanggal, .td-tanggal { width: 12%; text-align: center; }
.th-nama, .td-nama { width: 25%; text-align: left; }
.th-kelas, .td-kelas { width: 18%; text-align: left; }
.th-nominal, .td-nominal { width: 15%; text-align: right; }
.th-status, .td-status { width: 12%; text-align: center; }
.th-action, .td-action { width: auto; text-align: center; }

.row-number {
    font-weight: 700;
    font-size: 1rem;
    color: var(--text-primary);
}

/* Badge Status */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 700;
    white-space: nowrap;
}

.badge-menunggu {
    background: #FEF3C7;
    color: #92400E;
    border: 1px solid #FDE68A;
}

.badge-lunas {
    background: #D1FAE5;
    color: #065F46;
    border: 1px solid #A7F3D0;
}

.badge-gagal {
    background: #FEE2E2;
    color: #991B1B;
    border: 1px solid #FECACA;
}

.reject-reason {
    font-size: 0.7rem;
    color: #991B1B;
    font-style: italic;
    margin-top: 4px;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 6px;
    flex-wrap: wrap;
}

.btn-action {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1.5px solid;
    border-radius: 8px;
    background: white;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
}

.btn-detail { color: var(--sky-blue); border-color: #BAE6FD; }
.btn-detail:hover { background: #F0F9FF; border-color: var(--sky-blue); }

.btn-verify { color: var(--green); border-color: #A7F3D0; }
.btn-verify:hover { background: #F0FDF4; border-color: var(--green); }

.btn-reject { color: var(--red); border-color: #FECACA; }
.btn-reject:hover { background: #FEF2F2; border-color: var(--red); }

/* Empty State */
.empty-state-table {
    padding: 60px 20px !important;
    text-align: center;
    background: #F9FAFB;
}

.empty-content h4 {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 12px 0 8px;
}

.empty-content p {
    font-size: 0.9375rem;
    color: var(--text-secondary);
    margin: 0;
}

/* === MODALS === */
.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 9998;
    backdrop-filter: blur(4px);
}

.modal-overlay.active { display: block; }

.modal {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    border-radius: 14px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    z-index: 9999;
    max-width: 440px;
    width: 90%;
    padding: 22px;
    max-height: 90vh;
    overflow-y: auto;
}

.modal.active { display: block; }

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 18px;
}

.modal-title {
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--text-primary);
}

.modal-close {
    background: #F1F5F9;
    border: none;
    border-radius: 6px;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 1.2rem;
    color: #64748B;
    transition: 0.15s;
}

.modal-close:hover { background: #E2E8F0; }

.modal-body { margin-bottom: 18px; }

.form-textarea {
    width: 100%;
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 9px 12px;
    font-size: 0.875rem;
    outline: none;
    resize: vertical;
    min-height: 90px;
    font-family: inherit;
}

.form-textarea:focus {
    border-color: var(--red);
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.modal-footer {
    display: flex;
    gap: 8px;
    justify-content: flex-end;
}

.btn-cancel {
    background: #F3F4F6;
    color: #374151;
    border: none;
    border-radius: 8px;
    padding: 9px 16px;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-cancel:hover { background: #E5E7EB; }

.btn-submit {
    background: var(--sky-blue);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 9px 16px;
    font-size: 0.875rem;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-submit:hover { background: #0284C7; }

.btn-submit.danger { background: var(--red); }
.btn-submit.danger:hover { background: #DC2626; }

/* === RESPONSIVE === */
@media (max-width: 1024px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .qris-grid { grid-template-columns: 1fr; }
    .qris-left { max-width: 280px; margin: 0 auto; }
}

@media (max-width: 768px) {
    .form-row { grid-template-columns: 1fr; }
    .section-header { flex-direction: column; align-items: stretch; padding: 12px 16px; }
    .filter-box { flex-direction: column; align-items: stretch; }
    .filter-custom-select { width: 100%; }
    .btn-apply { width: 100%; }
}

@media (max-width: 640px) {
    .payment-container { padding: 14px; }
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .payment-section { padding: 16px; }
    .modern-table { font-size: 0.75rem; }
    .modern-table thead th,
    .modern-table tbody td { padding: 10px 8px; }
    .action-buttons { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 4px; }
    .btn-action { width: 100%; height: 32px; }
}
</style>

<div class="payment-container">
    <div class="stats-grid">
        <div class="stat-card stat-blue">
            <div class="stat-label">Total Transaksi</div>
            <div class="stat-value">{{ $totalPembayaran ?? 0 }}</div>
            <div class="stat-desc">Semua pembayaran tercatat</div>
        </div>
        <div class="stat-card stat-warning">
            <div class="stat-label">Menunggu</div>
            <div class="stat-value">{{ $menunggu ?? 0 }}</div>
            <div class="stat-desc">Butuh pengecekan Anda</div>
        </div>
        <div class="stat-card stat-green">
            <div class="stat-label">Lunas</div>
            <div class="stat-value">{{ $lunas ?? 0 }}</div>
            <div class="stat-desc">Pembayaran beres</div>
        </div>
        <div class="stat-card stat-orange">
            <div class="stat-label">Total Pemasukan</div>
            <div class="stat-value" style="font-size: 1.4rem;">Rp {{ number_format($totalNominal ?? 0, 0, ',', '.') }}</div>
            <div class="stat-desc">Akumulasi lunas</div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="payment-section">
        <div class="qris-grid">
            <div class="qris-left">
                <h3 class="section-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    QRIS Pembayaran
                </h3>

                <div class="qris-wrapper {{ $admin && $admin->qris_image ? 'has-image' : '' }}">
                    @if($admin && $admin->qris_image)
                        <div class="qris-btns">
                            <button type="button" class="qris-btn qris-btn-edit" onclick="triggerFileInput()" title="Edit QRIS">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            </button>
                        </div>
                        <img src="{{ asset('storage/'.$admin->qris_image) }}" alt="QRIS">
                    @else
                        <div class="qris-placeholder">
                            <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="10" y="10" width="75" height="75" rx="8" fill="currentColor"/>
                                <rect x="115" y="10" width="75" height="75" rx="8" fill="currentColor"/>
                                <rect x="10" y="115" width="75" height="75" rx="8" fill="currentColor"/>
                                <rect x="30" y="30" width="35" height="35" rx="4" fill="white"/>
                                <rect x="135" y="30" width="35" height="35" rx="4" fill="white"/>
                                <rect x="30" y="135" width="35" height="35" rx="4" fill="white"/>
                            </svg>
                            <div class="qris-placeholder-text">Belum ada QRIS</div>
                            <div class="qris-placeholder-sub">Klik ikon edit untuk upload</div>
                        </div>
                    @endif
                </div>

                <input type="file" id="qrisFileInput" accept="image/*" style="display:none" onchange="handleFileSelect(event)">
            </div>

            <div class="qris-form">
                <h3 class="section-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    Informasi Rekening
                </h3>

                @if($admin && $admin->qris_image)
                    <div class="info-display">
                        <div class="info-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Bank / E-Wallet</div>
                            <div class="info-value">{{ $admin->qris_nama_bank ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="info-display">
                        <div class="info-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Nama Rekening / Pemilik</div>
                            <div class="info-value">{{ $admin->qris_nama_rekening ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="info-display">
                        <div class="info-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </div>
                        <div class="info-content">
                            <div class="info-label">No. WhatsApp</div>
                            <div class="info-value">{{ $admin->no_wa ?? '-' }}</div>
                        </div>
                    </div>
                @else
                    <form id="qrisForm" method="POST" action="{{ route('admin.pembayaran.qris.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group full">
                                <label class="form-label">Bank / E-Wallet <span>*</span></label>
                                <select id="bankSelect" class="form-select" name="bank" style="display:none;">
                                    <option value="">Pilih Bank/E-Wallet</option>
                                    <option value="DANA">DANA</option>
                                    <option value="GoPay">GoPay</option>
                                    <option value="OVO">OVO</option>
                                    <option value="ShopeePay">ShopeePay</option>
                                    <option value="LinkAja">LinkAja</option>
                                    <option value="other">Lainnya...</option>
                                </select>
                                <div class="custom-select" data-target="bankSelect">
                                    <div class="custom-select-trigger placeholder">
                                        <span>Pilih Bank/E-Wallet</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </div>
                                    <div class="custom-options">
                                        <div class="custom-option placeholder" data-value="">Pilih Bank/E-Wallet</div>
                                        <div class="custom-option" data-value="DANA">DANA</div>
                                        <div class="custom-option" data-value="GoPay">GoPay</div>
                                        <div class="custom-option" data-value="OVO">OVO</div>
                                        <div class="custom-option" data-value="ShopeePay">ShopeePay</div>
                                        <div class="custom-option" data-value="LinkAja">LinkAja</div>
                                        <div class="custom-option" data-value="other">Lainnya...</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group full" id="otherBankGroup" style="display:none;">
                                <label class="form-label">Nama Bank/E-Wallet Lainnya <span>*</span></label>
                                <input type="text" id="otherBankInput" class="form-input" placeholder="Masukkan nama bank/e-wallet">
                            </div>

                            <div class="form-group full">
                                <label class="form-label">Nama Rekening / Pemilik <span>*</span></label>
                                <input type="text" id="namaRekeningInput" name="nama_rekening" class="form-input" placeholder="Sesuai nama di rekening">
                                <div class="form-help">Isi sesuai nama yang terdaftar di bank/e-wallet</div>
                            </div>

                            <div class="form-group full">
                                <label class="form-label">No. WhatsApp <span>*</span></label>
                                <input type="tel" id="noWaInput" name="no_wa" class="form-input" placeholder="08xxxxxxxxxx">
                                <div class="form-help">Nomor WA yang bisa dihubungi siswa</div>
                            </div>
                        </div>

                        <button type="submit" class="btn-save">Simpan</button>
                    </form>
                @endif
            </div>
        </div>

        <div class="section-header">
            <h3 class="table-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                Daftar Pembayaran Siswa
            </h3>
            <div class="filter-box">
                <label>Filter:</label>
                <div class="filter-select-wrapper">
                    <select id="filterStatus" class="filter-select">
                        <option value="">Semua Status</option>
                        <option value="menunggu">Menunggu</option>
                        <option value="lunas">Lunas</option>
                        <option value="gagal">Gagal</option>
                    </select>
                    <div class="filter-custom-select" data-target="filterStatus">
                        <div class="filter-custom-trigger">
                            <span>Semua Status</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                        <div class="filter-custom-options">
                            <div class="filter-custom-option selected" data-value="">Semua Status</div>
                            <div class="filter-custom-option" data-value="menunggu">Menunggu</div>
                            <div class="filter-custom-option" data-value="lunas">Lunas</div>
                            <div class="filter-custom-option" data-value="gagal">Gagal</div>
                        </div>
                    </div>
                </div>
                <button class="btn-apply" onclick="applyFilter()">Terapkan</button>
            </div>
        </div>

        <div class="table-wrapper">
            <div class="table-responsive">
                <table class="modern-table" id="pembayaranTable">
                    <thead>
                        <tr>
                            <th class="th-number">NO</th>
                            <th class="th-tanggal">TANGGAL</th>
                            <th class="th-nama">NAMA SISWA</th>
                            <th class="th-kelas">KELAS</th>
                            <th class="th-nominal">NOMINAL</th>
                            <th class="th-status">STATUS</th>
                            <th class="th-action">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pembayarans ?? [] as $i => $bayar)
                            <tr data-status="{{ $bayar->status_pembayaran }}">
                                <td class="td-number">
                                    <span class="row-number">{{ $i + 1 }}</span>
                                </td>
                                <td class="td-tanggal">{{ optional($bayar->created_at)->format('d/m/Y') }}</td>
                                <td class="td-nama"><strong>{{ $bayar->pemesanan->siswa->nama_lengkap ?? '-' }}</strong></td>
                                <td class="td-kelas">{{ $bayar->pemesanan->kelas->nama_kelas ?? '-' }}</td>
                                <td class="td-nominal"><strong style="color: var(--green);">Rp {{ number_format($bayar->nominal_pembayaran, 0, ',', '.') }}</strong></td>
                                <td class="td-status">
                                    <span class="badge badge-{{ $bayar->status_pembayaran }}">
                                        {{ ucfirst($bayar->status_pembayaran) }}
                                    </span>
                                    @if($bayar->status_pembayaran === 'gagal' && $bayar->rejected_reason)
                                        <div class="reject-reason">Alasan: {{ $bayar->rejected_reason }}</div>
                                    @endif
                                </td>
                                <td class="td-action">
                                    <div class="action-buttons">
                                        @if($bayar->bukti_pembayaran)
                                            <a href="{{ asset('storage/'.$bayar->bukti_pembayaran) }}" target="_blank"
                                               class="btn-action btn-detail" title="Lihat Bukti">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                            </a>
                                        @endif

                                        @if($bayar->status_pembayaran === 'menunggu')
                                            <button type="button" class="btn-action btn-verify"
                                                    onclick="confirmVerify('{{ $bayar->id }}')" title="Terima">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </button>
                                            <button type="button" class="btn-action btn-reject"
                                                    onclick="showRejectModal('{{ $bayar->id }}')" title="Tolak">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty-state-table">
                                    <div class="empty-content">
                                        <h4>Belum Ada Pembayaran</h4>
                                        <p>Pembayaran siswa akan muncul di sini</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modalOverlay"></div>

<div class="modal" id="verifyModal">
    <div class="modal-header">
        <h3 class="modal-title">Verifikasi Pembayaran</h3>
        <button type="button" class="modal-close" onclick="closeVerifyModal()">×</button>
    </div>
    <div class="modal-body">
        <p>Apakah Anda yakin pembayaran ini sudah lunas?</p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn-cancel" onclick="closeVerifyModal()">Batal</button>
        <form id="formVerify" method="POST">
            @csrf
            <input type="hidden" name="status" value="lunas">
            <button type="submit" class="btn-submit">Ya, Lunas</button>
        </form>
    </div>
</div>

<div class="modal" id="rejectModal">
    <div class="modal-header">
        <h3 class="modal-title">Tolak Pembayaran</h3>
        <button type="button" class="modal-close" onclick="closeRejectModal()">×</button>
    </div>
    <form id="formReject" method="POST">
        @csrf
        <input type="hidden" name="status" value="gagal">
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Alasan Penolakan <span>*</span></label>
                <textarea name="rejected_reason" class="form-textarea" required placeholder="Jelaskan alasan penolakan..."></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-cancel" onclick="closeRejectModal()">Batal</button>
            <button type="submit" class="btn-submit danger">Tolak Pembayaran</button>
        </div>
    </form>
</div>

<script>
let qrisFile = null;

function triggerFileInput() {
    document.getElementById('qrisFileInput').click();
}

function handleFileSelect(event) {
    const file = event.target.files[0];
    if (!file) return;

    if (file.size > 2 * 1024 * 1024) {
        alert('Ukuran file maksimal 2MB');
        return;
    }
    if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
        alert('Format file harus JPG, JPEG, atau PNG');
        return;
    }

    qrisFile = file;

    const reader = new FileReader();
    reader.onload = function(e) {
        const wrapper = document.querySelector('.qris-wrapper');
        wrapper.classList.add('has-image');
        wrapper.innerHTML = `
            <div class="qris-btns">
                <button type="button" class="qris-btn qris-btn-edit" onclick="triggerFileInput()" title="Edit QRIS">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </button>
            </div>
            <img src="${e.target.result}" alt="QRIS Preview">
        `;
    };
    reader.readAsDataURL(file);
}

// custom select bank
document.querySelectorAll('.custom-select').forEach(select => {
    const trigger = select.querySelector('.custom-select-trigger');
    const options = select.querySelectorAll('.custom-option');
    const targetSelect = document.getElementById(select.dataset.target);

    trigger.addEventListener('click', () => {
        document.querySelectorAll('.custom-select').forEach(s => {
            if (s !== select) s.classList.remove('active');
        });
        select.classList.toggle('active');
    });

    options.forEach(option => {
        option.addEventListener('click', () => {
            const value = option.dataset.value;
            const text = option.textContent;

            targetSelect.value = value;

            options.forEach(o => o.classList.remove('selected'));
            option.classList.add('selected');

            if (value === '') {
                trigger.classList.add('placeholder');
            } else {
                trigger.classList.remove('placeholder');
            }
            trigger.querySelector('span').textContent = text;

            select.classList.remove('active');

            if (select.dataset.target === 'bankSelect') {
                const otherGroup = document.getElementById('otherBankGroup');
                otherGroup.style.display = (value === 'other') ? 'block' : 'none';
            }
        });
    });
});

document.addEventListener('click', e => {
    if (!e.target.closest('.custom-select') && !e.target.closest('.filter-custom-select')) {
        document.querySelectorAll('.custom-select, .filter-custom-select').forEach(s => s.classList.remove('active'));
    }
});

// filter custom select
document.querySelectorAll('.filter-custom-select').forEach(select => {
    const trigger = select.querySelector('.filter-custom-trigger');
    const options = select.querySelectorAll('.filter-custom-option');
    const targetSelect = document.getElementById(select.dataset.target);

    trigger.addEventListener('click', () => {
        document.querySelectorAll('.filter-custom-select').forEach(s => {
            if (s !== select) s.classList.remove('active');
        });
        select.classList.toggle('active');
    });

    options.forEach(option => {
        option.addEventListener('click', () => {
            const value = option.dataset.value;
            const text = option.textContent;

            targetSelect.value = value;

            options.forEach(o => o.classList.remove('selected'));
            option.classList.add('selected');

            trigger.querySelector('span').textContent = text;
            select.classList.remove('active');
        });
    });
});

function applyFilter() {
    const status = document.getElementById('filterStatus').value;
    const rows = document.querySelectorAll('#pembayaranTable tbody tr[data-status]');

    rows.forEach(row => {
        row.style.display = (status === '' || row.dataset.status === status) ? '' : 'none';
    });
}

function confirmVerify(id) {
    document.getElementById('formVerify').action = `/admin/payments/${id}/verify`;
    document.getElementById('verifyModal').classList.add('active');
    document.getElementById('modalOverlay').classList.add('active');
}

function closeVerifyModal() {
    document.getElementById('verifyModal').classList.remove('active');
    document.getElementById('modalOverlay').classList.remove('active');
}

function showRejectModal(id) {
    const form = document.getElementById('formReject');
    form.action = `/admin/payments/${id}/verify`;
    form.querySelector('textarea[name="rejected_reason"]').value = '';

    document.getElementById('rejectModal').classList.add('active');
    document.getElementById('modalOverlay').classList.add('active');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.remove('active');
    document.getElementById('modalOverlay').classList.remove('active');
}

document.getElementById('modalOverlay').addEventListener('click', () => {
    closeVerifyModal();
    closeRejectModal();
});

document.addEventListener('DOMContentLoaded', () => {
    @if(session('success'))
        alert("{{ session('success') }}");
    @endif
    @if(session('error'))
        alert("{{ session('error') }}");
    @endif
});
</script>
@endsection
