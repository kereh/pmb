@php
    $err = $errors->all();
@endphp

<section class="section">
    <div class="card shadow">
        <div class="card-header">
            <h4 class="card-title">Upload Dokumen</h4>
            <p class="card-subtitle w-100 w-lg-75">Scan Ijazah, Kartu
                KIP, KTP/Akte Kelahiran, dan Kartu Keluarga. Ukuran file masing-masing maks: 2MB dengan format PDF.
            </p>

            @if (!empty($err))
                @foreach ($err as $msg)
                    <div class="alert alert-danger alert-dismissible show fade mt-3">
                        <i class="bi bi-x-octagon"></i>
                        {{ $msg }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            @elseif ($status = Session::get('statusDokumen'))
                <div class="alert {{ $status['type'] }} alert-dismissible show fade mt-3">
                    <i class="bi bi-check-circle"></i>
                    {{ $status['message'] }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

        </div>
        <div class="card-body">
            <div class="form">
                <div class="row w-full d-flex row-gap-4 flex-columns">

                    {{-- ijazah --}}
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label class="mb-2">Scan Ijazah</label>
                            <small class="text-danger">*Kosongkan jika tidak punya</small>
                            <div class="input-group">
                                <input class="form-control @error('uploadIjazah') is-invalid @enderror" type="file"
                                    wire:model.defer="uploadIjazah" accept="application/pdf"
                                    {{ $uploadedData ? 'disabled' : '' }}>
                                <button class="btn btn-primary" type="button" wire:click="saveIjazah"
                                    {{ $uploadedData ? 'disabled' : '' }}>
                                    Upload
                                </button>
                            </div>
                            @if ($uploadedIjazah)
                                <a href="{{ $uploadedIjazah }}" class="badge bg-success mt-2" target="_blank">Periksa
                                    Ijazah Disini</a>
                            @endif
                        </div>
                    </div>
                    {{-- end ijazah --}}

                    {{-- KIP --}}
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label class="mb-2">Scan KIP</label>
                            <small class="text-danger">*Kosongkan jika tidak punya</small>
                            <div class="input-group">
                                <input type="file" class="form-control @error('uploadKip') is-invalid @enderror"
                                    wire:model.defer="uploadKip" accept="application/pdf"
                                    {{ $uploadedData ? 'disabled' : '' }}>
                                <button class="btn btn-primary" type="button" wire:click="saveKip"
                                    {{ $uploadedData ? 'disabled' : '' }}>
                                    Upload
                                </button>
                            </div>
                            @if ($uploadedKip)
                                <a href="{{ $uploadedKip }}" class="badge bg-success mt-2" target="_blank">Periksa KIP
                                    Disini</a>
                            @endif
                        </div>
                    </div>
                    {{-- end kip --}}

                    {{-- KTP --}}
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label class="mb-2">Scan KTP/Akte Kelahiran</label>
                            <small class="text-danger">*</small>
                            <div class="input-group">
                                <input type="file" class="form-control @error('uploadKtp') is-invalid @enderror"
                                    wire:model.defer="uploadKtp" accept="application/pdf"
                                    {{ $uploadedData ? 'disabled' : '' }} required>
                                <button class="btn btn-primary" type="button" wire:click="saveKtp"
                                    {{ $uploadedData ? 'disabled' : '' }}>
                                    Upload
                                </button>
                            </div>
                            @if ($uploadedKtp)
                                <a href="{{ $uploadedKtp }}" class="badge bg-success mt-2" target="_blank">Periksa KTP
                                    Disini</a>
                            @endif
                        </div>
                    </div>
                    {{-- end ktp --}}

                    {{-- KK --}}
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label class="mb-2">Scan Kartu Keluarga</label>
                            <small class="text-danger">*</small>
                            <div class="input-group">
                                <input type="file" class="form-control @error('uploadKk') is-invalid @enderror"
                                    wire:model.defer="uploadKk" accept="application/pdf"
                                    {{ $uploadedData ? 'disabled' : '' }} required>
                                <button class="btn btn-primary" type="button" wire:click="saveKk"
                                    {{ $uploadedData ? 'disabled' : '' }}>
                                    Upload
                                </button>
                            </div>
                            @if ($uploadedKk)
                                <a href="{{ $uploadedKk }}" class="badge bg-success mt-2" target="_blank">Periksa
                                    Kartu Keluarga
                                    Disini</a>
                            @endif
                        </div>
                    </div>
                    {{-- end kk --}}
                </div>
            </div>
        </div>
    </div>
</section>
