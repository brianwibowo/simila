@extends('layouts.layout')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--multiple {
        min-height: 38px;
        padding: 5px;
        border: 1px solid #ced4da;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
</style>
@endpush

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 h4">Ajukan Riset/Inovasi Produk</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('waka-humas-riset-store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="topik" class="form-label">Topik Riset</label>
            <input type="text" name="topik" id="topik" class="form-control" value="{{ old('topik') }}" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control" required>{{ old('deskripsi') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="tim_riset" class="form-label">Anggota Tim</label>
            <select name="tim_riset[]" id="tim_riset" class="form-select select2-multiple" multiple="multiple" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ in_array($user->id, old('tim_riset', [])) ? 'selected' : '' }}>{{ ucfirst(strtolower($user->name)) }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="file_proposal" class="form-label">File Proposal (PDF, maks. 10MB)</label>
            <input type="file" name="file_proposal" id="file_proposal" class="form-control" accept=".pdf" required>
        </div>
        <div class="mb-3">
            <label for="dokumentasi" class="form-label">Dokumentasi (Gambar, maks. 2MB)</label>
            <input type="file" name="dokumentasi" id="dokumentasi" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajukan</button>
        <a href="{{ route('waka-humas-riset-index') }}" class="btn btn-secondary ms-2">Kembali</a>
    </form>
</div>
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2 with proper configuration
        $('#tim_riset').select2({
            placeholder: 'Pilih anggota tim',
            allowClear: true,
            width: '100%',
            dropdownParent: $('form'),
            minimumResultsForSearch: 1,
            dropdownAutoWidth: true,
            closeOnSelect: false
        });

        // Format the display of selected options
        $('#tim_riset').on('select2:select', function (e) {
            var data = e.params.data;
            var $option = $(data.element);
            var displayText = data.text.charAt(0).toUpperCase() + data.text.slice(1).toLowerCase();
            $option.text(displayText).trigger('change');
        });

        // Make sure the dropdown opens on click
        $('.select2-container--default').on('click', function() {
            $('#tim_riset').select2('open');
        });
    });
</script>
@endpush
@endsection
