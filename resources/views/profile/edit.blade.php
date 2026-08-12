<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-sm font-medium text-indigo-600">
                TaskFlow
            </p>

            <h2 class="mt-1 text-2xl font-bold text-gray-900">
                Profil
            </h2>
        </div>
    </x-slot>


    {{-- ========================================================= --}}
    {{-- LAYOUT UTAMA --}}
    {{-- ========================================================= --}}

    <div class="min-h-screen bg-gray-50">

        <div class="mx-auto flex max-w-7xl">


            {{-- ================================================= --}}
            {{-- SIDEBAR --}}
            {{-- ================================================= --}}

            <aside class="hidden w-64 shrink-0 border-r border-gray-200 bg-white md:block">

                <div class="sticky top-0 flex h-screen flex-col">


                    {{-- Logo --}}
                    <div class="flex h-20 items-center border-b border-gray-100 px-6">

                        <div>
                            <p class="text-xl font-bold text-indigo-600">
                                TaskFlow
                            </p>

                            <p class="text-xs text-gray-400">
                                Kelola Tugas Sekolah Tanpa Ribet!
                            </p>
                        </div>

                    </div>


                    {{-- Menu --}}
                    <nav class="flex-1 space-y-1 px-4 py-6">


                        {{-- Dashboard --}}
                        <a
                            href="{{ route('dashboard') }}"
                            class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600"
                        >

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h4v-6h4v6h4a1 1 0 001-1V10"
                                />
                            </svg>

                            Dashboard

                        </a>


                        {{-- Tugas --}}
                        <a
                            href="{{ route('tasks.index') }}"
                            class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600"
                        >

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6M9 8h1m5 12H7a2 2 0 01-2-2V6a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V18a2 2 0 01-2 2z"
                                />
                            </svg>

                            Tugas

                        </a>


                        {{-- Tambah Tugas --}}
                        <a
                            href="{{ route('tasks.create') }}"
                            class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600"
                        >

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 4.5v15m7.5-7.5h-15"
                                />
                            </svg>

                            Tambah Tugas

                        </a>


                        {{-- Kategori --}}
                        <a
                            href="{{ route('categories.index') }}"
                            class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600"
                        >

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 7h16M4 12h16M4 17h16"
                                />
                            </svg>

                            Kategori

                        </a>


                        {{-- Profil Aktif --}}
                        <a
                            href="{{ route('profile.edit') }}"
                            class="flex items-center gap-3 rounded-xl bg-indigo-50 px-4 py-3 text-sm font-semibold text-indigo-700"
                        >

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0"
                                />
                            </svg>

                            Profil

                        </a>

                    </nav>


                    {{-- ================================================= --}}
                    {{-- USER + LOGOUT --}}
                    {{-- ================================================= --}}

                    <div class="border-t border-gray-100 p-4">

                        <div class="mb-3 flex items-center gap-3 px-2">

                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-indigo-100 font-semibold text-indigo-600"
                            >
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <div class="min-w-0">

                                <p class="truncate text-sm font-semibold text-gray-900">
                                    {{ Auth::user()->name }}
                                </p>

                                <p class="truncate text-xs text-gray-400">
                                    {{ Auth::user()->email }}
                                </p>

                            </div>

                        </div>


                        {{-- Logout --}}
                        <form method="POST" action="{{ route('logout') }}">

                            @csrf

                            <button
                                type="submit"
                                class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-500 transition hover:bg-rose-50 hover:text-rose-600"
                            >

                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3"
                                    />
                                </svg>

                                Keluar

                            </button>

                        </form>

                    </div>

                </div>

            </aside>


            {{-- ================================================= --}}
            {{-- CONTENT --}}
            {{-- ================================================= --}}

            <main class="min-w-0 flex-1">

                <div class="p-6 lg:p-8">


                    {{-- ================================================= --}}
                    {{-- PROFILE HEADER --}}
                    {{-- ================================================= --}}

                    <div
                        class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-600 via-indigo-600 to-violet-700 p-6 text-white shadow-sm md:p-8"
                    >

                        <div class="relative z-10 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                            <div class="flex items-center gap-5">

                                {{-- Avatar --}}
                                <div
                                    class="flex h-20 w-20 shrink-0 items-center justify-center rounded-2xl bg-white/15 text-3xl font-bold backdrop-blur-sm"
                                >
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>


                                <div>

                                    <p class="text-sm font-medium text-indigo-100">
                                        Pengaturan akun
                                    </p>

                                    <h1 class="mt-1 text-3xl font-bold tracking-tight">
                                        Profil Saya
                                    </h1>

                                    <p class="mt-2 text-sm text-indigo-100">
                                        Kelola informasi akun dan keamanan password kamu.
                                    </p>

                                </div>

                            </div>

                            {{-- Tombol Kembali ke Dashboard --}}
                            <a
                                href="{{ route('dashboard') }}"
                                class="inline-flex items-center justify-center gap-2 shrink-0 rounded-xl bg-white/15 px-4 py-2.5 text-sm font-semibold text-white backdrop-blur-sm transition hover:bg-white/25 focus:outline-none focus:ring-2 focus:ring-white/50"
                            >
                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"
                                    />
                                </svg>
                                Kembali ke Dashboard
                            </a>

                        </div>


                        {{-- Decorative circles --}}
                        <div
                            class="absolute -right-10 -top-16 h-52 w-52 rounded-full bg-white/10"
                        ></div>

                        <div
                            class="absolute -bottom-24 right-24 h-48 w-48 rounded-full bg-violet-400/20"
                        ></div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- INFORMASI PROFIL --}}
                    {{-- ================================================= --}}

                    <div
                        class="mt-6 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm"
                    >

                        <div class="border-b border-gray-100 px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600"
                                >

                                    <svg
                                        class="h-5 w-5"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0"
                                        />
                                    </svg>

                                </div>

                                <div>

                                    <h3 class="font-semibold text-gray-900">
                                        Informasi Profil
                                    </h3>

                                    <p class="text-xs text-gray-400">
                                        Perbarui nama dan alamat email akunmu.
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="px-6 py-6">

                            <form method="post" action="{{ route('profile.update') }}" class="max-w-2xl">

                                @csrf
                                @method('patch')


                                {{-- Nama --}}
                                <div>

                                    <label
                                        for="name"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Nama
                                    </label>

                                    <input
                                        id="name"
                                        name="name"
                                        type="text"
                                        value="{{ old('name', $user->name) }}"
                                        required
                                        autofocus
                                        autocomplete="name"
                                        class="mt-2 block w-full rounded-xl border-gray-200 px-4 py-3 text-sm shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                                    >

                                    @if ($errors->get('name'))
                                        <p class="mt-2 text-sm text-rose-600">
                                            {{ $errors->first('name') }}
                                        </p>
                                    @endif

                                </div>


                                {{-- Email --}}
                                <div class="mt-5">

                                    <label
                                        for="email"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Email
                                    </label>

                                    <input
                                        id="email"
                                        name="email"
                                        type="email"
                                        value="{{ old('email', $user->email) }}"
                                        required
                                        autocomplete="username"
                                        class="mt-2 block w-full rounded-xl border-gray-200 px-4 py-3 text-sm shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                                    >

                                    @if ($errors->get('email'))
                                        <p class="mt-2 text-sm text-rose-600">
                                            {{ $errors->first('email') }}
                                        </p>
                                    @endif

                                </div>


                                {{-- Save --}}
                                <div class="mt-6 flex items-center gap-4">

                                    <button
                                        type="submit"
                                        class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    >

                                        <svg
                                            class="h-4 w-4"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 13l4 4L19 7"
                                            />
                                        </svg>

                                        Simpan Perubahan

                                    </button>


                                    @if (session('status') === 'profile-updated')

                                        <p class="text-sm font-medium text-emerald-600">
                                            Profil berhasil diperbarui.
                                        </p>

                                    @endif

                                </div>

                            </form>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- PASSWORD --}}
                    {{-- ================================================= --}}

                    <div
                        class="mt-6 overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm"
                    >

                        <div class="border-b border-gray-100 px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-50 text-violet-600"
                                >

                                    <svg
                                        class="h-5 w-5"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M16.5 10.5V6.75a4.5 4.5 0 00-9 0v3.75M6.75 10.5h10.5a1.5 1.5 0 011.5 1.5v7.5a1.5 1.5 0 01-1.5 1.5H6.75a1.5 1.5 0 01-1.5-1.5V12a1.5 1.5 0 011.5-1.5z"
                                        />
                                    </svg>

                                </div>

                                <div>

                                    <h3 class="font-semibold text-gray-900">
                                        Keamanan Akun
                                    </h3>

                                    <p class="text-xs text-gray-400">
                                        Perbarui password untuk menjaga keamanan akunmu.
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="px-6 py-6">

                            <form method="post" action="{{ route('password.update') }}" class="max-w-2xl">

                                @csrf
                                @method('put')


                                {{-- Password Lama --}}
                                <div>

                                    <label
                                        for="current_password"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Password Saat Ini
                                    </label>

                                    <input
                                        id="current_password"
                                        name="current_password"
                                        type="password"
                                        autocomplete="current-password"
                                        class="mt-2 block w-full rounded-xl border-gray-200 px-4 py-3 text-sm shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                                    >

                                    @if ($errors->updatePassword->get('current_password'))
                                        <p class="mt-2 text-sm text-rose-600">
                                            {{ $errors->updatePassword->first('current_password') }}
                                        </p>
                                    @endif

                                </div>


                                {{-- Password Baru --}}
                                <div class="mt-5">

                                    <label
                                        for="password"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Password Baru
                                    </label>

                                    <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        autocomplete="new-password"
                                        class="mt-2 block w-full rounded-xl border-gray-200 px-4 py-3 text-sm shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                                    >

                                    @if ($errors->updatePassword->get('password'))
                                        <p class="mt-2 text-sm text-rose-600">
                                            {{ $errors->updatePassword->first('password') }}
                                        </p>
                                    @endif

                                </div>


                                {{-- Konfirmasi --}}
                                <div class="mt-5">

                                    <label
                                        for="password_confirmation"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Konfirmasi Password Baru
                                    </label>

                                    <input
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        type="password"
                                        autocomplete="new-password"
                                        class="mt-2 block w-full rounded-xl border-gray-200 px-4 py-3 text-sm shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                                    >

                                </div>


                                {{-- Save --}}
                                <div class="mt-6 flex items-center gap-4">

                                    <button
                                        type="submit"
                                        class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    >

                                        <svg
                                            class="h-4 w-4"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 13l4 4L19 7"
                                            />
                                        </svg>

                                        Perbarui Password

                                    </button>


                                    @if (session('status') === 'password-updated')

                                        <p class="text-sm font-medium text-emerald-600">
                                            Password berhasil diperbarui.
                                        </p>

                                    @endif

                                </div>

                            </form>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- INFORMASI AKUN --}}
                    {{-- ================================================= --}}

                    <div
                        class="mt-6 rounded-2xl border border-indigo-100 bg-indigo-50 px-6 py-5"
                    >

                        <div class="flex items-start gap-3">

                            <div class="mt-0.5 text-indigo-600">

                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>

                            </div>

                            <div>

                                <p class="text-sm font-medium text-indigo-900">
                                    Tips keamanan
                                </p>

                                <p class="mt-1 text-sm text-indigo-700">
                                    Gunakan password yang kuat dan jangan membagikannya kepada orang lain.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </main>

        </div>

    </div>

</x-app-layout>