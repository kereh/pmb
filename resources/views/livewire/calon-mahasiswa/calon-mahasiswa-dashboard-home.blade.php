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
                                Anda bisa langsung bergabung dengan <a
                                    href="https://chat.whatsapp.com/KAAux4EZqrnH9pBlwlqg7W" target="_blank">click
                                    disini</a>
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
                @if (!$user->payments)
                    <livewire:calon-mahasiswa.components.status-card route="calon_mahasiswa.pembayaran" color="red"
                        icon="iconly-boldWallet" text="Status Pembayaran" data="Belum Lunas" />
                @else
                    <livewire:calon-mahasiswa.components.status-card route="calon_mahasiswa.pembayaran"
                        color="{{ $user->payments->status ? 'green' : 'red' }}" icon="iconly-boldWallet"
                        text="Status Pembayaran" data="{{ $user->payments->status ? 'Lunas' : 'Belum Lunas' }}" />
                @endif

                {{-- status penerimaan --}}
                <livewire:calon-mahasiswa.components.status-card route="calon_mahasiswa"
                    color="{{ $user->seleksi->status == 'Lulus' ? 'green' : 'red' }}" icon="iconly-boldInfo-Circle"
                    text="Status Penerimaan" data="{{ $user->seleksi->status }}" />

            </div>

            <div class="row">
                {{-- status jurusan pilihan --}}
                <livewire:calon-mahasiswa.components.status-card route="calon_mahasiswa"
                    color="{{ $user->data ? 'green' : 'red' }}" icon="iconly-boldWork" text="Program Studi 1"
                    data="{{ $user->data->program_studi[0]->nama ?? 'Belum Memilih' }}" />

                <livewire:calon-mahasiswa.components.status-card route="calon_mahasiswa"
                    color="{{ $user->data ? 'green' : 'red' }}" icon="iconly-boldWork" text="Program Studi 2"
                    data="{{ $user->data->program_studi[1]->nama ?? 'Belum Memilih' }}" />
            </div>
        </section>
    </div>
</div>
