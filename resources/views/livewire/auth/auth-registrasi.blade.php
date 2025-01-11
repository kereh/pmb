<div>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <h1 class="auth-title">Registrasi</h1>
                <p class="auth-subtitle mb-5">Silahkan masukan data anda untuk melakukan registrasi.</p>
                <form wire:submit.prevent="store">
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl @error('email') is-invalid @enderror"
                            placeholder="Email" wire:model="email">
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        @error('email')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl @error('nama') is-invalid @enderror"
                            placeholder="Nama Lengkap" wire:model="nama">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                        @error('nama')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text"
                            class="form-control form-control-xl @error('username') is-invalid @enderror"
                            placeholder="Username" wire:model="username">
                        <div class="form-control-icon">
                            <i class="bi bi-file-person"></i>
                        </div>
                        @error('username')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password"
                            class="form-control form-control-xl @error('password') is-invalid @enderror"
                            placeholder="Password" wire:model="password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" placeholder="Confirm Password"
                            wire:model="password_confirmation">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <button class="btn btn-success btn-block btn-lg shadow-lg mt-5" type="submit"
                        wire:loading.attr="disabled" wire:target="store">
                        <span wire:loading.remove wire:target="store">Registrasi</span>
                        <span wire:loading wire:target="store">Membuat akun...</span>
                    </button>
                </form>
                <div class="text-center mt-5 text-lg fs-4">
                    <p class='text-gray-600'>Sudah punya akun? <a href="{{ route('auth.login') }}" class="font-bold"
                            wire:navigate>Log
                            in</a>.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <img src="{{ asset('assets/static/images/logo-unsrit.png') }}" alt="" />
                </div>
            </div>
        </div>
    </div>
</div>
