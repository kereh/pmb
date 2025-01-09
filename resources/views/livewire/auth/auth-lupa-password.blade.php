<div class="row h-100">
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <h1 class="auth-title">Lupa Password</h1>
            <p class="auth-subtitle mb-5">Input your email and we will send you a reset password link.</p>

            <!-- Flash Message -->
            @if ($status = Session::get('status'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    class="alert alert-dismissible {{ $status['type'] }} show fade">
                    <i class="bi bi-check-circle"></i>
                    {{ $status['message'] }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                        @click="show = false"></button>
                </div>
            @endif

            <!-- Form -->
            <form wire:submit.prevent="send">
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="email" wire:model.blur="email"
                        class="form-control form-control-xl @error('email') is-invalid @enderror" placeholder="Email">
                    <div class="form-control-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    @error('email')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove>Kirim Link</span>
                    <span wire:loading>Mengirim...</span>
                </button>
            </form>

            <!-- Link to Login -->
            <div class="text-center mt-5 text-lg fs-4">
                <p class='text-gray-600'>Kembali ke halaman login? <a href="{{ route('auth.login') }}" class="font-bold"
                        wire:navigate>Log in</a>.
                </p>
            </div>
        </div>
    </div>

    <!-- Right Section -->
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">
            <div class="d-flex justify-content-center align-items-center h-100">
                <img src="{{ asset('assets/static/images/logo-unsrit.png') }}" alt="Logo" />
            </div>
        </div>
    </div>
</div>
