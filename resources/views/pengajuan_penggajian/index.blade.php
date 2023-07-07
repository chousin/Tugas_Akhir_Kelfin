@extends('layouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $message)
            <ul>
                <li>{{ $message }}</li>
            </ul>
            @endforeach
        </div>
        @endif

        @include('_partial.flash_message')
        <form method="POST" action="{{ url('/pengajuan-penggajian') }}">
            @csrf
            <div class="mb-3">
                <label for="periode_start" class="form-label">Periode Absen Mulai</label>
                <input type="date" name="periode_start" class="form-control" value="{{ old('periode_start') ? old('periode_start') : date('Y-m-d') }}" min="{{ isset($pengajuan_penggajian) ? date('Y-m-d', strtotime('+1 days', strtotime($pengajuan_penggajian->periode_end))) : '' }}">
            </div>
            <div class="mb-3">
                <label for="periode_end" class="form-label">Periode Absen Akhir</label>
                <input type="date" name="periode_end" class="form-control" value="{{ old('periode_end') ? old('periode_end') : date('Y-m-d') }}" min="{{ isset($pengajuan_penggajian) ? date('Y-m-d', strtotime('+1 days', strtotime($pengajuan_penggajian->periode_end))) : '' }}">
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan Pengajuan</label>
                <textarea name="keterangan" class="form-control" rows="8"></textarea>
            </div>
            <div class="mb-3">
                <input type="submit" value="PENGAJUAN" class="btn btn-primary btn-block">
            </div>
        </form>
    </div>
</div>
@endsection