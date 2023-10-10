<x-registration-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('searchForm') }}">
        @csrf

        <!-- search text -->
        <div>
            <x-input-label for="search" :value="__('search')" />
            <x-text-input id="search" class="block mt-1 w-full" type="text" name="keyword" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('search')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-3">
                {{ __('search') }}
            </x-primary-button>
        </div>
    </form>
</x-registration-layout>
