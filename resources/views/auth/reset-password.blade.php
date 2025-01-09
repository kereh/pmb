<x-layouts.layout-auth title="{{ $title }}">
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <h1 class="auth-title">Reset Password</h1>
                <p class="auth-subtitle mb-5">Silahkan perbarui password anda.</p>

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" name="email"
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
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" name="password"
                            class="form-control form-control-xl @error('password') is-invalid @enderror"
                            placeholder="Password baru">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>

                        </div>
                        @error('password')
                            <small class="invalid-feedback">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" name="password_confirmation"
                            class="form-control form-control-xl @error('password_confirmation') is-invalid @enderror"
                            placeholder="Konfirmasi Password Baru">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>

                        </div>
                        @error('password_confirmation')
                            <small class="invalid-feedback">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">Kirim Link</button>
                </form>
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
