@component('mail::message')
# Welcome to Sweet Spot!

Thank you for submitting your Sweet Spot at **{{$spot->full_address}}**. Our Quality Approval team is on it! You can expect to see a follow-up email within 72 hours regarding the status of your listing.

## You Can Update Your Listing Anytime

This is the unique URL for your listing. Keep it secret. Keep it safe. It can be used to update your listing at any time.

@component('mail::panel')
##### {{$spot->edit_url}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent