<?php

use App\Livewire\CalonMahasiswa\CalonMahasiswaKartuCetak;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(CalonMahasiswaKartuCetak::class)
        ->assertStatus(200);
});
