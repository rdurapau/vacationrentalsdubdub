@component('mail::message')
# New Booking Request

Someone is interested in your spot!

@component('mail::panel')
**{{$spot->name}}**  
{{$spot->address1}}  
{{$spot->address_line_2}}
@endcomponent

## Request Details

* **Name:** {{$bookingRequest->name}}
* **Email:** [{{$bookingRequest->email}}](mailto:{{$bookingRequest->email}})
* **Phone:** {{$bookingRequest->phone}}
* **Requested Dates:** {{$bookingRequest->dates}}

We recommend reaching out to them as soon as convenient - ideally within 24 hours. They don't have your contact information, so make sure you contact them!

Thanks,<br>
{{ config('app.name') }}
@endcomponent
