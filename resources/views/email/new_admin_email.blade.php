@component('mail::message')
# Welcom to CarSystem.
We are happy {{ $merchant->name }} to see you with us.
@component('mail::panel')
    Your password is:ahmad2020.
@endcomponent
@component('mail::button', ['url' => 'http://127.0.0.1:8000/cms/admin/login'])
    Login to CMS Admin.
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
