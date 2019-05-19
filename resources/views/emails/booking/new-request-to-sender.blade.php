@component('mail::message')
# You've Requested a Booking!

![{{$spot->name}}]({{$spot->cover_photo}} "{{$spot->name}}")
@component('mail::panel')
**{{$spot->name}}**  
{{$spot->address1}}  
{{$spot->address_line_2}}
@endcomponent

Thank you for reaching out regarding this spot! The owner will be reaching out to you shortly.

Thanks for using SweetSpot!
@endcomponent
