<x-layouts.layout-auth title="{{ $title }}">
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <h1 class="auth-title">Lupa Password</h1>
                <p class="auth-subtitle mb-5">Input your email and we will send you reset password link.</p>
                @if ($status = Session::get('status'))
                    <div class="alert alert-dismissible {{ $status['type'] }} show fade">
                        <i class="bi bi-check-circle"></i>
                        {{ $status['message'] }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{ route('auth.kirim-link') }}" method="POST">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="email" name="email"
                            class="form-control form-control-xl @error('email') is-invalid @enderror"
                            placeholder="Email">
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        @error('email')
                            <small class="invalid-feedback">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">Kirim Link</button>
                </form>
                <div class="text-center mt-5 text-lg fs-4">
                    <p class='text-gray-600'>Kembali ke halaman login? <a href="{{ route('auth.login') }}"
                            class="font-bold" wire:navigate>Log
                            in</a>.
                    </p>
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
</x-layouts.layout-auth>
