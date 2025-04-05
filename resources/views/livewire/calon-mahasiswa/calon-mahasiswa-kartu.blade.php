<div>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>
                        Cetak Kartu Ujian
                    </h3>
                </div>
            </div>
        </div>
        <div class="page-subtitle w-100 w-md-75">
            <p class="text-subtitle text-muted">
                Halaman cetak kartu ujian.
            </p>
        </div>
    </div>
    <div class="page-content">
        @if ($user->payments->status)
            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i>
                Anda Bisa Cetak Kartu
            </div>
            <section class="section">
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-center align-items-center flex-column">
                                    <h4 class="mt-3">{{$user->nama}}</h4>
                                    <p class="text-small text-center">ID Ujian <span class="d-block">{{$user->id}}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <form wire:submit.prevent="cetak">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Pilihan 1</label>
                                        <p>{{ $user->data->program_studi[0]->nama }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="form-label">Pilihan 2</label>
                                        <p>{{ $user->data->program_studi[1]->nama }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="form-label">Lokasi</label>
                                        <p>Kampus UNSRIT</p>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Cetak Kartu</button>
                                        <a role="button" href="https://www.google.com" target="_blank" class="btn btn-secondary">Website Ujian</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @else
            <div class="alert alert-danger">
                <i class="bi bi-x-circle"></i>
                Anda Harus Melengkapi Data dan Melunasi Pembayaran Sebelum Mencetak Kartu Ujian
            </div>
        @endif
    </div>
</div>
