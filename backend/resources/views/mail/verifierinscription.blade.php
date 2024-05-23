<x-mail::message>
<p> hello : {{$user->nom}}</p>



<x-mail::button :url="route('verify', ['token' => $user->remember_token])">
    Cliquez ici pour continuer l'inscription
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
