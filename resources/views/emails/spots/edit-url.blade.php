@component('mail::message')

@component('mail::spot', ['spot' => $spot])
@endcomponent

# Here's the link to manage your spot!

@component('mail::editurl')
##### {{$token->url}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent