@extends('layouts.app')

@section('title', 'Profil Guru - SmartClass')

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('guru.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profil</li>
                    </ol>
                </div>
                <h4 class="page-title">Profil Guru</h4>
            </div>
        </div>
    </div>

    <!-- Profil Form -->
    <div class="row">
        <div class="col-xl-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Edit Profil Guru</h4>
                </div>
                <div class="card-body">
                    @if($guru)
                        <form action="{{ route('guru.profil.update') }}" method="POST">
                            @csrf @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_lengkap" 
                                               value="{{ old('nama_lengkap', $guru->nama_lengkap) }}" 
                                               class="form-control @error('nama_lengkap') is-invalid @enderror" required>
                                        @error('nama_lengkap')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" 
                                               value="{{ old('email', $guru->email) }}" 
                                               class="form-control @error('email') is-invalid @enderror" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">No. HP</label>
                                        <input type="text" name="no_hp" 
                                               value="{{ old('no_hp', $guru->no_hp) }}" 
                                               class="form-control @error('no_hp') is-invalid @enderror">
                                        @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Mata Pelajaran</label>
                                        <input type="text" name="mata_pelajaran" 
                                               value="{{ old('mata_pelajaran', $guru->mata_pelajaran) }}" 
                                               class="form-control @error('mata_pelajaran') is-invalid @enderror"
                                               placeholder="Matematika, IPA, Bahasa Inggris, dll">
                                        @error('mata_pelajaran')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="text-end">
                                <a href="{{ route('guru.dashboard') }}" class="btn btn-secondary me-2">Batal</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-content-save me-1"></i>Update Profil
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-warning text-center">
                            <i class="mdi mdi-account-alert-outline fs-1 mb-3 d-block"></i>
                            <h5>Profil Guru Belum Lengkap</h5>
                            <p class="mb-0">Silakan hubungi administrator untuk melengkapi data profil guru Anda.</p>
                            <a href="{{ route('guru.dashboard') }}" class="btn btn-primary mt-3">Kembali ke Dashboard</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar-lg mx-auto mb-3">
                        <div class="avatar-title bg-primary text-white rounded-circle h2">
                            {{ substr($guru->nama_lengkap ?? 'G', 0, 1) }}
                        </div>
                    </div>
                    <h5 class="mb-1">{{ $guru->nama_lengkap ?? 'Guru' }}</h5>
                    <p class="text-muted mb-3">{{ $guru->mata_pelajaran ?? 'Belum diisi' }}</p>
                    <p class="text-muted mb-0"><i class="mdi mdi-email me-1"></i>{{ $guru->email ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
