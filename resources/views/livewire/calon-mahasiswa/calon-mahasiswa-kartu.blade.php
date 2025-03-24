<div>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>
                        Cetak Kartu Ujian
                    </h3>
                </div>
            </div>
        </div>
        <div class="page-subtitle w-100 w-md-75">
            <p class="text-subtitle text-muted">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora quis ea officiis vero atque delectus facere. Unde quasi harum nostrum.
            </p>
        </div>
        @if ($this->status())
            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i>
                Anda Bisa Cetak Kartu
            </div>
        @endif
    </div>
</div>
