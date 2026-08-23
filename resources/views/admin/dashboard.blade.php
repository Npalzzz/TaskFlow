<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <p class="text-sm font-semibold text-indigo-500">
                    TaskFlow Admin
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-gray-900">
                    Dashboard Admin
                </h2>
            </div>

            <span class="inline-flex w-fit items-center gap-2 rounded-full bg-indigo-50 px-3.5 py-1.5 text-sm font-semibold text-indigo-700 ring-1 ring-indigo-100">
                <span class="h-2 w-2 rounded-full bg-indigo-500 shadow-sm shadow-indigo-300"></span>
                Mode Admin
            </span>

        </div>
    </x-slot>


    @php
        $users = $users ?? collect();

        $totalUsers = $totalUsers ?? $users->count();
        $totalAdmins = $users->where('role', 'admin')->count();
        $totalRegularUsers = $users->where('role', 'user')->count();

        $recentUsers = $users->take(5);
    @endphp


    {{-- ========================================================= --}}
    {{-- MAIN --}}
    {{-- ========================================================= --}}

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-gray-50 to-indigo-50/20 py-8">

        <div class="mx-auto w-full max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">


            {{-- ================================================= --}}
            {{-- TOP BAR --}}
            {{-- ================================================= --}}

            <div class="flex items-center justify-end">

                <div class="flex items-center gap-3">

                    {{-- ADMIN INFO --}}
                    <div class="hidden items-center gap-3 rounded-2xl border border-gray-100 bg-white px-4 py-2.5 shadow-sm transition hover:shadow-md sm:flex">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-50 font-bold text-indigo-600">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>

                        <div class="min-w-0">

                            <p class="max-w-36 truncate text-sm font-semibold text-gray-900">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-xs text-gray-400">
                                Administrator
                            </p>

                        </div>

                    </div>


                    {{-- LOGOUT --}}
                    <form method="POST" action="{{ route('logout') }}">

                        @csrf

                        <button
                            type="submit"
                            class="group flex h-11 items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 text-sm font-medium text-gray-600 shadow-sm transition duration-200 hover:border-rose-200 hover:bg-rose-50 hover:text-rose-600 focus:outline-none focus:ring-4 focus:ring-rose-500/10"
                        >

                            <svg
                                class="h-5 w-5 transition duration-200 group-hover:translate-x-0.5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M18 15l3-3m0 0l-3-3m3 3H9"
                                />
                            </svg>

                            <span class="hidden sm:inline">
                                Keluar
                            </span>

                        </button>

                    </form>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- HERO --}}
            {{-- ================================================= --}}

            <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-950 via-[#111936] to-indigo-950 px-6 py-8 text-white shadow-xl shadow-indigo-950/20 sm:px-8 sm:py-10">

                <div class="relative z-10 flex flex-col gap-7 lg:flex-row lg:items-center lg:justify-between">

                    <div class="max-w-2xl">

                        {{-- ADMIN BADGE --}}
                        <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 text-xs font-semibold text-indigo-200 ring-1 ring-white/10 backdrop-blur-sm">

                            <span class="h-1.5 w-1.5 rounded-full bg-indigo-300 shadow-sm shadow-indigo-300"></span>

                            Administrator

                        </div>


                        <p class="mt-4 text-sm font-medium text-indigo-300">
                            Selamat datang kembali
                        </p>


                        <h1 class="mt-1 text-3xl font-bold tracking-tight sm:text-4xl">
                            Halo, {{ Auth::user()->name }}!
                        </h1>


                        <p class="mt-4 max-w-xl text-sm leading-6 text-slate-300 sm:text-base">
                            Pantau pengguna dan kelola akun TaskFlow dengan mudah melalui pusat administrasi.
                        </p>


                        {{-- BUTTON --}}
                        <a
                            href="{{ url('/admin/users') }}"
                            class="mt-6 inline-flex items-center gap-2 rounded-xl bg-indigo-500 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-950/30 transition duration-200 hover:-translate-y-0.5 hover:bg-indigo-400 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-indigo-300/20"
                        >

                            Buka Manajemen User

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
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>

                        </a>

                    </div>

                </div>


                {{-- Decorative Elements --}}
                <div class="absolute -right-20 -top-24 h-72 w-72 rounded-full bg-indigo-400/10"></div>

                <div class="absolute -bottom-32 right-20 h-64 w-64 rounded-full bg-indigo-500/10"></div>

                <div class="absolute -left-24 bottom-[-100px] h-48 w-48 rounded-full bg-blue-500/5"></div>

            </section>


            {{-- ================================================= --}}
            {{-- STATISTICS --}}
            {{-- ================================================= --}}

            <section class="grid grid-cols-1 gap-5 md:grid-cols-3">


                {{-- TOTAL USER --}}
                <div class="group rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-indigo-950/5">

                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Total User
                            </p>

                            <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900">
                                {{ $totalUsers }}
                            </p>

                            <p class="mt-2 text-xs text-gray-400">
                                Semua akun terdaftar
                            </p>

                        </div>


                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 transition duration-300 group-hover:bg-indigo-600 group-hover:text-white">

                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-8a4 4 0 110 8 4 4 0 010-8zm6 4a3 3 0 10-6 0 3 3 0 006 0z"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- TOTAL ADMIN --}}
                <div class="group rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-indigo-950/5">

                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Total Admin
                            </p>

                            <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900">
                                {{ $totalAdmins }}
                            </p>

                            <p class="mt-2 text-xs text-gray-400">
                                Pengelola aplikasi
                            </p>

                        </div>


                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 transition duration-300 group-hover:bg-indigo-600 group-hover:text-white">

                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 14a4 4 0 100-8 4 4 0 000 8zm-7 6a7 7 0 0114 0"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- USER BIASA --}}
                <div class="group rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-indigo-950/5">

                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Pengguna Biasa
                            </p>

                            <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900">
                                {{ $totalRegularUsers }}
                            </p>

                            <p class="mt-2 text-xs text-gray-400">
                                Akun pengguna TaskFlow
                            </p>

                        </div>


                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 transition duration-300 group-hover:bg-indigo-600 group-hover:text-white">

                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m7-10a4 4 0 100-8 4 4 0 000 8zm7-5a3 3 0 110 6m0 0a4 4 0 014 4v1"
                                />
                            </svg>

                        </div>

                    </div>

                </div>

            </section>


            {{-- ================================================= --}}
            {{-- QUICK ACCESS --}}
            {{-- ================================================= --}}

            <section class="relative overflow-hidden rounded-3xl border border-indigo-100 bg-gradient-to-br from-indigo-50 via-white to-slate-50 p-5 shadow-sm sm:p-6">

                <div class="relative z-10 flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-start gap-4">

                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white text-indigo-600 shadow-sm ring-1 ring-indigo-100">

                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 4.5a3.75 3.75 0 100 7.5 3.75 3.75 0 000-7.5zM5.25 20.25a6.75 6.75 0 0113.5 0"
                                />
                            </svg>

                        </div>


                        <div>

                            <h3 class="font-semibold text-indigo-950">
                                Kelola pengguna TaskFlow
                            </h3>

                            <p class="mt-1 text-sm leading-6 text-indigo-700">
                                Tambahkan user baru, edit data pengguna, atau hapus akun yang sudah tidak diperlukan.
                            </p>

                        </div>

                    </div>


                    <a
                        href="{{ url('/admin/users') }}"
                        class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-indigo-700 px-5 py-2.5 text-sm font-semibold text-white shadow-md shadow-indigo-950/20 transition duration-200 hover:-translate-y-0.5 hover:bg-indigo-800 hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-indigo-500/20"
                    >

                        Manajemen User

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
                                d="M9 5l7 7-7 7"
                            />
                        </svg>

                    </a>

                </div>

            </section>


            {{-- ================================================= --}}
            {{-- RECENT USERS --}}
            {{-- ================================================= --}}

            <section class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm">


                {{-- HEADER --}}
                <div class="flex flex-col gap-4 border-b border-gray-100 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

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
                                    d="M18 20a6 6 0 00-12 0m9-11a3 3 0 11-6 0 3 3 0 016 0zm3 11a4 4 0 00-3-3.87M18 6a3 3 0 010 6"
                                />
                            </svg>

                        </div>


                        <div>

                            <h3 class="font-semibold text-gray-900">
                                User Terbaru
                            </h3>

                            <p class="text-xs text-gray-400">
                                Lima pengguna terbaru yang terdaftar
                            </p>

                        </div>

                    </div>


                    <div class="flex items-center gap-3">

                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-500">
                            {{ $totalUsers }} user
                        </span>

                        <a
                            href="{{ url('/admin/users') }}"
                            class="text-sm font-semibold text-indigo-600 transition hover:text-indigo-800"
                        >
                            Lihat semua
                        </a>

                    </div>

                </div>


                {{-- USER LIST --}}
                @forelse ($recentUsers as $user)

                    @php
                        $userName = $user->name ?? 'User';
                        $userRole = $user->role ?? 'user';
                        $isAdmin = strtolower($userRole) === 'admin';
                        $initial = strtoupper(substr($userName, 0, 1));
                        $taskCount = $user->tasks_count ?? optional($user->tasks)->count() ?? 0;
                    @endphp


                    <div class="group border-b border-gray-50 px-5 py-5 transition duration-200 last:border-0 hover:bg-indigo-50/20 sm:px-6">

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                            {{-- IDENTITAS --}}
                            <div class="flex min-w-0 items-center gap-4">

                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-slate-800 to-indigo-700 text-lg font-bold text-white shadow-sm shadow-indigo-950/20">
                                    {{ $initial }}
                                </div>


                                <div class="min-w-0">

                                    <p class="truncate font-semibold text-gray-900">
                                        {{ $userName }}
                                    </p>

                                    <p class="truncate text-sm text-gray-400">
                                        {{ $user->email }}
                                    </p>

                                </div>

                            </div>


                            {{-- DETAIL --}}
                            <div class="flex flex-wrap items-center gap-3 sm:justify-end">

                                @if ($isAdmin)

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-indigo-100 px-3 py-1.5 text-xs font-semibold text-indigo-800">
                                        <span class="h-1.5 w-1.5 rounded-full bg-indigo-600"></span>
                                        Admin
                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700">
                                        <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                                        User
                                    </span>

                                @endif


                                <span class="text-xs text-gray-400">
                                    {{ $user->created_at
                                        ? $user->created_at->translatedFormat('d M Y')
                                        : '-' }}
                                </span>


                                <span
                                    class="inline-flex items-center gap-1.5 rounded-xl px-3 py-2 text-sm font-medium transition
                                    {{ $taskCount > 0
                                        ? 'bg-indigo-50 text-indigo-700 group-hover:bg-indigo-100'
                                        : 'bg-gray-100 text-gray-400' }}"
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
                                            d="M9 12h6m-6 4h6M9 8h1m5 12H7a2 2 0 01-2-2V6a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V18a2 2 0 01-2 2z"
                                        />
                                    </svg>

                                    {{ $taskCount }} Tugas

                                </span>

                            </div>

                        </div>

                    </div>


                @empty

                    {{-- EMPTY STATE --}}
                    <div class="flex flex-col items-center justify-center px-6 py-16 text-center">

                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-500">

                            <svg
                                class="h-8 w-8"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M18 20a6 6 0 00-12 0m9-11a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                            </svg>

                        </div>

                        <p class="mt-5 font-semibold text-gray-900">
                            Belum ada pengguna
                        </p>

                        <p class="mt-1 text-sm text-gray-400">
                            Tambahkan pengguna pertama ke TaskFlow.
                        </p>

                        <a
                            href="{{ url('/admin/users') }}"
                            class="mt-5 inline-flex items-center gap-2 rounded-xl bg-indigo-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-indigo-800 hover:shadow-md"
                        >

                            Tambah User

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
                                    d="M12 4.5v15m7.5-7.5h-15"
                                />
                            </svg>

                        </a>

                    </div>

                @endforelse


                {{-- FOOTER --}}
                @if ($users->count() > 5)

                    <div class="border-t border-gray-100 bg-slate-50/70 px-6 py-4 text-center">

                        <a
                            href="{{ url('/admin/users') }}"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 transition hover:text-indigo-800"
                        >

                            Lihat semua {{ $users->count() }} user

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
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>

                        </a>

                    </div>

                @endif

            </section>


            {{-- ================================================= --}}
            {{-- ADMIN INFORMATION --}}
            {{-- ================================================= --}}

            <section class="rounded-3xl border border-indigo-100 bg-gradient-to-br from-indigo-50 to-slate-50 px-5 py-5 shadow-sm sm:px-6">

                <div class="flex items-start gap-3">

                    <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-indigo-600 shadow-sm">

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
                                d="M12 9v3.75m0 3.75h.007M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>

                    </div>


                    <div>

                        <p class="font-semibold text-indigo-950">
                            Akses Admin
                        </p>

                        <p class="mt-1 text-sm leading-6 text-indigo-700">
                            Admin hanya mengelola akun pengguna. Pengelolaan task tetap dilakukan oleh masing-masing user.
                        </p>

                    </div>

                </div>

            </section>


        </div>

    </div>

</x-app-layout>

