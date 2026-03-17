<x-guest-layout>


    <div class="flex items-center justify-center h-full">

        <div class="py-5 border-2 px-7 border-neutral rounded-xl">
            <div class="flex justify-center"><img src="{{ asset('snapchat.png') }}" alt="" class="w-8 h-8"></div>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email" class=" label-text-alt">{{ __('Name') }}</label>
                    <x-jet-input id="email" class="block w-full mt-1 bg-transparent" type="text" name="email" :value="old('email')" required autofocus />
                </div>

                <div class="mt-4">
                    <label for="email" class=" label-text-alt">{{ __('Password') }}</label>
                    <x-jet-input id="password" class="block w-full mt-1 bg-transparent" type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center label-text-alt">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="text-sm underline hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-jet-button class="ml-4">
                        {{ __('Log in') }}
                    </x-jet-button>
                </div>
            </form>
        </div>

    </div>
</x-guest-layout>
