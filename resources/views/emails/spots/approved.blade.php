@component('mail::message')
# Welcome to Sweet Spot!

We are pleased to inform you that your Sweet Spot at **{{$spot->full_address}}** has been approved and is visible to all Sweet Spot visitors!

Expect to see inquiries and site visits as people discover your spot.

Remember, you can update your spot if you need to:

Thanks,<br>
{{ config('app.name') }}
@endcomponent
