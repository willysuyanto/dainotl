@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="fw-bold text-danger">
            Gagal Masuk
        </div>
        <p class="text-danger">{{ $errors->first() }}</p>
    </div>
@endif
