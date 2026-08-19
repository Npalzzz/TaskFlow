<x-guest-layout>
    <x-slot name="heading">Selamat Datang Kembali!</x-slot>
    <x-slot name="subheading">Masuk ke akunmu sekarang</x-slot>

    {{-- Session Status --}}
    @if (session('status'))
        <div class="mb-4 rounded-xl border border-emerald-100 bg-emerald-50 p-4 text-sm font-medium text-emerald-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        {{-- Email --}}
        <div>
            <label for="email" class="sr-only">Email</label>
            <div class="group relative">
                <span class="absolute inset-y-0 left-4 flex items-center text-gray-400 transition-colors group-focus-within:text-indigo-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75l9.75 6.75 9.75-6.75M4.5 5.25h15a1.5 1.5 0 011.5 1.5v10.5a1.5 1.5 0 01-1.5 1.5h-15a1.5 1.5 0 01-1.5-1.5V6.75a1.5 1.5 0 011.5-1.5z"/></svg>
                </span>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                       placeholder="Alamat Email"
                       class="w-full rounded-2xl border border-gray-200 bg-white/60 py-3.5 pl-11 pr-4 text-sm text-gray-900 shadow-sm outline-none transition-all placeholder:text-gray-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 px-2" />
        </div>

        {{-- Password --}}
        <div x-data="{ show: false }">
            <label for="password" class="sr-only">Password</label>
            <div class="group relative">
                <span class="absolute inset-y-0 left-4 flex items-center text-gray-400 transition-colors group-focus-within:text-indigo-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V7.5a4.5 4.5 0 10-9 0v3m-.75 0h10.5A1.5 1.5 0 0118.75 12v6a1.5 1.5 0 01-1.5 1.5h-10.5A1.5 1.5 0 015.25 18v-6a1.5 1.5 0 011.5-1.5z"/></svg>
                </span>
                <input :type="show ? 'text' : 'password'" id="password" name="password" required autocomplete="current-password"
                       placeholder="Password"
                       class="w-full rounded-2xl border border-gray-200 bg-white/60 py-3.5 pl-11 pr-12 text-sm text-gray-900 shadow-sm outline-none transition-all placeholder:text-gray-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10">
                <button type="button" @click="show = !show"
                        class="absolute inset-y-0 right-4 flex items-center text-gray-400 transition-colors hover:text-indigo-600 focus:outline-none">
                    <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <svg x-show="show" x-cloak class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 002.25 12s3.75 7.5 9.75 7.5c1.99 0 3.845-.573 5.406-1.5M6.228 6.228A10.45 10.45 0 0112 4.5c6 0 9.75 7.5 9.75 7.5a10.523 10.523 0 01-4.293 4.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.243 4.243L9.88 9.88"/></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 px-2" />
        </div>

        {{-- Remember & Forgot Password --}}
        <div class="flex items-center justify-between px-1">
            <label for="remember_me" class="flex cursor-pointer items-center gap-2">
                <input id="remember_me" type="checkbox" name="remember"
                       class="h-4 w-4 rounded border-gray-300 text-indigo-600 transition focus:ring-indigo-500/30">
                <span class="select-none text-sm font-medium text-gray-600">Ingat Saya</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm font-semibold text-indigo-600 transition hover:text-indigo-800">
                    Lupa password?
                </a>
            @endif
        </div>

        {{-- Login button --}}
        <button type="submit"
                class="w-full rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 py-3.5 text-sm font-bold tracking-wide text-white shadow-lg shadow-indigo-500/30 transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-indigo-500/40 active:scale-[0.98]">
            Masuk ke Akun
        </button>

        <p class="pt-4 text-center text-sm font-medium text-gray-600">
            Belum memiliki akun?
            <a href="{{ route('register') }}" class="font-bold text-indigo-600 transition hover:text-indigo-800">
                Daftar sekarang
            </a>
        </p>
    </form>
</x-guest-layout>