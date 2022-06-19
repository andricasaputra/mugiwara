@component('mail::message')
Halo {{ $user->name }}.

<br>
<b>Ini adalah notifikasi reset password. </b>
<br /><br />
Anda mendapatkan email ini karena kami menerima permintaan pengaturan ulang kata sandi untuk akun Anda. <br />

@component('mail::button', ['url' => $url])
Reset password
@endcomponent

<br>
Jika Anda tidak meminta pengaturan ulang kata sandi, maka tidak ada tindakan lebih lanjut yang diperlukan.
<br><br><br>

Salam Hangat,<br>
{{ config('app.name') }}
@endcomponent
