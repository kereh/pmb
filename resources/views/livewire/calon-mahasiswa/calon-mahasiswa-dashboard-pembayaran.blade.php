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
        <section class="section">
            @if ($this->user->data)
                <div class="d-flex w-100 justify-content-center">
                    <div class="card shadow w-100 w-md-50">
                        <div class="card-header">
                            <h4 class="card-title">Detail Pembayaran</h4>
                            <p class="text-subtitle">Dibawah ini adalah detail pembayaran.</p>
                        </div>
                        <div class="card-body">
                            <div class="row col-12 table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <td>Nama Pendaftar</td>
                                            <td>:</td>
                                            <td>{{ $this->user->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email Pendaftar</td>
                                            <td>:</td>
                                            <td>{{ $this->user->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kontak</td>
                                            <td>:</td>
                                            <td>{{ $this->user->data->nomor_hp }}</td>
                                        </tr>
                                        <tr>
                                            <td>Program Studi</td>
                                            <td>:</td>
                                            <td>{{ $this->user->data->program_studi->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td>Biaya Pendaftaran</td>
                                            <td>:</td>
                                            <td>Rp.
                                                {{ number_format($this->biaya_pendaftaran->biaya, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Status Pembayaran</td>
                                            <td>:</td>
                                            <td>{{ $this->user->payment->status ?? $this->user->payment }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row mt-5 d-flex justify-content-end">
                                    <button class="btn btn-primary w-auto">Lanjutkan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
            @endif
        </section>
    </div>
</div>
</div>
