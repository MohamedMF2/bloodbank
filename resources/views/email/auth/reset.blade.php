@component('mail::message')
# Introduction

Blood bank reset password
@component('mail::button', ['url' => ''])
Reset
@endcomponent
<p> Your verification code is {{ $code}}</p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
