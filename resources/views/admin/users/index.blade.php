<x-app-layout>

    @php
        $users = $users ?? collect();

        $totalUsers = $users->count();
        $totalAdmins = $users->where('role', 'admin')->count();
        $totalRegularUsers = $users->where('role', 'user')->count();
    @endphp


    <div class="min-h-screen bg-gray-50 py-8">

        <div class="mx-auto max-w-7xl space-y-6 px-6">


            {{-- ========================================================= --}}
            {{-- HEADER HALAMAN --}}
            {{-- ========================================================= --}}

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                {{-- Judul --}}
                <div>

                    <p class="text-sm font-medium text-indigo-600">
                        TaskFlow Admin
                    </p>

                    <h2 class="mt-1 text-2xl font-bold text-gray-900">
                        Manajemen Pengguna
                    </h2>

                </div>


                {{-- Navigasi --}}
                <div class="flex items-center gap-3">

                    {{-- Kembali ke Dashboard Admin --}}
                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-600"
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

                        Dashboard Admin

                    </a>


                    {{-- Label Admin --}}
                    <span class="hidden rounded-full bg-indigo-50 px-3 py-1.5 text-sm font-medium text-indigo-700 md:inline-flex">
                        Admin Panel
                    </span>

                </div>

            </div>



            {{-- ========================================================= --}}
            {{-- HERO --}}
            {{-- ========================================================= --}}

            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-600 via-indigo-600 to-violet-700 p-6 text-white shadow-sm md:p-8">

                <div class="relative z-10 flex flex-col justify-between gap-6 md:flex-row md:items-center">

                    <div>

                        <p class="text-sm font-medium text-indigo-100">
                            Kelola akun TaskFlow
                        </p>

                        <h1 class="mt-2 text-3xl font-bold tracking-tight md:text-4xl">
                            Manajemen Pengguna
                        </h1>

                        <p class="mt-3 max-w-2xl text-sm text-indigo-100 md:text-base">
                            Kelola akun admin dan pengguna yang terdaftar di aplikasi TaskFlow.
                        </p>

                    </div>


                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-white/15 text-4xl backdrop-blur-sm">
                        👥
                    </div>

                </div>


                {{-- Decorative circles --}}
                <div class="absolute -right-10 -top-16 h-52 w-52 rounded-full bg-white/10"></div>

                <div class="absolute -bottom-24 right-24 h-48 w-48 rounded-full bg-violet-400/20"></div>

            </div>



            {{-- ========================================================= --}}
            {{-- NOTIFIKASI SUCCESS --}}
            {{-- ========================================================= --}}

            @if (session('success'))

                <div class="flex items-center gap-3 rounded-2xl border border-emerald-100 bg-emerald-50 px-5 py-4 text-emerald-700 shadow-sm">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">

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
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

                    </div>


                    <p class="text-sm font-medium">
                        {{ session('success') }}
                    </p>

                </div>

            @endif



            {{-- ========================================================= --}}
            {{-- NOTIFIKASI ERROR --}}
            {{-- ========================================================= --}}

            @if (session('error'))

                <div class="flex items-center gap-3 rounded-2xl border border-rose-100 bg-rose-50 px-5 py-4 text-rose-700 shadow-sm">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-rose-100 text-rose-600">

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


                    <p class="text-sm font-medium">
                        {{ session('error') }}
                    </p>

                </div>

            @endif



            {{-- ========================================================= --}}
            {{-- ERROR VALIDASI --}}
            {{-- ========================================================= --}}

            @if ($errors->any())

                <div class="rounded-2xl border border-rose-100 bg-rose-50 px-5 py-4 text-rose-700 shadow-sm">

                    <p class="text-sm font-semibold">
                        Terjadi kesalahan:
                    </p>


                    <ul class="mt-2 list-inside list-disc text-sm">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif



            {{-- ========================================================= --}}
            {{-- STATISTIK --}}
            {{-- ========================================================= --}}

            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">


                {{-- TOTAL USER --}}
                <div class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Total User
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-900">
                                {{ $totalUsers }}
                            </p>

                            <p class="mt-2 text-xs text-gray-400">
                                Semua akun terdaftar
                            </p>

                        </div>


                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 transition group-hover:bg-indigo-600 group-hover:text-white">

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
                <div class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Total Admin
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-900">
                                {{ $totalAdmins }}
                            </p>

                            <p class="mt-2 text-xs text-gray-400">
                                Pengelola aplikasi
                            </p>

                        </div>


                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50 text-violet-600 transition group-hover:bg-violet-600 group-hover:text-white">

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



                {{-- TOTAL PENGGUNA --}}
                <div class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Total Pengguna
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-900">
                                {{ $totalRegularUsers }}
                            </p>

                            <p class="mt-2 text-xs text-gray-400">
                                Akun pengguna biasa
                            </p>

                        </div>


                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-teal-50 text-teal-600 transition group-hover:bg-teal-600 group-hover:text-white">

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

            </div>



            {{-- ========================================================= --}}
            {{-- DAFTAR PENGGUNA --}}
            {{-- ========================================================= --}}

            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">


                {{-- Header daftar --}}
                <div class="flex flex-col gap-4 border-b border-gray-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

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
                                Daftar Pengguna
                            </h3>

                            <p class="text-xs text-gray-400">
                                Semua akun yang terdaftar di TaskFlow
                            </p>

                        </div>

                    </div>


                    <div class="flex items-center gap-3">

                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-500">
                            {{ $totalUsers }} user
                        </span>


                        <a
                            href="{{ route('admin.users.create') }}"
                            class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-600 px-3 py-2 text-sm font-medium text-white transition hover:bg-indigo-700"
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
                                    d="M12 4.5v15m7.5-7.5h-15"
                                />
                            </svg>

                            Tambah User

                        </a>

                    </div>

                </div>



                {{-- ===================================================== --}}
                {{-- LIST USER --}}
                {{-- ===================================================== --}}

                @forelse ($users as $user)

                    @php

                        $userName = $user->name ?? 'User';

                        $userRole = $user->role ?? 'user';

                        $isAdmin = strtolower($userRole) === 'admin';

                        $initial = strtoupper(substr($userName, 0, 1));

                    @endphp


                    <div class="group border-b border-gray-50 px-6 py-5 transition last:border-0 hover:bg-gray-50/70">

                        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">


                            {{-- Informasi user --}}
                            <div class="flex min-w-0 items-center gap-4">

                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 text-lg font-bold text-white">
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



                            {{-- Detail dan aksi --}}
                            <div class="flex flex-wrap items-center gap-3 md:justify-end">


                                {{-- ROLE --}}
                                @if ($isAdmin)

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-violet-50 px-3 py-1.5 text-xs font-medium text-violet-700">

                                        <span class="h-1.5 w-1.5 rounded-full bg-violet-500"></span>

                                        Admin

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 px-3 py-1.5 text-xs font-medium text-indigo-700">

                                        <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>

                                        User

                                    </span>

                                @endif



                                {{-- TANGGAL --}}
                                <div class="hidden text-right sm:block">

                                    <p class="text-[11px] font-medium uppercase tracking-wide text-gray-400">
                                        Terdaftar
                                    </p>

                                    <p class="mt-1 text-sm text-gray-600">

                                        {{ $user->created_at
                                            ? $user->created_at->translatedFormat('d M Y')
                                            : '-' }}

                                    </p>

                                </div>



                                {{-- EDIT --}}
                                <a
                                    href="{{ route('admin.users.edit', $user) }}"
                                    class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-50 px-3 py-2 text-sm font-medium text-indigo-600 transition hover:bg-indigo-100"
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
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 7.5-7.5z"
                                        />
                                    </svg>

                                    Edit

                                </a>



                                {{-- HAPUS --}}
                                @if ($user->id !== auth()->id())

                                    <form
                                        method="POST"
                                        action="{{ route('admin.users.destroy', $user) }}"
                                        onsubmit="return confirm('Yakin ingin menghapus user ini?');"
                                    >

                                        @csrf

                                        @method('DELETE')


                                        <button
                                            type="submit"
                                            class="inline-flex items-center gap-1.5 rounded-lg bg-rose-50 px-3 py-2 text-sm font-medium text-rose-600 transition hover:bg-rose-100"
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
                                                    d="M6 7h12M9.5 7V5a1.5 1.5 0 011.5-1.5h2A1.5 1.5 0 0114.5 5v2m-7 0l.6 11.4a2 2 0 002 1.9h3.8a2 2 0 002-1.9L16.5 7"
                                                />
                                            </svg>

                                            Hapus

                                        </button>

                                    </form>

                                @else

                                    <span class="rounded-lg bg-gray-50 px-3 py-2 text-xs text-gray-400">
                                        Akun Anda
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>


                @empty


                    {{-- ================================================= --}}
                    {{-- EMPTY STATE --}}
                    {{-- ================================================= --}}

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
                            href="{{ route('admin.users.create') }}"
                            class="mt-5 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700"
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
                                    d="M12 4.5v15m7.5-7.5h-15"
                                />
                            </svg>

                            Tambah User

                        </a>

                    </div>

                @endforelse

            </div>



            {{-- ========================================================= --}}
            {{-- INFORMASI BAWAH --}}
            {{-- ========================================================= --}}

            <div class="rounded-2xl border border-indigo-100 bg-indigo-50 px-6 py-4">

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
                            Catatan admin
                        </p>

                        <p class="mt-1 text-sm text-indigo-700">
                            Jangan hapus akun admin yang sedang kamu gunakan.
                        </p>

                    </div>

                </div>

            </div>


        </div>

    </div>

</x-app-layout>