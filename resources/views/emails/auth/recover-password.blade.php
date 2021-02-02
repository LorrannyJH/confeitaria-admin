@component('mail::message')

<p>Olá, <strong>{{ $userName }}</strong>!</p>

<p>Uma redefinição de senha para a sua conta foi solicitada.</p>

<p>Para redefinir, por favor, clique no botão abaixo:

@component('mail::button', ['url' => $resetPasswordFormRoute])
REDEFINIR SENHA
@endcomponent

@endcomponent
