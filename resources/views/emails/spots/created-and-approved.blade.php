@component('mail::message')

@component('mail::spot', ['spot' => $spot])
@endcomponent

# Welcome to Sweet Spot!

Your spot has been added to Sweet Spot and is visible to all of our visitors. Congratulations! Take a look: {{$spot->view_url}}

Expect to see inquiries and site visits as people discover your spot.

## You Can Update Your Listing Anytime

This is the unique URL for your listing. Keep it secret. Keep it safe. It can be used to update your listing at any time.

@component('mail::editurl')
##### {{$spot->edit_url}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent