@component('mail::message')
# Here's the link to manage your spot!

**{{$spot->full_address}}**

@component('mail::panel')
{{$token->url}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent