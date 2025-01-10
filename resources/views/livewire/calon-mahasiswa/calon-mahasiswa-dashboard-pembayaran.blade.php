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
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="card-title">Detail Pembayaran</h4>
                    <p class="text-subtitle">Dibawah ini adalah detail pembayaran. Bukti pembayaran akan dikirim ke email
                        pendaftar</p>
                    @if ($status = Session::get('statusPayment'))
                        <div class="alert {{ $status['type'] }} alert-dismissible show fade">
                            <i class="bi {{ $status['icon'] }}"></i>
                            {{ $status['message'] }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @elseif ($this->user->payment->status)
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle"></i>
                            Pembayaran Berhasil! Silahkan cek email anda <strong>{{ $this->user->email }}</strong>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-3">
                            <tbody>
                                <tr>
                                    <td>Order ID</td>
                                    <td>:</td>
                                    <td>{{ $this->user->payment->order_id }}</td>
                                </tr>
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
                                    <td>
                                        <span
                                            class="badge {{ $this->user->payment->status ? 'bg-success' : 'bg-danger' }}">
                                            {{ $this->user->payment->status ? 'Lunas' : 'Belum Lunas' }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @if (!$this->user->payment->status)
                        <div class="container row d-flex justify-content-start">
                            <button class="btn btn-primary w-auto" id="pay-button">Lanjutkan</button>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="alert shadow alert-danger">Anda harus melengkapi data terlebih dahulu sebelum melakukan
                pembayaran. Untuk melengkapi data klik <a href="{{ route('calon_mahasiswa.data') }}"
                    wire:navigate>DISINI</a></div>
        @endif
    </div>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            const payButton = document.getElementById('pay-button');
            payButton.disabled = true;

            snap.pay('{{ $this->user->payment->snap_token ?? '' }}', {
                onSuccess: () => {
                    window.location.href =
                        "{{ route('calon_mahasiswa.pembayaran.verify', $this->user->payment->order_id ?? '') }}";
                },
            });
        };
    </script>
</div>
