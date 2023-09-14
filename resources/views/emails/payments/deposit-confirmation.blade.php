<x-mail::message>

    {{$details['title']}}

    Usted ha realizado éxitosamente un deposito por la cantidad de {{ $details['monto'] }},
    con el número de orden {{$details['orden']}} en nuestra plataforma

    Gracias,
    {{ Setting::get('app_name') }}
</x-mail::message>