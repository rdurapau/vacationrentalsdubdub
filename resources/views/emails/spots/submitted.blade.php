@component('mail::message')

@component('mail::spot', ['spot' => $spot])
@endcomponent

# Welcome to Sweet Spot!

Thank you for submitting your Sweet Spot; our Quality Approval team is on it! You can expect to see a follow-up email within 72 hours regarding the status of your listing.

## You Can Update Your Listing Anytime

This is the unique URL for your listing. Keep it secret. Keep it safe. It can be used to update your listing at any time.

@component('mail::editurl')
##### {{$spot->edit_url}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent