<x-mail::message>
    <p>le code est : {{ $code }}</p>
    <x-mail::button :url="route('resetpassword')">
        Réinitialiser le mot de passe
    </x-mail::button>
    <p>In case you have any issues recovering your password, please contact us.</p>
    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>