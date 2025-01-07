<div class="card">
    <div class="card-content">
        <div class="card-body">
            <h3 class="card-title">Form Pengisian Data</h3>
            <p class="card-subtitle w-100 w-lg-75">Silhakan masukan data yang valid untuk melanjutkan pendaftaran</p>
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible show fade mt-3">
                    <h5>Terjadi masalah pada data yang diinput</h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
            <form class="form" wire:submit="store">
                <div class="row d-flex flex-columns flex-lg-row align-items-center mt-4">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label @error('nik') is-invalid @enderror">NIK</label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                placeholder="{{ $user->data ? $user->data->nik : 'Nomor Induk Kependudukan' }}"
                                wire:model.blur="nik" {{ $submited ? 'disabled' : '' }}>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label @error('nisn') is-invalid @enderror">NISN</label>
                            <input type="text" class="form-control @error('nisn') is-invalid @enderror"
                                placeholder="{{ $user->data ? $user->data->nisn : 'Nomor Induk Siswa Nasional' }}"
                                wire:model.blur="nisn" {{ $submited ? 'disabled' : '' }}>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" value="{{ $user->nama }}"
                                wire:model.blur="nama" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label @error('nama_ibu_kandung') is-invalid @enderror">Nama
                                Ibu Kandung</label>
                            <input
                                type="text"class="form-control @error('nama_ibu_kandung') is-invalid @enderror"
                                placeholder="{{ $user->data ? $user->data->nama_ibu_kandung : '' }}"
                                wire:model.blur="nama_ibu_kandung" {{ $submited ? 'disabled' : '' }}>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label @error('tanggal_lahir') is-invalid @enderror">Tanggal
                                Lahir</label>
                            <input type="text"
                                class="form-control mb-3 flatpickr-no-config flatpickr-input @error('tanggal_lahir') is-invalid @enderror"
                                readonly="readonly" wire:model.blur="tanggal_lahir"
                                placeholder="{{ $user->data ? $user->data->tanggal_lahir : 'Masukan Tanggal Lahir' }}"
                                {{ $submited ? 'disabled' : '' }}>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label @error('tempat_lahir') is-invalid @enderror">Tempat
                                Lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                placeholder="{{ $user->data ? $user->data->tempat_lahir : '' }}"
                                wire:model.blur="tempat_lahir" {{ $submited ? 'disabled' : '' }}>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group mb-3">
                            <label class="form-label @error('alamat') is-invalid @enderror">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror"
                                placeholder="{{ $user->data ? $user->data->alamat : '' }}" rows="3" wire:model.blur="alamat"
                                {{ $submited ? 'disabled' : '' }}></textarea>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label @error('nomor_hp') is-invalid @enderror">Nomor
                                Handphone</label>
                            <input type="text" class="form-control @error('nomor_hp') is-invalid @enderror"
                                wire:model.blur="nomor_hp"
                                placeholder="{{ $user->data ? $user->data->nomor_hp : '' }}"
                                {{ $submited ? 'disabled' : '' }}>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label @error('jenis_kelamin') is-invalid @enderror">Jenis
                                Kelamin</label>
                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                wire:change="changeJenisKelaminSelected($event.target.value)"
                                {{ $submited ? 'disabled' : '' }}>
                                <option selected>
                                    {{ $user->data ? $user->data->jenis_kelamin : 'Pilih Jenis Kelamin' }}
                                </option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label @error('pendidikan_terakhir') is-invalid @enderror">Pendidikan
                                Terakhir</label>
                            <select class="form-select @error('pendidikan_terakhir') is-invalid @enderror"
                                wire:change="changePendidikanTerakhirSelected($event.target.value)"
                                {{ $submited ? 'disabled' : '' }}>
                                <option selected>
                                    {{ $user->data ? $user->data->pendidikan_terakhir : 'Pilih Jenis Kelamin' }}
                                <option value="SMA">Sekolah Menengah Atas (SMA)</option>
                                <option value="SMK">Sekolah Menengah Kejuruan (SMK)</option>
                                <option value="MA">Madrasah Aliyah (MA)</option>
                                <option value="MAK">Madrasah Aliyah Kejuruan (MAK)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label
                                class="form-label @error('kewarganegaraan') is-invalid @enderror">Kewarganegaraan</label>
                            <select class="form-select @error('kewarganegaraan') is-invalid @enderror"
                                wire:change="changeKewargaNegaraanSelected($event.target.value)"
                                {{ $submited ? 'disabled' : '' }}>
                                <option selected>
                                    {{ $user->data ? $user->data->kewarganegaraan : 'Pilih Kewarganegaraan' }}
                                <option value="WNI">Warga Negara Indonesia</option>
                                <option value="WNA">Warga Negara Asing</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label @error('agama') is-invalid @enderror">Agama</label>
                            <select class="form-select @error('agama') is-invalid @enderror"
                                wire:change="changeAgamaSelected($event.target.value)"
                                {{ $submited ? 'disabled' : '' }}>
                                <option selected>{{ $user->data ? $user->data->agama : 'Pilih Agama' }}
                                <option value="Kristen Protestan">Kristen Protestan</option>
                                <option value="Kristen Katolik">Kristen Katolik</option>
                                <option value="Islam">Islam</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label @error('program_studi') is-invalid @enderror">Pilih
                                Program Studi</label>
                            <select class="form-select @error('program_studi') is-invalid @enderror"
                                wire:change="changeProgramStudiSelected($event.target.value)"
                                {{ $submited ? 'disabled' : '' }}>
                                <option selected>
                                    {{ $user->data ? $user->data->program_studi->nama : 'Pilih Program Studi' }}
                                </option>
                                @foreach ($programStudi as $item)
                                    <option value="{{ $item->id }}" wire:key="{{ $item->id }}">
                                        {{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Biaya Pendaftaran</label>
                            <input type="text" class="form-control"
                                value="Rp. {{ number_format($biayaPendaftaran->biaya), 0, ',', '.' }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="row d-flex flex-columns flex-lg-row align-items-center row-gap-5">
                    <div class="col-12 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary me-1 mb-1"
                            {{ $submited ? 'disabled' : '' }} wire:confirm="">Submit</button>
                        <button type="reset" class="btn btn-danger me-1 mb-1"
                            {{ $submited ? 'disabled' : '' }}>Reset</button>
                    </div>
                </div>
                <div class="row col-12">
                    @if ($status = Session::get('status'))
                        <div class="alert {{ $status['type'] }} alert-dismissible show fade mt-3">
                            <i class="bi bi-check-circle"></i>
                            {{ $status['message'] }} Lanjutkan ke <a href="{{ route('calon_mahasiswa') }}"
                                class="underline">PEMBAYARAN</a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </form>
    </div>
</div>
