<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-indigo-600">
                    TaskFlow Admin
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-gray-900">
                    Dashboard Admin
                </h2>
            </div>

            <span class="inline-flex w-fit items-center gap-2 rounded-full bg-indigo-50 px-3 py-1.5 text-sm font-medium text-indigo-700">
                <span class="h-2 w-2 rounded-full bg-indigo-500"></span>
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

    <div class="min-h-screen bg-gray-50 py-8">
        <div class="mx-auto w-full max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            {{-- Banner admin --}}
            <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-indigo-600 to-violet-700 px-6 py-8 text-white shadow-sm sm:px-8 sm:py-10">
                <div class="relative z-10 max-w-2xl">
                    <p class="text-sm font-medium text-indigo-100">
                        Selamat datang kembali
                    </p>

                    <h1 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">
                        Halo, {{ Auth::user()->name }}!
                    </h1>

                    <p class="mt-4 max-w-xl text-sm leading-6 text-indigo-100 sm:text-base">
                        Kelola akun pengguna TaskFlow dengan mudah dari dashboard admin.
                    </p>

                    <a
                        href="{{ url('/admin/users') }}"
                        class="mt-6 inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-indigo-700 shadow-sm transition hover:bg-indigo-50"
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

                {{-- Dekorasi banner --}}
                <div class="absolute -right-20 -top-24 h-72 w-72 rounded-full bg-white/10"></div>
                <div class="absolute -bottom-32 right-20 h-64 w-64 rounded-full bg-violet-400/20"></div>
                <div class="absolute right-10 top-1/2 hidden -translate-y-1/2 text-7xl opacity-20 lg:block">
                    
                </div>
            </section>

            {{-- Statistik pengguna --}}
            <section class="grid grid-cols-1 gap-5 md:grid-cols-3">

                {{-- Total user --}}
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

                {{-- Total admin --}}
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

                {{-- Total pengguna biasa --}}
                <div class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Pengguna Biasa
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-900">
                                {{ $totalRegularUsers }}
                            </p>

                            <p class="mt-2 text-xs text-gray-400">
                                Akun pengguna TaskFlow
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

            </section>

            {{-- Akses manajemen user --}}
            <section class="rounded-2xl border border-indigo-100 bg-indigo-50 p-5 sm:p-6">
                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-start gap-4">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white text-indigo-600 shadow-sm">
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
                        class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700"
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

            {{-- Daftar user terbaru --}}
            <section class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">

                {{-- Header daftar --}}
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

                {{-- List user --}}
                @forelse ($recentUsers as $user)
                    @php
                        $userName = $user->name ?? 'User';
                        $userRole = $user->role ?? 'user';
                        $isAdmin = strtolower($userRole) === 'admin';
                        $initial = strtoupper(substr($userName, 0, 1));
                        $taskCount = $user->tasks_count ?? optional($user->tasks)->count() ?? 0;
                    @endphp

                    <div class="group border-b border-gray-50 px-5 py-5 transition last:border-0 hover:bg-gray-50/70 sm:px-6">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                            {{-- Identitas user --}}
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

                            {{-- Detail user --}}
                            <div class="flex flex-wrap items-center gap-3 sm:justify-end">
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

                                <span class="text-xs text-gray-400">
                                    {{ $user->created_at
                                        ? $user->created_at->translatedFormat('d M Y')
                                        : '-' }}
                                </span>

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-lg px-3 py-2 text-sm font-medium {{ $taskCount > 0 ? 'bg-indigo-50 text-indigo-600' : 'bg-gray-100 text-gray-400' }}"
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
                            class="mt-5 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700"
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

                {{-- Footer daftar --}}
                @if ($users->count() > 5)
                    <div class="border-t border-gray-100 bg-gray-50 px-6 py-4 text-center">
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

            {{-- Catatan admin --}}
            <section class="rounded-2xl border border-gray-100 bg-white px-5 py-5 shadow-sm sm:px-6">
                <div class="flex items-start gap-3">
                    <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
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
                        <p class="font-medium text-gray-900">
                            Akses Admin
                        </p>

                        <p class="mt-1 text-sm leading-6 text-gray-500">
                            Admin hanya mengelola akun pengguna. Pengelolaan task tetap dilakukan oleh masing-masing user.
                        </p>
                    </div>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>