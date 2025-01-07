@php
    $fetch = $this->fetch();
    $user = $fetch['user'];
    $programStudi = $fetch['program_studi'];
    $biayaPendaftaran = $fetch['biaya_pendaftaran'];
@endphp

<div>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>
                        Form Data
                    </h3>
                </div>
            </div>
        </div>
        <div class="page-subtitle w-100 w-md-75">
            <p class="text-subtitle text-muted">
                Berikut adalah form pengisian data calon mahasiswa baru. Harap mengisi data yang valid dan
                sesuai ketentuan yang ditetapkan panitia
            </p>
        </div>
    </div>
    <div class="page-content">
        <livewire:calon-mahasiswa.components.form-pas-foto :user="$user" :uploadedPasFoto="$uploadedPasFoto" :submited="$uploadedData" />
        <livewire:calon-mahasiswa.components.form-dokumen :user="$user" :uploadedIjazah="$uploadedIjazah" :uploadedKip="$uploadedKip"
            :submited="$uploadedData" />
        <livewire:calon-mahasiswa.components.form-data :user="$user" :uploadedPasFoto="$uploadedPasFoto" :uploadedIjazah="$uploadedIjazah"
            :uploadedKip="$uploadedKip" :programStudi="$programStudi" :biayaPendaftaran="$biayaPendaftaran" :submited="$uploadedData" />
    </div>
</div>
