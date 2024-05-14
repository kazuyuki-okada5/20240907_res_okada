@component('mail::message')
# お知らせ

{{ $content }}

ありがとうございます。<br>
{{ config('app.name') }}
@endcomponent
