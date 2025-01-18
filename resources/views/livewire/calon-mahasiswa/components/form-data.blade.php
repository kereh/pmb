<section class="section">
    <div class="card shadow">
        <div class="card-header">
            <h4 class="card-title">Form Pengisian Data</h4>
            <p class="card-subtitle w-100 w-lg-75">Silhakan masukan data yang valid untuk melanjutkan pendaftaran</p>
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible show fade mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
    </div>
    <div class="card-body">
        <form class="form" wire:submit.prevent="store">
            <div class="row d-flex flex-columns flex-lg-row align-items-center mt-4">
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" value="{{ $user->nama }}"
                            wire:model.defer="nama" disabled>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label class="form-label @error('jurusan') is-invalid @enderror">Jurusan Saat
                            Sekolah</label>
                        <small class="text-danger">* Jangan disingkat</small>
                        <input type="text"class="form-control @error('jurusan') is-invalid @enderror"
                            placeholder="{{ $user->data ? $user->data->jurusan : '' }}" wire:model.defer="jurusan"
                            {{ $user->data ? 'disabled' : '' }} @required(true)>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label class="form-label @error('tanggal_lahir') is-invalid @enderror">Tanggal
                            Lahir</label>
                        <span class="text-danger">*</span>
                        <input type="text"
                            class="form-control mb-3 flatpickr-no-config flatpickr-input @error('tanggal_lahir') is-invalid @enderror"
                            readonly="readonly" wire:model.defer="tanggal_lahir"
                            placeholder="{{ $user->data ? $user->data->tanggal_lahir : 'Masukan Tanggal Lahir' }}"
                            {{ $user->data ? 'disabled' : '' }} @required(true)>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label class="form-label @error('no_telp_pribadi') is-invalid @enderror">Nomor
                            Telepon Pribadi</label>
                        <span class="text-danger">*</span>
                        <input type="text" class="form-control @error('no_telp_pribadi') is-invalid @enderror"
                            placeholder="{{ $user->data ? $user->data->no_telp_pribadi : '' }}"
                            wire:model.defer="no_telp_pribadi" {{ $user->data ? 'disabled' : '' }}
                            @required(true)>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label class="form-label @error('no_telp_orang_tua') is-invalid @enderror">Nomor
                            Telepon Orang Tua</label>
                        <span class="text-danger">*</span>
                        <input type="text" class="form-control @error('no_telp_orang_tua') is-invalid @enderror"
                            placeholder="{{ $user->data ? $user->data->no_telp_orang_tua : '' }}"
                            wire:model.defer="no_telp_orang_tua" {{ $user->data ? 'disabled' : '' }}
                            @required(true)>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group mb-3">
                        <label class="form-label @error('asal_daerah_provinsi') is-invalid @enderror">Asal
                            Daerah
                            Provinsi</label>
                        <span class="text-danger">*</span>
                        <input type="text"
                            class="form-control @error('asal_daerah_provinsi') is-invalid @enderror"
                            placeholder="{{ $user->data ? $user->data->asal_daerah_provinsi : '' }}"
                            wire:model.defer="asal_daerah_provinsi" {{ $user->data ? 'disabled' : '' }}
                            @required(true)>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group mb-3">
                        <label class="form-label @error('asal_daerah_kabupaten_kota') is-invalid @enderror">Asal
                            Daerah
                            Kabupaten/Kota</label>
                        <span class="text-danger">*</span>
                        <input type="text"
                            class="form-control @error('asal_daerah_kabupaten_kota') is-invalid @enderror"
                            placeholder="{{ $user->data ? $user->data->asal_daerah_kabupaten_kota : '' }}"
                            wire:model.defer="asal_daerah_kabupaten_kota" {{ $user->data ? 'disabled' : '' }}
                            @required(true)>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group mb-3">
                        <label class="form-label @error('asal_sekolah') is-invalid @enderror">Asal
                            Sekolah</label>
                        <span class="text-danger">*</span>
                        <input type="text" class="form-control @error('asal_sekolah') is-invalid @enderror"
                            placeholder="{{ $user->data ? $user->data->asal_sekolah : '' }}"
                            wire:model.defer="asal_sekolah" {{ $user->data ? 'disabled' : '' }} @required(true)>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group mb-3">
                        <label class="form-label @error('rekomendasi') is-invalid @enderror">Siapa Yang
                            Merekomendasikan UNSRIT</label>
                        <input type="text" class="form-control @error('rekomendasi') is-invalid @enderror"
                            placeholder="{{ $user->data ? $user->data->rekomendasi : '' }}"
                            wire:model.defer="rekomendasi" {{ $user->data ? 'disabled' : '' }}>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label class="form-label @error('jenis_kelamin') is-invalid @enderror">Jenis
                            Kelamin</label>
                        <span class="text-danger">*</span>
                        <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                            wire:change="changeJenisKelaminSelected($event.target.value)"
                            {{ $user->data ? 'disabled' : '' }} @required(true)>
                            <option selected>
                                {{ $user->data ? $user->data->jenis_kelamin : 'Pilih Jenis Kelamin' }}
                            </option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label class="form-label @error('agama') is-invalid @enderror">Agama</label>
                        <span class="text-danger">*</span>
                        <select class="form-select @error('agama') is-invalid @enderror"
                            wire:change="changeAgamaSelected($event.target.value)"
                            {{ $user->data ? 'disabled' : '' }} @required(true)>
                            <option selected>{{ $user->data ? $user->data->agama : 'Pilih Agama' }}
                            <option value="Kristen Protestan">Kristen Protestan</option>
                            <option value="Kristen Katolik">Kristen Katolik</option>
                            <option value="Islam">Islam</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label class="form-label @error('program_studi_pertama') is-invalid @enderror">Pilih
                            Program Studi 1</label>
                        <span class="text-danger">*</span>
                        <select class="form-select @error('program_studi_pertama') is-invalid @enderror"
                            wire:change="changeProgramStudiPertamaSelected($event.target.value)"
                            {{ $user->data ? 'disabled' : '' }} @required(true)>
                            <option selected>
                                {{ $user->data ? $user->data->program_studi_pertama->nama : 'Pilih Program Studi 1' }}
                            </option>
                            @foreach ($programStudi as $item)
                                <option value="{{ $item->id }}" wire:key="{{ $item->id }}">
                                    {{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label class="form-label @error('program_studi_kedua') is-invalid @enderror">Pilih
                            Program Studi 2</label>
                        <span class="text-danger">*</span>
                        <select class="form-select @error('program_studi_kedua') is-invalid @enderror"
                            wire:change="changeProgramStudiKeduaSelected($event.target.value)"
                            {{ $user->data ? 'disabled' : '' }} @required(true)>
                            <option selected>
                                {{ $user->data ? $user->data->program_studi_kedua->nama : 'Pilih Program Studi' }}
                            </option>
                            @foreach ($programStudi as $item)
                                <option value="{{ $item->id }}" wire:key="{{ $item->id }}">
                                    {{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label class="form-label">Biaya Pendaftaran</label>
                        <input type="text" class="form-control"
                            value="Rp. {{ number_format($biayaPendaftaran->biaya), 0, ',', '.' }}" disabled>
                    </div>
                </div>
            </div>
            @if ($status = Session::get('status'))
                <div class="row col-12">
                    <div class="alert {{ $status['type'] }} alert-dismissible show fade mt-3">
                        <i class="bi bi-check-circle"></i>
                        {{ $status['message'] }} Lanjutkan ke <a href="{{ route('calon_mahasiswa.pembayaran') }}"
                            class="underline">PEMBAYARAN</a>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                </div>
            @endif
            <div class="row d-flex flex-columns flex-lg-row align-items-center row-gap-5">
                <div class="col-12 d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary me-1 mb-1" {{ $user->data ? 'disabled' : '' }}
                        wire:target="store" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="store">Submit</span>
                        <span wire:loading wire:target="store">Menyimpan data...</span>
                    </button>
                    <button type="reset" class="btn btn-danger me-1 mb-1" {{ $user->data ? 'disabled' : '' }}>
                        Reset
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</section>
