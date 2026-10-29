@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="fw-bold mb-0">Transaksi Peminjaman Buku</h3>
                <small class="text-muted">Catat peminjaman buku oleh anggota perpustakaan.</small>
            </div>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card p-4 shadow-sm">
            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Pilih Anggota <span class="text-danger">*</span></label>
                    <select name="anggota_id" class="form-select @error('anggota_id') is-invalid @enderror">
                        <option value="">-- Pilih Anggota Peminjam --</option>
                        @foreach ($anggota as $a)
                            <option value="{{ $a->id }}" {{ old('anggota_id') == $a->id ? 'selected' : '' }}>
                                {{ $a->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('anggota_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Buku <span class="text-danger">*</span></label>
                    <select name="buku_id" class="form-select @error('buku_id') is-invalid @enderror">
                        <option value="">-- Pilih Buku yang Dipinjam --</option>
                        @foreach ($buku as $b)
                            <option value="{{ $b->id }}" {{ old('buku_id') == $b->id ? 'selected' : '' }}>
                                {{ $b->judul }} (stok: {{ $b->stok }})
                            </option>
                        @endforeach
                    </select>
                    @error('buku_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="text-muted">Hanya buku dengan stok > 0 yang muncul dalam pilihan. Stok akan otomatis berkurang 1.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Pinjam <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_pinjam" class="form-control @error('tanggal_pinjam') is-invalid @enderror"
                           value="{{ old('tanggal_pinjam', date('Y-m-d')) }}">
                    @error('tanggal_pinjam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check2"></i> Simpan Peminjaman
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection