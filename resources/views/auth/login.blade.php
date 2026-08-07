<x-guest-layout>
    <x-slot name="heading">Selamat Datang Kembali!</x-slot>
    <x-slot name="subheading">Masuk ke akunmu sekarang</x-slot>

    {{-- Session Status --}}
    @if (session('status'))
        <p class="mb-4 text-sm font-medium text-emerald-600">
            {{ session('status') }}
        </p>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        {{-- Email --}}
        <div>
            <label for="email" class="sr-only">Email</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-4 flex items-center text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75l9.75 6.75 9.75-6.75M4.5 5.25h15a1.5 1.5 0 011.5 1.5v10.5a1.5 1.5 0 01-1.5 1.5h-15a1.5 1.5 0 01-1.5-1.5V6.75a1.5 1.5 0 011.5-1.5z"/></svg>
                </span>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                       placeholder="Email"
                       class="w-full rounded-full border-0 bg-white pl-11 pr-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 px-4" />
        </div>

        {{-- Password --}}
        <div x-data="{ show: false }">
            <label for="password" class="sr-only">Password</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-4 flex items-center text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V7.5a4.5 4.5 0 10-9 0v3m-.75 0h10.5A1.5 1.5 0 0118.75 12v6a1.5 1.5 0 01-1.5 1.5h-10.5A1.5 1.5 0 015.25 18v-6a1.5 1.5 0 011.5-1.5z"/></svg>
                </span>
                <input :type="show ? 'text' : 'password'" id="password" name="password" required autocomplete="current-password"
                       placeholder="Password"
                       class="w-full rounded-full border-0 bg-white pl-11 pr-11 py-3 text-sm text-gray-900 placeholder:text-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <button type="button" @click="show = !show"
                        class="absolute inset-y-0 right-4 flex items-center text-gray-400 hover:text-gray-600">
                    <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <svg x-show="show" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 002.25 12s3.75 7.5 9.75 7.5c1.99 0 3.845-.573 5.406-1.5M6.228 6.228A10.45 10.45 0 0112 4.5c6 0 9.75 7.5 9.75 7.5a10.523 10.523 0 01-4.293 4.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.243 4.243L9.88 9.88"/></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 px-4" />
        </div>

        {{-- Login button --}}
        <button type="submit"
                class="w-full rounded-full bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold tracking-wide py-3 uppercase transition">
            Masuk
        </button>

        {{-- Remember me --}}
        <label for="remember_me" class="flex items-center gap-2 text-sm text-gray-600">
            <input id="remember_me" type="checkbox" name="remember"
                   class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
            Ingat Saya
        </label>

        <div class="flex items-center justify-between pt-2 text-sm">
            <p class="font-semibold text-gray-900">
                Belum memiliki akun?
                <a href="{{ route('register') }}" class="font-semibold text-indigo-600 underline hover:text-indigo-700">
                    Daftar di sini
                </a>
            </p>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-gray-500 underline hover:text-gray-700 shrink-0 ms-3">
                    Lupa password?
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>