@component('mail::message')
![{{$spot->name}}]({{$spot->cover_photo_banner}} "{{$spot->name}}")

**{{$spot->name}}**  
{{$spot->address1}}  
{{$spot->address_line_2}}

# Here's the link to manage your spot!

@component('mail::editurl')
##### {{$token->url}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent