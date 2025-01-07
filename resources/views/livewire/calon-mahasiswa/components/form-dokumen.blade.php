@php
    $err = $errors->all();
@endphp

<div class="card">
    <div class="card-content">
        <div class="card-body">
            <h3 class="card-title">Upload Dokumen</h3>
            <p class="card-subtitle w-100 w-lg-75">Ijazah atau Surat Keterangan Lulus (depan dan belakang) dan kartu KIP
                (depang dan belakang) jika ada. Ukuran file masing-masing maks: 1MB dengan format PDF.
            </p>
            @if (!empty($err))
                @foreach ($err as $msg)
                    <div class="alert alert-danger alert-dismissible show fade mt-3">
                        <i class="bi bi-file-excel"></i>
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
            <section class="form">
                <div class="row w-full d-flex row-gap-4 flex-columns mt-4">

                    {{-- ijazah --}}
                    <div class="col-12 w-100 w-lg-75">
                        <div class="form-group">
                            <p>Ijazah atau Surat Keterangan Lulus</p>
                            <div class="input-group">
                                <input class="form-control @error('uploadIjazah') is-invalid @enderror" type="file"
                                    wire:model.blur="uploadIjazah">
                                <button class="btn btn-primary" type="button" wire:click="saveIjazah">
                                    Upload
                                </button>
                            </div>
                            @if ($uploadedIjazah)
                                <p class="mt-3" wire:transition>Ijazah yang sudah diupload :
                                    <a href="{{ $uploadedIjazah }}" target="_blank">Lihat
                                        Disini</a>
                                </p>
                            @endif
                        </div>
                    </div>
                    {{-- end ijazah --}}

                    {{-- KIP --}}
                    <div class="col-12 w-100 w-lg-75">
                        <div class="form-group">
                            <p>Kartu KIP (kosongkan jika tidak punya)</p>
                            <div class="input-group">
                                <input type="file" class="form-control @error('uploadKip') is-invalid @enderror"
                                    wire:model.blur="uploadKip">
                                <button class="btn btn-primary" type="button" wire:click="saveKip">
                                    Upload
                                </button>
                            </div>
                            @if ($uploadedKip)
                                <p class="mt-3" wire:transition>Kartu KIP yang sudah diupload :
                                    <a href="{{ $uploadedKip }}" target="_blank">Lihat
                                        Disini</a>
                                </p>
                            @endif
                        </div>
                    </div>
                    {{-- end kip --}}

                </div>
            </section>
        </div>
    </div>
</div>
