<div class="col-12 col-md-4" role="button">
    <a href="{{ route($route) }}" wire:navigate>
        <div class="card w-full shadow">
            <div class="card-body px-4 py-4-5">
                <div class="row row-gap-3 text-center">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-center">
                        <div class="stats-icon {{ $color }} mb-2">
                            <i class="{{ $icon }}"></i>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 text-center">
                        <h6 class="text-muted font-semibold">{{ $text }}</h6>
                        <h6 class="font-extrabold mb-0">{{ $data }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
