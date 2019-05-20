<div class="spot-image">
{{ Illuminate\Mail\Markdown::parse('!['.$spot->name.']('.$spot->cover_photo_banner.' "'.$spot->name.'")') }}
</div>
<table class="panel spot-content" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td class="panel-content">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="panel-item">
                        <p>
                            <strong>{{$spot->name}}</strong><br />
                            {{$spot->address1}}<br />
                            {{$spot->address_line_2}}
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
