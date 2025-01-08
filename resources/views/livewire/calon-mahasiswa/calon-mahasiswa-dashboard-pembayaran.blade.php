<div>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>
                        Pembayaran
                    </h3>
                    <p class="text-subtitle text-muted">
                        Halaman pembayaran biaya pendaftaran calon mahasiswa baru.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        @if ($this->user->data)
            <p>byar sekarang</p>
        @else
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="card-title">Peringatan</h4>
                </div>
                <div class="card-body">
                    <p class="text-danger">Anda belum mengisi data! Silahkan lengkapi data <a
                            href="{{ route('calon_mahasiswa.data') }}" wire:navigate>disini</a> sebelum melakukan
                        pembayaran</p>
                </div>
            </div>
    </div>
    @endif
</div>
</div>
