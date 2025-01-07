<div>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>
                        Hi, {{ $this->user->nama }}
                    </h3>
                    <p class="text-subtitle text-muted">
                        Selamat datang di aplikasi PMB UNSRIT
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content container">
        <div class="row">
            <section class="section col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="w-100">
                            <p>Segera bergabung ke Group Whatsapp PMB UNSRIT untuk mendapatkan informasi yang lebih
                                lanjut.
                                Anda bisa langsung bergabung lewat <a
                                    href="https://chat.whatsapp.com/KAAux4EZqrnH9pBlwlqg7W" target="_blank">link ini</a>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <section class="section">
            <div class="row">
                {{-- kelengkapan berkas --}}
                <livewire:calon-mahasiswa.components.status-card color="{{ $this->user->data ? 'green' : 'red' }}"
                    icon="iconly-boldFolder" text="kelengkapan Berkas"
                    data="{{ $this->user->data ? 'Lengkap' : 'Belum Lengkap' }}" />

                {{-- status transaksi --}}
                @if (!$this->user->payment)
                    <livewire:calon-mahasiswa.components.status-card color="red" icon="iconly-boldWallet"
                        text="Status Pembayaran" data="Belum Lunas" />
                @else
                    <livewire:calon-mahasiswa.components.status-card
                        color="{{ $this->user->payment->status ? 'green' : 'red' }}" icon="iconly-boldWallet"
                        text="Status Pembayaran" data="{{ $this->user->payment->status ? 'Lunas' : 'Belum' }}" />
                @endif

                {{-- status jurusan pilihan --}}
                <livewire:calon-mahasiswa.components.status-card color="{{ $this->user->data ? 'green' : 'red' }}"
                    icon="iconly-boldPaper" text="Program Studi"
                    data="{{ $this->user->data->program_studi->nama ?? 'Belum Memilih' }}" />

                {{-- status penerimaan --}}
                <livewire:calon-mahasiswa.components.status-card color="red" icon="iconly-boldBookmark"
                    text="Status Penerimaan" data="Tahap Seleksi" />
            </div>
        </section>
    </div>
</div>
