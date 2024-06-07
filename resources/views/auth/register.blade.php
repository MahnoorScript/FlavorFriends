<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Age -->
        <div class="mt-4">
            <x-input-label for="age" :value="__('Age')" />
            <x-text-input id="age" class="form-input rounded-md shadow-sm mt-1 block w-full" type="text" name="age" :value="old('age')" />
            <x-input-error :messages="$errors->get('age')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <x-text-input id="phone_number" class="form-input rounded-md shadow-sm mt-1 block w-full" type="text" name="phone_number" :value="old('phone_number')" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- Favourite Foods -->
        <div class="mt-4">
            <x-input-label for="favourite_foods" :value="__('Favourite Foods')" />
            <select name="favourite_foods[]" id="favourite_foods" class="form-multiselect block w-full mt-1" multiple>
                @foreach(['Italian', 'Mexican', 'Japanese', 'Indian', 'Chinese', 'Mediterranean', 'Thai', 'Vegetarian', 'Vegan', 'Gluten-Free'] as $option)
                <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('favourite_foods')" class="mt-2" />
        </div>

        <!-- Eating Times -->
        <div class="mt-4">
            <x-input-label for="eating_times" :value="__('Eating Times')" />
            <select name="eating_times[]" id="eating_times" class="form-multiselect block w-full mt-1" multiple>
                @foreach(['Morning', 'Afternoon', 'Evening', 'Night'] as $option)
                <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('eating_times')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>