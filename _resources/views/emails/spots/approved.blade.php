@component('mail::message')
# Your spot has been approved!

@component('mail::spot', ['spot' => $spot])
@endcomponent

We are pleased to inform you that your Sweet Spot has been approved and is visible to all Sweet Spot visitors! Take a look: {{$spot->view_url}}

Expect to see inquiries and site visits as people discover your spot. Remember, you can update your spot if you need to using this link:

@component('mail::editurl')
##### {{$spot->edit_url}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
