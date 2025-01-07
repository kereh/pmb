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
        <livewire:calon-mahasiswa.components.form-pas-foto :user="$this->user" :uploadedPasFoto="$uploadedPasFoto" />
        <livewire:calon-mahasiswa.components.form-dokumen :user="$this->user" :uploadedIjazah="$uploadedIjazah" :uploadedKip="$uploadedKip" />
    </div>
</div>
