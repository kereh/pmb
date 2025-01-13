<div class="card">
    <div class="card-header">
        <h5 class="card-title">
            jQuery Datatable
        </h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="table1">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Program Studi</th>
                        <th>Status Seleksi</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->list as $calon)
                        <tr>
                            <td class="avatar avatar-xl">
                                @isset($calon->data->pas_foto)
                                    <img src="{{ $calon->data->pas_foto }}">
                                @else
                                    <img src="{{ asset('assets/compiled/jpg/1.jpg') }}">
                                @endisset
                            </td>
                            <td>{{ strtoupper($calon->nama) }}</td>
                            <td>
                                @isset($calon->data->program_studi->nama)
                                    <span>{{ $calon->data->program_studi->nama }}</span>
                                @else
                                    <span>Data Belum Lengkap</span>
                                @endisset
                            </td>
                            <td>
                                <span>{{ $calon->seleksi->status }}</span>
                            </td>
                            <td>
                                @if (!$calon->payment ?? !$calon->payment->status)
                                    <span>Belum Lunas</span>
                                @else
                                    <span>Lunas</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-danger">Hapus</button>
                                <button class="btn btn-info">Detail</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
