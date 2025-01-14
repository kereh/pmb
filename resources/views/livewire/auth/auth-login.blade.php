<div>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <h1 class="auth-title">PMB UNSRIT</h1>
                <p class="auth-subtitle mb-5">Silahkan login menggunakan akun yang sudah didaftarkan.</p>
                @if ($status = Session::get('status'))
                    <div class="alert alert-dismissible {{ $status['type'] }} show fade">
                        <i class="bi bi-check-circle"></i>
                        {{ $status['message'] }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form wire:submit.prevent="login">
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text"
                            class="form-control form-control-xl @error('username') is-invalid @enderror"
                            placeholder="Username" wire:model.defer="username">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                        @error('username')
                            <small class="invalid-feedback">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password"
                            class="form-control form-control-xl @error('password') is-invalid @enderror"
                            placeholder="Password" wire:model.defer="password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        @error('password')
                            <small class="invalid-feedback">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-check form-check-lg d-flex align-items-end">
                        <input class="form-check-input me-2" type="checkbox" id="remember" wire:model.defer="remember">
                        <label class="form-check-label text-gray-600" for="remember">
                            Ingat saya
                        </label>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit"
                        wire:loading.attr="disabled" wire:target="login">
                        <span wire:loading.remove wire:target="login">Login</span>
                        <span wire:loading wire:target="login">Mohon tunggu...</span>
                    </button>
                </form>
                <div class="text-center mt-5 text-lg fs-4">
                    <p class="text-gray-600">Belum punya akun? <a href="{{ route('auth.registrasi') }}"
                            class="font-bold" wire:navigate>Buat sekarang</a></p>
                    <p><a class="font-bold" href="{{ route('password.request') }}" wire:navigate>Lupa password</a></p>
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
