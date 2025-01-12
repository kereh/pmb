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
                                    {{ $calon->data->program_studi->nama }}
                                @else
                                    <span class="badge bg-danger">Data Belum Lengkap</span>
                                @endisset
                            </td>
                            <td>
                                <span
                                    class="badge {{ $calon->seleksi->id == 1 ? 'bg-warning' : ($calon->seleksi->id == 2 ? 'bg-danger' : 'bg-success') }}">{{ $calon->seleksi->status }}</span>
                            </td>
                            <td>{{ $calon->payment->status ?? 'belum lengkap' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
