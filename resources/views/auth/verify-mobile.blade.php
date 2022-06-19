<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo width="82" />
            </a>
        </x-slot>

        <div class="card-body">
            <div class="mb-4 small text-muted">
                {{ __('Thanks for signing up! Before getting started, could you verify your mobile number address by clicking on the link we just mobile numbered to you? If you didn\'t receive the mobile number, we will gladly send you another.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success" role="alert">
                    {{ __('A new verification link has been sent to the mobile number address you provided during registration.') }}
                </div>
            @endif

            <div class="mt-4">
                @include('inc.auth-message', ['status' => session('status')])
                <form method="POST" action="{{ route('verification.mobile.verify.send') }}">
                    @csrf

                    <input type="hidden" value="{{ auth()->id() }}" name="user_id">

                    <div class="mb-3">
                        <x-label for="otp" :value="__('OTP Code')" />

                        <x-input id="otp" type="text" name="otp" required autofocus />
                    </div>

                    
                        <div class="mb-0">
                            <div class="d-flex justify-content-end">
                                <x-button>
                                    {{ __('Verify OTP Cide') }}
                                </x-button>
                            </div>
                        </div>
              
                </form>
            </div>

            <div class="d-flex justify-content-end">
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
