<x-mail::message>

<h1>{{$mailData['title']}}</h1>
<p>{{$mailData['name']}} {{$mailData['lastName']}}, {{$mailData['body']}}</p>

<x-mail::panel>
{{$mailData['pin']}}
</x-mail::panel>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
