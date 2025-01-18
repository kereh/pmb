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
                    <div class="col-12 w-100 w-lg-75">
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
                                <p class="mt-3">Ijazah yang sudah diupload :
                                    <a href="{{ $uploadedIjazah }}" class="badge bg-success" target="_blank">Lihat
                                        Disini</a>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- end ijazah --}}

                {{-- KIP --}}
                <div class="col-12 w-100 w-lg-75">
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
                            <p class="mt-3">KIP yang sudah diupload :
                                <a href="{{ $uploadedKip }}" class="badge bg-success" target="_blank">Lihat
                                    Disini</a>
                            </p>
                        @endif
                    </div>
                </div>
                {{-- end kip --}}

                {{-- KTP --}}
                <div class="col-12 w-100 w-lg-75">
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
                            <p class="mt-3">KTP yang sudah diupload :
                                <a href="{{ $uploadedKtp }}" class="badge bg-success" target="_blank">Lihat
                                    Disini</a>
                            </p>
                        @endif
                    </div>
                </div>
                {{-- end ktp --}}

                {{-- KK --}}
                <div class="col-12 w-100 w-lg-75">
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
                            <p class="mt-3">Kartu Keluarga yang sudah diupload :
                                <a href="{{ $uploadedKk }}" class="badge bg-success" target="_blank">Lihat
                                    Disini</a>
                            </p>
                        @endif
                    </div>
                </div>
                {{-- end kk --}}

            </div>
        </div>
    </div>
</section>
