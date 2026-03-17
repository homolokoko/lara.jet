<x-guest-layout>

    <div class="flex items-center justify-center h-full">
        <div class="py-5 border-2 px-7 border-neutral rounded-xl">
            <div class="flex justify-center"><img src="{{ asset('snapchat.png') }}" alt="" class="w-8 h-8"></div>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <label for="name" class=" label-text-alt" >{{ __('Name') }}</label>
                    <x-jet-input id="name" class="block w-full mt-1 bg-transparent" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <label for="email" class=" label-text-alt" >{{ __('Email') }}</label>
                    <x-jet-input id="email" class="block w-full mt-1 bg-transparent" type="text" name="email" :value="old('email')" required />
                </div>

                <div class="mt-4">
                    <label for="password" class=" label-text-alt" >{{ __('Password') }}</label>
                    <x-jet-input id="password" class="block w-full mt-1 bg-transparent" type="password" name="password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <label for="password_confirmation" class=" label-text-alt" >{{ __('Confirm Password') }}</label>
                    <x-jet-input id="password_confirmation" class="block w-full mt-1 bg-transparent" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-jet-label for="terms">
                            <div class="flex items-center">
                                <x-jet-checkbox name="terms" id="terms"/>

                                <div class="ml-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-sm text-gray-600 underline hover:text-gray-900">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-sm text-gray-600 underline hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-jet-label>
                    </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <a class="text-sm underline hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-jet-button class="ml-4">
                        {{ __('Register') }}
                    </x-jet-button>
                </div>
            </form>
        </div>
    </div>  

</x-guest-layout>
