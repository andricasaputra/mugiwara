<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo width="82" />
            </a>
        </x-slot>

        <div class="card-body">
            <div class="mb-4 small text-muted">
                {{ __('Satu langkah lagi! buka email anda dan dan klik link yang kami kirimkan untuk memverifikasi lamat email anda!.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success" role="alert">
                    {{ __('Link terbaru sudah kami kirimkan ke alamat email anda.') }}
                </div>
            @endif

            <div class="mt-4 d-flex justify-content-between">
                <form method="POST" action="{{ route('verification.email.verify.resend') }}">
                    @csrf
                    <div>
                        <x-button>
                            {{ __('Kirim ulang kode verifikasi') }}
                        </x-button>
                    </div>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="btn btn-link">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
