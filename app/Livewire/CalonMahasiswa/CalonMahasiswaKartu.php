<?php

namespace App\Livewire\CalonMahasiswa;

use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CalonMahasiswaKartu extends Component {
    #[Layout('components.layouts.layout-calon-mahasiswa')]

    public $title = "Cetak Kartu Ujian";
    public $user;

    public function mount() {
        $this->user = $this->user();
    }

    public function cetak() {
        // $this->user->data->pas_foto_base64 = 'data:image/jpeg;base64,' . 
        //             base64_encode(file_get_contents($this->user->data->pas_foto));

        $pdf = Pdf::setOptions([
            'defaultFont' => 'DejaVu Sans',
            'margin_top' => 0,
            'margin_right' => 0,
            'margin_bottom' => 0,
            'margin_left' => 0,
        ])->loadView('components.layouts.layout-kartu', [
            "user" => $this->user
        ]);

        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption('enable_php', true);
        $pdf->setOption('isHtml5ParserEnabled', true);
        $pdf->setOption('isRemoteEnabled', true);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, "{$this->user->nama}.pdf");
    }

    #[Computed()]
    public function user() {
        return Auth::user()->load(['data', 'payments']);
    }
}