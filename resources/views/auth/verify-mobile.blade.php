<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo />
            </a>
        </x-slot>

        <div class="card-body">
            <div class="mb-4 small text-muted">
                {{ __('Silahkan lakukan verifikasi nomor ponsel anda
                sebelum menggunakan aplikasi ini, kami telah mengirimkan 6 digit kode OTP ke nomor ponsel anda via whatsapp.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success" role="alert">
                    {{ __('A new verification link has been sent to the mobile number address you provided during registration.') }}
                </div>
            @endif

            <div class="mt-4">
                @include('inc.message')

                <form method="POST" action="{{ route('verification.mobile.verify.send') }}">

                    @csrf

                    <input type="hidden" value="{{ auth()->id() }}" name="user_id">

                    <div class="mb-3">
                        <x-label for="otp" :value="__('Masukkan Kode OTP')" />

                        <x-input id="otp" type="text" name="otp" required autofocus />
                    </div>

                    <div class="mb-0">
                        <div class="d-flex justify-content-between">
                            <x-button>
                                {{ __('Verifikasi kode OTP') }}
                            </x-button>

                            <a href="#" type="submit" class="btn btn-link" onClick="logout(event)">
                                {{ __('Log Out') }}
                            </a>

                        </div>
                    </div>
          
                </form>
            </div>

            <form method="POST" action="{{ route('verification.mobile.verify.resend') }}">
                @csrf
                <input type="hidden" value="{{ auth()->id() }}" name="user_id">
                 <a class="mt-1" style="text-decoration: underlinel; cursor: pointer" onclick="event.preventDefault();
                                            this.closest('form').submit();">
                
                <small>Tidak menerima Kode OTP? kirim ulang disini</small>
                </a>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>



<script>
    async function logout(e){
        e.preventDefault();

        const response = await fetch('{{ route('logout') }}', {
            method : 'POST',
            headers : {
                 'X-CSRF-TOKEN' : '{{ csrf_token() }}'
            }
        });

        if(response.ok){
            window.location = '{{ route('login') }}'
        }

        return;
    }
</script>


