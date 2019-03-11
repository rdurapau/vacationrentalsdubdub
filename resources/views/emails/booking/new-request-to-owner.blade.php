@component('mail::message')
# New Booking Request

Someone is interested in your spot at **{{$spot->full_address}}**!

* **Name:** {{$bookingRequest->name}}
* **Email:** {{$bookingRequest->email}}
* **Phone:** {{$bookingRequest->phone}}
* **Requested Dates:** {{$bookingRequest->dates}}

You're on your own now. Good luck!

Thanks,<br>
{{ config('app.name') }}
@endcomponent
