@component('mail::message')
# You've Requested a Booking!

@component('mail::spot', ['spot' => $spot])
@endcomponent

Thank you for reaching out regarding this spot! The owner will be reaching out to you shortly.

Thanks for using SweetSpot!
@endcomponent
