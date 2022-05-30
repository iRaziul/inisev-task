@component('mail::message')
# Story Created

A new story has been created.

@component('mail::button', ['url' => $preview_url])
    Preview
@endcomponent
@component('mail::button', ['url' => $approval_url])
    Approve
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
