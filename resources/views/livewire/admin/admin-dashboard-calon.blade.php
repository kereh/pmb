<div>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>
                        Management Calon Mahasiswa
                    </h3>
                    <p class="text-subtitle text-muted">
                        Pada halam ini anda bisa melihat, menambahkan, mengubah dan
                        menghapus calon mahasiswa beserta datanya
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="row">
            <livewire:admin.components.calon.calon-table />
        </div>
    </div>
</div>
