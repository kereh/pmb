<div class="row h-100">
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <h1 class="auth-title">Reset Password</h1>
            <p class="auth-subtitle mb-5">Silahkan perbarui password anda.</p>
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible show fade">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
            @if ($status = Session::get('status'))
                <div class="alert alert-dismissible {{ $status['type'] }} show fade">
                    <i class="bi bi-check-circle"></i>
                    {{ $status['message'] }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                        @click="show = false"></button>
                </div>
            @endif
            <form wire:submit.prevent="update">
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="email" class="form-control form-control-xl @error('email') is-invalid @enderror"
                        placeholder="Email" wire:model.blur="email">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    @error('email')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password"
                        class="form-control form-control-xl @error('password') is-invalid @enderror"
                        placeholder="Password baru" wire:model="password">
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
                    <input type="password" class="form-control form-control-xl"
                        placeholder="Konfirmasi Password Baru" wire:model.blur="password_confirmation">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5"
                    wire:loading.attr="disabled" wire:target="update">
                    <span wire:loading.remove wire:target="update">Perbarui Password</span>
                    <span wire:loading wire:target="update">Memperbarui Password...</span>
                </button>
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
