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
                            <i class="bi bi-check-circle"></i>
                            {{ $status['message'] }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @elseif ($this->user->payments->status)
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle"></i>
                            Pembayaran Berhasil! Silahkan cek email anda <strong>{{ $this->user->email }}</strong>
                        </div>
                    @elseif ($isExpired)
                        <div class="alert alert-warning">
                            <i class="bi bi-x-circle"></i>
                            ID Pembayaran kadaluarsa! Silahkan perbarui!</strong>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-3">
                            <tbody>
                                <tr>
                                    <td>ID Pembayaran</td>
                                    <td>:</td>
                                    <td>{{ $this->user->payments->order_id }}</td>
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
                                            class="badge {{ $this->user->payments->status ? 'bg-success' : ($isExpired ? 'bg-warning' : 'bg-danger') }}">
                                            {{ $this->user->payments->status ? 'Lunas' : ($isExpired ? 'Expired' : 'Belum Lunas') }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @if (!$this->user->payments->status)
                        @if ($isExpired)
                            <div class="container row d-flex justify-content-end">
                                <button class="btn btn-warning w-auto" wire:click="update" wire:target="update"
                                    wire:loading.attr="disabled">
                                    <span wire:loading.remove wire:target="update">
                                        Perbarui Pembayaran
                                    </span>
                                    <span wire:loading wire:target="update">
                                        Mohon Tunggu...
                                    </span>
                                </button>
                            </div>
                        @else
                            <div class="container row d-flex justify-content-end">
                                <button class="btn btn-primary w-auto" id="pay-button">Lanjutkan</button>
                            </div>
                        @endif
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
        document.addEventListener('livewire:navigated', function() {
            const payButton = document.getElementById('pay-button');
            if (payButton) {
                document.getElementById('pay-button').onclick = function() {
                    const payButton = document.getElementById('pay-button');
                    payButton.disabled = true;

                    snap.pay('{{ $this->user->payments->snap_token ?? '' }}', {
                        onSuccess: () => {
                            window.location.href =
                                "{{ route('calon_mahasiswa.pembayaran.verify', $this->user->payments->order_id ?? '') }}";
                        },
                        onPending: () => {
                            window.location.href =
                                "{{ route('calon_mahasiswa.pembayaran') }}";
                        },
                    });
                };
            }
        });
    </script>
</div>
