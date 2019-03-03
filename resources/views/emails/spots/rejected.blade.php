@component('mail::message')
# Your Spot was Not Approved

Our Quality Approval team reviewed your spot at **{{$spot->full_address}}** and unforuntately, are unable to approve it for listing on our site at this time.

@if($reason)
{{$reason}}
@endif

Thank you for your interest in Sweet Spot!

Thanks,<br>
{{ config('app.name') }}
@endcomponent
