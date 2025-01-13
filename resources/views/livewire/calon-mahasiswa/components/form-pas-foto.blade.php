<section class="section">
    <div class="card shadow">
        <div class="card-header">
            <h4 class="card-title">Upload Pas Foto</h4>
            <p class="card-subtitle w-100 w-lg-75">Pas foto ukuran
                3x4 dengan latar warna merah atau biru, menggunakan kemeja, maks ukuran file:
                1MB dengan format PNG.
            </p>
            @error('pasFotoUpload')
                <div class="alert alert-danger alert-dismissible show fade mt-3">
                    <i class="bi bi-file-excel"></i>
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
            @if ($status = Session::get('statusPasFoto'))
                <div class="alert {{ $status['type'] }} alert-dismissible show fade mt-3">
                    <i class="bi bi-check-circle"></i>
                    {{ $status['message'] }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="card-body">
            <section class="form">
                <div class="row d-flex row-gap-4 flex-columns align-items-center">
                    <div class="col-12 text-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <div class="position-relative d-flex justify-content-center align-items-center h-full w-full"
                                    wire:transition>
                                    @if ($pasFotoPreview || $uploadedPasFoto)
                                        <img class="rounded-4 w-full h-full object-fit-fill shadow"
                                            style="width: 175px; height: 200px;"
                                            src="{{ $pasFotoPreview ?? $uploadedPasFoto }}" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group w-100 d-flex justify-content-center">
                            <input class="form-control w-100 w-md-50" type="file" wire:model="pasFotoUpload"
                                {{ $uploadedPasFoto ? 'disabled' : '' }}>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end mt-4">
                    <button wire:click="save" class="btn btn-primary me-1 mb-1"
                        {{ $uploadedPasFoto ? 'disabled' : '' }}>Submit</button>
                    <button type="reset" class="btn btn-danger me-1 mb-1"
                        {{ $uploadedPasFoto ? 'disabled' : '' }}>Reset</button>
                </div>
            </section>
        </div>
    </div>
</section>
