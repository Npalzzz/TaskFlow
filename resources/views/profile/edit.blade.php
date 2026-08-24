<x-app-layout>


<x-slot name="header">
    <div>
        <p class="text-xs font-bold uppercase tracking-widest text-indigo-500">
            TaskFlow
        </p>

        <h2 class="mt-1 text-2xl font-extrabold tracking-tight text-slate-900">
            Profil
        </h2>
    </div>
</x-slot>


{{-- ========================================================= --}}
{{-- LAYOUT UTAMA --}}
{{-- ========================================================= --}}

<div class="min-h-screen bg-slate-50/50">

    <div class="mx-auto flex max-w-7xl">


        {{-- ================================================= --}}
        {{-- SIDEBAR --}}
        {{-- ================================================= --}}

        <aside class="hidden w-64 shrink-0 border-r border-slate-200 bg-white md:block">

            <div class="sticky top-0 flex h-screen flex-col">


                {{-- Logo --}}
                <div class="flex h-20 items-center border-b border-slate-100 px-6">

                    <div>
                        <h1 class="text-xl font-bold tracking-tight text-slate-900">
                            Task<span class="text-indigo-600">Flow</span>
                        </h1>

                        <p class="mt-0.5 text-xs font-medium text-slate-400">
                            Kelola Tugas Sekolah Tanpa Ribet!
                        </p>
                    </div>

                </div>


                {{-- Menu --}}
                <nav class="flex-1 space-y-1 px-4 py-6">


                    {{-- Dashboard --}}
                    <a
                        href="{{ route('dashboard') }}"
                        class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition-all duration-200 hover:bg-indigo-50 hover:text-indigo-600"
                    >

                        <svg
                            class="h-5 w-5 transition-transform duration-200 group-hover:scale-105"
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
                        class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition-all duration-200 hover:bg-indigo-50 hover:text-indigo-600"
                    >

                        <svg
                            class="h-5 w-5 transition-transform duration-200 group-hover:scale-105"
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
                        class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition-all duration-200 hover:bg-indigo-50 hover:text-indigo-600"
                    >

                        <svg
                            class="h-5 w-5 transition-transform duration-200 group-hover:scale-105"
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
                        class="group flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition-all duration-200 hover:bg-indigo-50 hover:text-indigo-600"
                    >

                        <svg
                            class="h-5 w-5 transition-transform duration-200 group-hover:scale-105"
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
                        class="group relative flex items-center gap-3 overflow-hidden rounded-xl bg-indigo-50 px-4 py-3 text-sm font-bold text-indigo-700 ring-1 ring-inset ring-indigo-100"
                    >

                        <span class="absolute left-0 top-1/2 h-7 w-1 -translate-y-1/2 rounded-r-full bg-indigo-500"></span>

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

                <div class="border-t border-slate-100 p-4">

                    <div class="mb-3 flex items-center gap-3 rounded-xl px-2 py-2">

                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-indigo-100 font-bold text-indigo-600 ring-4 ring-indigo-50"
                        >
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>

                        <div class="min-w-0">

                            <p class="truncate text-sm font-bold text-slate-900">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="truncate text-xs font-medium text-slate-400">
                                {{ Auth::user()->email }}
                            </p>

                        </div>

                    </div>


                    {{-- Logout --}}
                    <form method="POST" action="{{ route('logout') }}">

                        @csrf

                        <button
                            type="submit"
                            class="group flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-500 transition-all duration-200 hover:bg-rose-50 hover:text-rose-600"
                        >

                            <svg
                                class="h-5 w-5 transition-transform duration-200 group-hover:translate-x-0.5"
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

            <div class="space-y-6 p-6 lg:p-8">


                {{-- ================================================= --}}
                {{-- PROFILE HERO --}}
                {{-- ================================================= --}}

                <div class="relative overflow-hidden rounded-[2rem] bg-slate-900 p-7 shadow-2xl shadow-indigo-900/20 md:p-10">

                    {{-- Glow --}}
                    <div class="absolute -right-24 -top-24 h-64 w-64 rounded-full bg-indigo-500/40 blur-[80px]"></div>

                    <div class="absolute -bottom-24 -left-24 h-64 w-64 rounded-full bg-violet-600/30 blur-[80px]"></div>

                    <div class="absolute right-1/3 top-1/2 h-32 w-32 -translate-y-1/2 rounded-full bg-indigo-400/10 blur-[60px]"></div>


                    <div class="relative z-10 flex flex-col justify-between gap-7 md:flex-row md:items-center">

                        <div class="flex items-center gap-5">


                            {{-- Avatar --}}
                            <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-2xl border border-white/10 bg-white/10 text-3xl font-extrabold text-white shadow-inner backdrop-blur-md md:h-24 md:w-24 md:text-4xl">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>


                            <div>

                                <p class="text-xs font-bold uppercase tracking-widest text-indigo-400">
                                    Pengaturan Akun
                                </p>

                                <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-white md:text-4xl">
                                    Profil Saya
                                </h1>

                                <p class="mt-3 max-w-xl text-sm leading-relaxed text-slate-400 md:text-base">
                                    Kelola informasi akun, identitas, dan keamanan password kamu di TaskFlow.
                                </p>

                            </div>

                        </div>


                        {{-- Dashboard Button --}}
                        <div class="shrink-0">

                            <a
                                href="{{ route('dashboard') }}"
                                class="group inline-flex items-center gap-2 rounded-2xl bg-indigo-500 px-5 py-3 text-sm font-semibold text-white transition-all hover:-translate-y-0.5 hover:bg-indigo-400 hover:shadow-[0_0_30px_rgba(99,102,241,0.5)]"
                            >

                                <svg
                                    class="h-4 w-4 transition-transform duration-300 group-hover:-translate-x-1"
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

                                Dashboard

                            </a>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- INFORMASI PROFIL --}}
                {{-- ================================================= --}}

                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    {{-- Card Header --}}
                    <div class="border-b border-slate-100 bg-slate-50/50 px-6 py-5">

                        <div class="flex items-center gap-4">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 ring-1 ring-inset ring-indigo-100">

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

                                <h3 class="font-bold text-slate-900">
                                    Informasi Profil
                                </h3>

                                <p class="mt-0.5 text-xs font-medium text-slate-400">
                                    Perbarui nama dan alamat email akunmu.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="px-6 py-7 md:px-8">

                        <form method="post" action="{{ route('profile.update') }}" class="max-w-2xl">

                            @csrf
                            @method('patch')


                            {{-- Nama --}}
                            <div>

                                <label
                                    for="name"
                                    class="flex items-center gap-1.5 text-sm font-bold text-slate-700"
                                >
                                    Nama
                                    <span class="text-rose-500">*</span>
                                </label>

                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    value="{{ old('name', $user->name) }}"
                                    required
                                    autofocus
                                    autocomplete="name"
                                    class="mt-2.5 block w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-900 shadow-sm transition duration-200 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10"
                                >

                                @if ($errors->get('name'))
                                    <p class="mt-2 flex items-center gap-1.5 text-sm font-medium text-rose-600">
                                        {{ $errors->first('name') }}
                                    </p>
                                @endif

                            </div>


                            {{-- Email --}}
                            <div class="mt-6">

                                <label
                                    for="email"
                                    class="flex items-center gap-1.5 text-sm font-bold text-slate-700"
                                >
                                    Email
                                    <span class="text-rose-500">*</span>
                                </label>

                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    value="{{ old('email', $user->email) }}"
                                    required
                                    autocomplete="username"
                                    class="mt-2.5 block w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-900 shadow-sm transition duration-200 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10"
                                >

                                @if ($errors->get('email'))
                                    <p class="mt-2 flex items-center gap-1.5 text-sm font-medium text-rose-600">
                                        {{ $errors->first('email') }}
                                    </p>
                                @endif

                            </div>


                            {{-- Save --}}
                            <div class="mt-7 flex flex-wrap items-center gap-4">

                                <button
                                    type="submit"
                                    class="group inline-flex items-center gap-2 rounded-xl bg-indigo-500 px-5 py-3 text-sm font-bold text-white shadow-md shadow-indigo-500/20 transition-all duration-200 hover:-translate-y-0.5 hover:bg-indigo-400 hover:shadow-lg hover:shadow-indigo-500/30 focus:outline-none focus:ring-4 focus:ring-indigo-500/20"
                                >

                                    <svg
                                        class="h-4 w-4 transition-transform duration-200 group-hover:scale-110"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2.5"
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

                                    <p class="flex items-center gap-2 text-sm font-semibold text-emerald-600">

                                        <span class="flex h-5 w-5 items-center justify-center rounded-full bg-emerald-100">
                                            <svg
                                                class="h-3 w-3"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="3"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M5 13l4 4L19 7"
                                                />
                                            </svg>
                                        </span>

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

                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    {{-- Card Header --}}
                    <div class="border-b border-slate-100 bg-slate-50/50 px-6 py-5">

                        <div class="flex items-center gap-4">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50 text-violet-600 ring-1 ring-inset ring-violet-100">

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

                                <h3 class="font-bold text-slate-900">
                                    Keamanan Akun
                                </h3>

                                <p class="mt-0.5 text-xs font-medium text-slate-400">
                                    Perbarui password untuk menjaga keamanan akunmu.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="px-6 py-7 md:px-8">

                        <form method="post" action="{{ route('password.update') }}" class="max-w-2xl">

                            @csrf
                            @method('put')


                            {{-- Password Lama --}}
                            <div>

                                <label
                                    for="current_password"
                                    class="text-sm font-bold text-slate-700"
                                >
                                    Password Saat Ini
                                </label>

                                <input
                                    id="current_password"
                                    name="current_password"
                                    type="password"
                                    autocomplete="current-password"
                                    class="mt-2.5 block w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-900 shadow-sm transition duration-200 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10"
                                >

                                @if ($errors->updatePassword->get('current_password'))
                                    <p class="mt-2 text-sm font-medium text-rose-600">
                                        {{ $errors->updatePassword->first('current_password') }}
                                    </p>
                                @endif

                            </div>


                            {{-- Password Baru --}}
                            <div class="mt-6">

                                <label
                                    for="password"
                                    class="text-sm font-bold text-slate-700"
                                >
                                    Password Baru
                                </label>

                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    autocomplete="new-password"
                                    class="mt-2.5 block w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-900 shadow-sm transition duration-200 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10"
                                >

                                @if ($errors->updatePassword->get('password'))
                                    <p class="mt-2 text-sm font-medium text-rose-600">
                                        {{ $errors->updatePassword->first('password') }}
                                    </p>
                                @endif

                            </div>


                            {{-- Konfirmasi --}}
                            <div class="mt-6">

                                <label
                                    for="password_confirmation"
                                    class="text-sm font-bold text-slate-700"
                                >
                                    Konfirmasi Password Baru
                                </label>

                                <input
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    type="password"
                                    autocomplete="new-password"
                                    class="mt-2.5 block w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-900 shadow-sm transition duration-200 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10"
                                >

                            </div>


                            {{-- Save --}}
                            <div class="mt-7 flex flex-wrap items-center gap-4">

                                <button
                                    type="submit"
                                    class="group inline-flex items-center gap-2 rounded-xl bg-indigo-500 px-5 py-3 text-sm font-bold text-white shadow-md shadow-indigo-500/20 transition-all duration-200 hover:-translate-y-0.5 hover:bg-indigo-400 hover:shadow-lg hover:shadow-indigo-500/30 focus:outline-none focus:ring-4 focus:ring-indigo-500/20"
                                >

                                    <svg
                                        class="h-4 w-4 transition-transform duration-200 group-hover:scale-110"
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

                                    <p class="flex items-center gap-2 text-sm font-semibold text-emerald-600">

                                        <span class="flex h-5 w-5 items-center justify-center rounded-full bg-emerald-100">
                                            <svg
                                                class="h-3 w-3"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="3"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M5 13l4 4L19 7"
                                                />
                                            </svg>
                                        </span>

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

                <div class="relative overflow-hidden rounded-2xl border border-indigo-100 bg-gradient-to-r from-indigo-50 via-indigo-50/70 to-white px-6 py-5 shadow-sm">

                    <div class="absolute -right-10 -top-16 h-32 w-32 rounded-full bg-indigo-200/30 blur-2xl"></div>

                    <div class="relative flex items-start gap-4">

                        <div class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">

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

                            <p class="font-bold text-indigo-900">
                                Tips keamanan
                            </p>

                            <p class="mt-1 text-sm font-medium leading-relaxed text-indigo-700/80">
                                Gunakan password yang kuat, unik, dan jangan membagikannya kepada orang lain.
                            </p>

                        </div>

                    </div>

                </div>


            </div>

        </main>

    </div>

</div>


</x-app-layout>
