<x-guest-layout>
            <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
                        <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="card rounded-4">
                            <div class="card-body">
                                <div class="border p-4 rounded-4 text-center">
        
                                    <div class="mb-4 text-sm text-gray-600">
                                        {{ __("Gracias por registrarte! Antes de comenzar, ¿podría verificar su dirección de correo electrónico haciendo clic en el
                                        enlace que ¿Te acabo de enviar un correo electrónico? Si no recibió el correo electrónico, con gusto le enviaremos otro.") }}
                                    </div>
                                    
                                    @if (session('status') == 'verification-link-sent')
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionó durante el registro.') }}
                                    </div>
                                    @endif
                                    
                                    <div class="mt-4 flex items-center justify-between text-center">
                                        <form method="POST" action="{{ route('verification.send') }}">
                                            @csrf
                                    
                                            <div>
                                                <button class="btn btn-primary">
                                                    {{ __('Reenviar correo electrónico de verificación') }}
                                                </button>
                                            </div>
                                        </form>
                                    
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                    
                                            <button type="submit" class="btn btn-danger"
                                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                {{ __('Log Out') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>    
</x-guest-layout>
