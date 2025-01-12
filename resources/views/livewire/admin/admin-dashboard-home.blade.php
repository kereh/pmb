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
                        Selamat datang di Dashboard PMB UNSRIT
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="row">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptate, tempora!
        </div>
    </div>
</div>
