<p>Hi {{ $user->name }},</p>

<p>Thanks for registering! Please click the link below to confirm your account and set your password:</p>

<a href="{{ url('register/confirm/' . $token) }}">Confirm your account</a>