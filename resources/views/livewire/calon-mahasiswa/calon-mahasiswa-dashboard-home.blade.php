@php
    $user = $this->user();
@endphp

<div>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>
                        Hi, {{ $user->nama }}
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
                <div class="card shadow">
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
                <livewire:calon-mahasiswa.components.status-card route="calon_mahasiswa.data"
                    color="{{ $user->data ? 'green' : 'red' }}" icon="iconly-boldFolder" text="kelengkapan Berkas"
                    data="{{ $user->data ? 'Lengkap' : 'Belum Lengkap' }}" />

                {{-- status transaksi --}}
                @if (!$user->payment)
                    <livewire:calon-mahasiswa.components.status-card route="calon_mahasiswa.pembayaran" color="red"
                        icon="iconly-boldWallet" text="Status Pembayaran" data="Belum Lunas" />
                @else
                    <livewire:calon-mahasiswa.components.status-card route="calon_mahasiswa.pembayaran"
                        color="{{ $user->payment->status ? 'green' : 'red' }}" icon="iconly-boldWallet"
                        text="Status Pembayaran" data="{{ $user->payment->status ? 'Lunas' : 'Belum Lunas' }}" />
                @endif

                {{-- status jurusan pilihan --}}
                <livewire:calon-mahasiswa.components.status-card route="calon_mahasiswa"
                    color="{{ $user->data ? 'green' : 'red' }}" icon="iconly-boldWork" text="Program Studi"
                    data="{{ $user->data->program_studi->nama ?? 'Belum Memilih' }}" />

                {{-- status penerimaan --}}
                <livewire:calon-mahasiswa.components.status-card route="calon_mahasiswa"
                    color="{{ $user->seleksi->status == 'Diterima' ? 'green' : 'red' }}" icon="iconly-boldInfo-Circle"
                    text="Status Penerimaan" data="{{ $user->seleksi->status }}" />
            </div>
        </section>
    </div>
</div>
