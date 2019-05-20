@component('mail::message')
# Your Spot was Not Approved

@component('mail::spot', ['spot' => $spot])
@endcomponent

Our Quality Approval team reviewed your spot and unforuntately, are unable to approve it for listing on our site at this time.

@if($reason)
@component('mail::panel')
{{$reason}}
@endcomponent
@endif

Thank you for your interest in Sweet Spot!
@endcomponent
