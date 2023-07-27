<x-guest-layout>
            <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                        <div class="col mx-auto">
                            <div class="card rounded-4">
                                <div class="card-body">
                                    <div class="border p-4 rounded-4">
            
                                        <div class="mb-4 text-sm text-gray-600">
                                                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                                            </div>
                                            
                                            <form method="POST" action="{{ route('password.confirm') }}">
                                                @csrf
                                            
                                                <!-- Password -->
                                                <div>
                                                    <x-input-label for="password" :value="__('Password')" />
                                            
                                                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                                        autocomplete="current-password" />
                                            
                                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                </div>
                                            
                                                <div class="flex justify-end mt-4">
                                                    <x-primary-button>
                                                        {{ __('Confirm') }}
                                                    </x-primary-button>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
</x-guest-layout>
