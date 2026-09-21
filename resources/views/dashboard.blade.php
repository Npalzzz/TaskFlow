<x-app-layout>
<x-slot name="header">
    <div></div>
</x-slot>

@php
    $totalTasks = $totalTasks ?? 0;
    $completedTasks = $completedTasks ?? 0;
    $dueSoonCount = $dueSoonCount ?? 0;
    $overdueCount = $overdueCount ?? 0;

    $tasks = $tasks ?? collect();
    $priorityTasks = $priorityTasks ?? collect();

    $categories = $categories ?? collect();

    $search = $search ?? '';
    $sort = $sort ?? 'latest';
    $category = $category ?? 'all';
@endphp

{{-- ========================================================= --}}
{{-- CUSTOM ANIMATIONS --}}
{{-- ========================================================= --}}
<style>
    @keyframes wave {
        0% { transform: rotate(0deg); }
        10% { transform: rotate(14deg); }
        20% { transform: rotate(-8deg); }
        30% { transform: rotate(14deg); }
        40% { transform: rotate(-4deg); }
        50% { transform: rotate(10deg); }
        60%, 100% { transform: rotate(0deg); }
    }

    .animate-wave {
        animation: wave 2.5s infinite;
        transform-origin: 70% 70%;
    }
</style>

{{-- ========================================================= --}}
{{-- LAYOUT --}}
{{-- ========================================================= --}}
<div class="min-h-screen overflow-x-hidden bg-slate-50" x-data="{ mobileMenuOpen: false }">

    {{-- ================================================= --}}
    {{-- MOBILE MENU --}}
    {{-- ================================================= --}}
    <div
        x-show="mobileMenuOpen"
        class="relative z-50 lg:hidden"
        role="dialog"
        aria-modal="true"
        style="display: none;"
    >

        {{-- BACKDROP --}}
        <div
            x-show="mobileMenuOpen"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm"
        ></div>

        {{-- MOBILE SIDEBAR --}}
        <div class="fixed inset-0 flex">

            <div
                x-show="mobileMenuOpen"
                @click.outside="mobileMenuOpen = false"
                x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                class="relative mr-10 flex w-full max-w-xs flex-1 flex-col bg-white shadow-xl sm:mr-16"
            >

                {{-- CLOSE BUTTON --}}
                <div class="absolute right-0 top-0 -mr-12 pt-4">
                    <button
                        @click="mobileMenuOpen = false"
                        type="button"
                        class="ml-1 flex h-10 w-10 items-center justify-center rounded-full bg-white/10 hover:bg-white/20 focus:outline-none"
                    >
                        <span class="sr-only">Tutup menu</span>

                        <svg
                            class="h-6 w-6 text-white"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>

                {{-- LOGO --}}
                <div class="flex h-20 shrink-0 items-center border-b border-gray-100 px-5 sm:px-6">
                    <div class="min-w-0">
                        <h1 class="text-xl font-bold tracking-tight text-slate-900">
                            Task<span class="text-indigo-600">Flow</span>
                        </h1>

                        <p class="truncate text-xs text-slate-400">
                            Kelola Tugas Sekolah Tanpa Ribet!
                        </p>
                    </div>
                </div>

                {{-- NAVIGATION --}}
                <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-5 sm:px-4 sm:py-6">

                    <a
                        href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 rounded-xl bg-indigo-50 px-4 py-3 text-sm font-semibold text-indigo-700"
                    >
                        <svg
                            class="h-5 w-5 shrink-0"
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

                    <a
                        href="{{ route('tasks.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600"
                    >
                        <svg
                            class="h-5 w-5 shrink-0"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v11a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"
                            />
                            <rect
                                x="9"
                                y="3"
                                width="6"
                                height="4"
                                rx="1"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12h6M9 16h4"
                            />
                        </svg>

                        Daftar Tugas
                    </a>

                    <a
                        href="{{ route('tasks.create') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600"
                    >
                        <svg
                            class="h-5 w-5 shrink-0"
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

                    <a
                        href="{{ route('categories.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600"
                    >
                        <svg
                            class="h-5 w-5 shrink-0"
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

                    <a
                        href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600"
                    >
                        <svg
                            class="h-5 w-5 shrink-0"
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

                {{-- USER / LOGOUT --}}
                <div class="border-t border-gray-100 p-3 sm:p-4">

                    <div class="mb-3 flex items-center gap-3 px-2">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-indigo-100 font-semibold text-indigo-600">
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

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            type="submit"
                            class="group flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-500 transition hover:bg-rose-50 hover:text-rose-600"
                        >
                            <svg
                                class="h-5 w-5 shrink-0 transition-transform duration-200 group-hover:-translate-x-0.5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M10 6l-6 6 6 6"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 12h16"
                                />
                            </svg>

                            Keluar
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </div>


    {{-- ================================================= --}}
    {{-- MAIN FLEX --}}
    {{-- ================================================= --}}
    <div class="flex w-full min-w-0">

        {{-- ================================================= --}}
        {{-- SIDEBAR DESKTOP --}}
        {{-- ================================================= --}}
        <aside class="hidden w-64 shrink-0 p-4 sm:p-6 lg:block lg:p-8">

            <div class="sticky top-6 flex h-[calc(100vh-3rem)] flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- LOGO --}}
                <div class="flex h-20 shrink-0 items-center border-b border-gray-100 px-6">
                    <div class="min-w-0">
                        <h1 class="text-xl font-bold tracking-tight text-slate-900">
                            Task<span class="text-indigo-600">Flow</span>
                        </h1>

                        <p class="truncate text-xs text-slate-400">
                            Kelola Tugas Sekolah Tanpa Ribet!
                        </p>
                    </div>
                </div>

                {{-- NAV --}}
                <nav class="flex-1 space-y-1 overflow-y-auto px-4 py-6">

                    <a
                        href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 rounded-xl bg-indigo-50 px-4 py-3 text-sm font-semibold text-indigo-700"
                    >
                        <svg
                            class="h-5 w-5 shrink-0"
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

                    <a
                        href="{{ route('tasks.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600"
                    >
                        <svg
                            class="h-5 w-5 shrink-0"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v11a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"
                            />
                            <rect
                                x="9"
                                y="3"
                                width="6"
                                height="4"
                                rx="1"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12h6M9 16h4"
                            />
                        </svg>

                        Daftar Tugas
                    </a>

                    <a
                        href="{{ route('tasks.create') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600"
                    >
                        <svg
                            class="h-5 w-5 shrink-0"
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

                    <a
                        href="{{ route('categories.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600"
                    >
                        <svg
                            class="h-5 w-5 shrink-0"
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

                    <a
                        href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-indigo-600"
                    >
                        <svg
                            class="h-5 w-5 shrink-0"
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

                {{-- USER / LOGOUT --}}
                <div class="shrink-0 border-t border-gray-100 p-4">

                    <div class="mb-3 flex items-center gap-3 px-2">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-indigo-100 font-semibold text-indigo-600">
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

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            type="submit"
                            class="group flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-gray-500 transition hover:bg-rose-50 hover:text-rose-600"
                        >
                            <svg
                                class="h-5 w-5 shrink-0 transition-transform duration-200 group-hover:-translate-x-0.5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M10 6l-6 6 6 6"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 12h16"
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

            <div class="min-w-0 px-4 py-4 sm:px-6 sm:py-6 lg:p-8">

                {{-- ================================================= --}}
                {{-- TOP BAR --}}
                {{-- ================================================= --}}
                <div class="mb-5 flex items-center gap-3 sm:mb-6 lg:hidden">

                    {{-- MOBILE HEADER --}}
                    <button
                        type="button"
                        @click="mobileMenuOpen = true"
                        class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-500 shadow-sm transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-600"
                    >
                        <span class="sr-only">Buka menu utama</span>

                        <svg
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                        </svg>
                    </button>

                    <h1 class="truncate text-xl font-bold tracking-tight text-slate-900">
                        Task<span class="text-indigo-600">Flow</span>
                    </h1>

                </div>


                {{-- ================================================= --}}
                {{-- WELCOME SECTION --}}
                {{-- ================================================= --}}
                <section class="relative overflow-hidden rounded-[1.5rem] bg-slate-900 shadow-2xl shadow-indigo-900/10 sm:rounded-[2rem]">

                    <div class="absolute -right-20 -top-24 h-64 w-64 rounded-full bg-indigo-500/30 blur-[80px]"></div>

                    <div class="absolute -bottom-32 -left-20 h-64 w-64 rounded-full bg-violet-600/20 blur-[80px]"></div>


                    <div class="relative z-10 p-5 sm:p-7 md:p-9">

                        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between lg:gap-7">

                            <div class="min-w-0">

                                <div class="mb-3 flex items-center gap-2">

                                    <span class="h-2 w-2 shrink-0 rounded-full bg-emerald-400"></span>

                                    <span class="text-[11px] font-bold uppercase tracking-[0.16em] text-indigo-300 sm:text-xs sm:tracking-[0.18em]">
                                        Dashboard Pengguna
                                    </span>

                                </div>


                                <h1 class="text-2xl font-black tracking-tight text-white sm:text-3xl md:text-4xl">

                                    Halo, {{ Auth::user()->name }}!

                                    <span class="ml-1 inline-block animate-wave">
                                        👋
                                    </span>

                                </h1>


                                <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-400 sm:leading-7 md:text-base">
                                    Kelola tugas, pantau deadline, dan tetap terorganisir
                                    dengan TaskFlow.
                                </p>

                            </div>


                            {{-- BUTTONS --}}
                            <div class="flex w-full flex-col gap-2 sm:flex-row sm:flex-wrap lg:w-auto">

                                <a
                                    href="{{ route('tasks.create') }}"
                                    class="group inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-indigo-500 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-900/20 transition hover:-translate-y-0.5 hover:bg-indigo-400 sm:w-auto"
                                >
                                    <svg
                                        class="h-5 w-5 transition-transform duration-300 group-hover:rotate-90"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 4v16m8-8H4"
                                        />
                                    </svg>

                                    Tambah Task
                                </a>


                                <a
                                    href="{{ route('tasks.index') }}"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-white/10 bg-white/5 px-5 py-3.5 text-sm font-bold text-white backdrop-blur transition hover:bg-white/10 sm:w-auto"
                                >
                                    Lihat Semua
                                    <span>→</span>
                                </a>

                            </div>

                        </div>

                    </div>

                </section>


                {{-- ================================================= --}}
                {{-- STATUS SUMMARY --}}
                {{-- ================================================= --}}
                @php
                    $completionRate = $totalTasks > 0
                        ? round(($completedTasks / $totalTasks) * 100)
                        : 0;
                @endphp


                <section class="mt-5 grid grid-cols-1 gap-3 sm:mt-6 sm:grid-cols-2 sm:gap-4 xl:grid-cols-4">

                    {{-- TOTAL --}}
                    <div class="group relative min-h-[145px] overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg sm:min-h-[150px] sm:rounded-[1.75rem]">

                        <div class="pointer-events-none absolute -right-5 -top-5 h-24 w-24 rounded-full bg-indigo-50 transition-transform duration-500 group-hover:scale-110"></div>

                        <div class="relative z-10 flex h-full flex-col">

                            <div class="flex items-center justify-between gap-3">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600">

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
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                        />
                                    </svg>

                                </div>

                                <span class="relative z-10 text-xs font-bold text-slate-400">
                                    TOTAL
                                </span>

                            </div>


                            <div class="mt-auto min-w-0 pt-5">

                                <p class="truncate text-3xl font-black tracking-tight text-slate-800">
                                    {{ $totalTasks }}
                                </p>

                                <p class="mt-1 text-sm font-medium text-slate-500">
                                    Seluruh tugas
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- SELESAI --}}
                    <div class="group relative min-h-[145px] overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg sm:min-h-[150px] sm:rounded-[1.75rem]">

                        <div class="pointer-events-none absolute -right-5 -top-5 h-24 w-24 rounded-full bg-emerald-50 transition-transform duration-500 group-hover:scale-110"></div>

                        <div class="relative z-10 flex h-full flex-col">

                            <div class="flex items-center justify-between gap-3">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">

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
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                        />
                                    </svg>

                                </div>

                                <span class="relative z-10 text-xs font-bold text-emerald-500">
                                    {{ $completionRate }}%
                                </span>

                            </div>


                            <div class="mt-auto min-w-0 pt-5">

                                <p class="truncate text-3xl font-black tracking-tight text-slate-800">
                                    {{ $completedTasks }}
                                </p>

                                <p class="mt-1 text-sm font-medium text-slate-500">
                                    Tugas selesai
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- DEADLINE --}}
                    <div class="group relative min-h-[145px] overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg sm:min-h-[150px] sm:rounded-[1.75rem]">

                        <div class="pointer-events-none absolute -right-5 -top-5 h-24 w-24 rounded-full bg-rose-50 transition-transform duration-500 group-hover:scale-110"></div>

                        <div class="relative z-10 flex h-full flex-col">

                            <div class="flex items-center justify-between gap-3">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-rose-100 text-rose-600">

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
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                        />
                                    </svg>

                                </div>

                                <span class="relative z-10 text-xs font-bold text-rose-500">
                                    H-7
                                </span>

                            </div>


                            <div class="mt-auto min-w-0 pt-5">

                                <p class="truncate text-3xl font-black tracking-tight text-slate-800">
                                    {{ $dueSoonCount }}
                                </p>

                                <p class="mt-1 text-sm font-medium text-slate-500">
                                    Deadline terdekat
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- OVERDUE --}}
                    <div class="group relative min-h-[145px] overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg sm:min-h-[150px] sm:rounded-[1.75rem]">

                        <div class="pointer-events-none absolute -right-10 -top-10 h-36 w-36 rounded-full bg-red-50 transition-transform duration-500 group-hover:scale-110"></div>

                        <div class="relative z-10 flex h-full flex-col">

                            <div class="flex items-center justify-between gap-3">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-red-100 text-red-600">

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
                                            d="M12 9v3.75m0 3.75h.008M10.29 3.86l-7.5 13A1.5 1.5 0 004.09 19h15.82a1.5 1.5 0 001.3-2.25l-7.5-13a1.5 1.5 0 00-2.6 0z"
                                        />
                                    </svg>

                                </div>

                                <span class="relative z-10 text-xs font-bold text-red-500">
                                    PERHATIAN
                                </span>

                            </div>


                            <div class="mt-auto min-w-0 pt-5">

                                <p class="truncate text-3xl font-black tracking-tight text-slate-800">
                                    {{ $overdueCount }}
                                </p>

                                <p class="mt-1 text-sm font-medium text-slate-500">
                                    Tugas overdue
                                </p>

                            </div>

                        </div>

                    </div>

                </section>


                {{-- ================================================= --}}
                {{-- PROGRESS --}}
                {{-- ================================================= --}}
                <section class="mt-5 rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm sm:mt-6 sm:rounded-[1.75rem] sm:p-6">

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        <div class="min-w-0">

                            <div class="flex items-center gap-2">

                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                                    ✓
                                </span>

                                <h3 class="font-bold text-slate-900">
                                    Progress Tugas
                                </h3>

                            </div>

                            <p class="mt-2 text-sm font-medium text-slate-400">
                                {{ $completedTasks }} dari {{ $totalTasks }} tugas telah diselesaikan.
                            </p>

                        </div>


                        <div class="shrink-0 text-left sm:text-right">

                            <span class="text-2xl font-black text-indigo-600">
                                {{ $completionRate }}%
                            </span>

                        </div>

                    </div>


                    <div class="mt-5 h-3 overflow-hidden rounded-full bg-slate-100">

                        <div
                            class="h-full rounded-full bg-indigo-500 transition-all duration-700"
                            style="width: {{ $completionRate }}%"
                        ></div>

                    </div>

                </section>


                {{-- ================================================= --}}
                {{-- OVERDUE / DEADLINE ALERT --}}
                {{-- ================================================= --}}
                @if ($overdueCount > 0)

                    <section class="mt-5 overflow-hidden rounded-[1.5rem] border border-red-200 bg-white shadow-sm sm:mt-6 sm:rounded-[1.75rem]">

                        <div class="flex items-start gap-3 border-b border-red-100 bg-red-50 px-4 py-4 sm:items-center sm:gap-4 sm:px-6 sm:py-5">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-red-100 text-red-600">
                                🚨
                            </div>

                            <div class="min-w-0">

                                <h3 class="font-bold text-red-900">
                                    {{ $overdueCount }} tugas membutuhkan perhatian
                                </h3>

                                <p class="mt-0.5 text-sm font-medium text-red-600">
                                    Beberapa tugas telah melewati deadline.
                                </p>

                            </div>

                        </div>


                        <div>

                            @foreach ($overdueTasks as $task)

                                @php
                                    $deadline = \Carbon\Carbon::parse($task->deadline);
                                    $daysOverdue = $deadline->startOfDay()->diffInDays(now()->startOfDay());
                                    $categoryName = $task->category?->nama_kategori ?? 'Tanpa kategori';
                                @endphp


                                <a
                                    href="{{ route('tasks.show', $task) }}"
                                    class="group flex items-start gap-3 border-b border-red-50 px-4 py-4 transition hover:bg-red-50/50 last:border-0 sm:items-center sm:gap-4 sm:px-6"
                                >

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-100 font-black text-red-600">
                                        !
                                    </div>


                                    <div class="min-w-0 flex-1">

                                        <p class="truncate font-bold text-slate-800 group-hover:text-red-600">
                                            {{ $task->judul }}
                                        </p>


                                        <div class="mt-1 flex flex-wrap items-center gap-2">

                                            <span class="max-w-full truncate rounded-full bg-slate-100 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide text-slate-500">
                                                {{ $categoryName }}
                                            </span>

                                            <span class="text-xs font-medium text-red-500">
                                                {{ $deadline->translatedFormat('d F Y') }}
                                            </span>

                                        </div>

                                    </div>


                                    <span class="hidden shrink-0 rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700 sm:inline-flex">
                                        {{ $daysOverdue }} hari
                                    </span>


                                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-50 text-red-500 transition group-hover:bg-red-100">
                                        →
                                    </span>

                                </a>

                            @endforeach

                        </div>

                    </section>

                @elseif ($dueSoonCount > 0)

                    <section class="mt-5 flex items-start gap-3 rounded-[1.5rem] border border-rose-100 bg-rose-50 px-4 py-4 sm:mt-6 sm:items-center sm:gap-4 sm:rounded-[1.75rem] sm:px-6 sm:py-5">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-rose-100">
                            ⏰
                        </div>

                        <div class="min-w-0">

                            <h3 class="font-bold text-rose-900">
                                Ada {{ $dueSoonCount }} tugas yang mendekati deadline
                            </h3>

                            <p class="mt-1 text-sm font-medium text-rose-600">
                                Pastikan tugas-tugas tersebut selesai tepat waktu.
                            </p>

                        </div>

                    </section>

                @else

                    <section class="mt-5 flex items-start gap-3 rounded-[1.5rem] border border-emerald-100 bg-emerald-50 px-4 py-4 sm:mt-6 sm:items-center sm:gap-4 sm:rounded-[1.75rem] sm:px-6 sm:py-5">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-emerald-100">
                            ✓
                        </div>

                        <div class="min-w-0">

                            <h3 class="font-bold text-emerald-900">
                                Semua aman terkendali
                            </h3>

                            <p class="mt-1 text-sm font-medium text-emerald-700">
                                Tidak ada deadline yang mendesak dalam 7 hari ke depan.
                            </p>

                        </div>

                    </section>

                @endif


                {{-- ================================================= --}}
                {{-- PRIORITY TASKS --}}
                {{-- ================================================= --}}
                @if ($priorityTasks->count() > 0)

                    <section class="mt-5 overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white shadow-sm sm:mt-6 sm:rounded-[1.75rem]">

                        <div class="flex items-center justify-between gap-3 border-b border-slate-100 px-4 py-4 sm:px-6 sm:py-5">

                            <div class="flex min-w-0 items-center gap-3">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-amber-50 text-amber-600">
                                    ⏰
                                </div>

                                <div class="min-w-0">

                                    <h3 class="font-bold text-slate-900">
                                        Prioritas Deadline
                                    </h3>

                                    <p class="mt-1 truncate text-xs font-medium text-slate-400">
                                        Tugas yang perlu diperhatikan dalam 7 hari
                                    </p>

                                </div>

                            </div>


                            <a
                                href="{{ route('tasks.index') }}"
                                class="hidden shrink-0 text-sm font-bold text-indigo-600 hover:text-indigo-800 sm:block"
                            >
                                Lihat semua →
                            </a>

                        </div>


                        <div>

                            @foreach ($priorityTasks as $task)

                                @php
                                    $deadline = \Carbon\Carbon::parse($task->deadline);
                                    $daysLeft = now()->startOfDay()->diffInDays(
                                        $deadline->startOfDay(),
                                        false
                                    );
                                @endphp


                                <a
                                    href="{{ route('tasks.show', $task) }}"
                                    class="group flex items-start gap-3 border-b border-slate-100 px-4 py-4 transition hover:bg-slate-50 last:border-0 sm:items-center sm:gap-4 sm:px-6"
                                >

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-50 text-slate-400 transition group-hover:bg-indigo-50 group-hover:text-indigo-600">
                                        📌
                                    </div>


                                    <div class="min-w-0 flex-1">

                                        <p class="truncate font-bold text-slate-800 transition group-hover:text-indigo-600">
                                            {{ $task->judul }}
                                        </p>

                                        <p class="mt-1 text-xs font-medium text-slate-400">
                                            Deadline:
                                            {{ $deadline->translatedFormat('d F Y') }}
                                        </p>

                                    </div>


                                    @if ($daysLeft == 0)

                                        <span class="shrink-0 rounded-full bg-rose-100 px-2.5 py-1 text-[10px] font-bold text-rose-700 sm:px-3 sm:text-xs">
                                            Hari ini
                                        </span>

                                    @elseif ($daysLeft == 1)

                                        <span class="shrink-0 rounded-full bg-orange-100 px-2.5 py-1 text-[10px] font-bold text-orange-700 sm:px-3 sm:text-xs">
                                            Besok
                                        </span>

                                    @else

                                        <span class="shrink-0 rounded-full bg-amber-50 px-2.5 py-1 text-[10px] font-bold text-amber-700 sm:px-3 sm:text-xs">
                                            H-{{ $daysLeft }}
                                        </span>

                                    @endif


                                    <span class="hidden h-8 w-8 shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-400 transition group-hover:bg-indigo-100 group-hover:text-indigo-600 sm:flex">
                                        →
                                    </span>

                                </a>

                            @endforeach

                        </div>

                    </section>

                @endif


                {{-- ================================================= --}}
                {{-- TASK LIST --}}
                {{-- ================================================= --}}
                <section class="mt-5 overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white shadow-sm sm:mt-6 sm:rounded-[1.75rem]">

                    {{-- HEADER --}}
                    <div class="border-b border-slate-100 px-4 py-4 sm:px-6 sm:py-5">

                        <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">

                            {{-- TITLE --}}
                            <div class="flex min-w-0 items-center gap-3">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                                    📋
                                </div>

                                <div class="min-w-0">

                                    <div class="flex items-center gap-2">

                                        <h3 class="truncate font-bold text-slate-900">
                                            {{ $search || $category !== 'all'
                                                ? 'Hasil Filter'
                                                : 'Daftar Tugas'
                                            }}
                                        </h3>

                                        @if (!$search && $category === 'all')

                                            <span class="shrink-0 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-500">
                                                {{ $totalTasks }}
                                            </span>

                                        @endif

                                    </div>


                                    <p class="mt-1 truncate text-xs font-medium text-slate-400">

                                        @if ($search && $category !== 'all')

                                            Hasil pencarian "{{ $search }}" pada kategori terpilih

                                        @elseif ($search)

                                            Hasil untuk "{{ $search }}"

                                        @elseif ($category !== 'all')

                                            Tugas berdasarkan kategori

                                        @else

                                            Kelola dan pantau tugasmu

                                        @endif

                                    </p>

                                </div>

                            </div>


                            {{-- FILTER --}}
                            <div class="flex w-full min-w-0 flex-col gap-2 xl:w-auto">

                                <div class="flex w-full min-w-0 flex-col gap-2 sm:flex-row sm:flex-wrap xl:w-auto">

                                    {{-- SEARCH --}}
                                    <form
                                        action="{{ route('dashboard') }}"
                                        method="GET"
                                        class="flex w-full min-w-0 sm:flex-1 xl:w-auto xl:min-w-[260px]"
                                    >

                                        <input
                                            type="hidden"
                                            name="sort"
                                            value="{{ $sort }}"
                                        >

                                        @if ($category !== 'all')

                                            <input
                                                type="hidden"
                                                name="category"
                                                value="{{ $category }}"
                                            >

                                        @endif


                                        <div class="flex w-full min-w-0">

                                            <div class="relative min-w-0 flex-1">

                                                <input
                                                    type="text"
                                                    name="search"
                                                    value="{{ $search }}"
                                                    placeholder="Cari task..."
                                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-3 text-sm font-medium outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 sm:pr-4"
                                                >


                                                <svg
                                                    class="absolute left-3.5 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="m21 21-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"
                                                    />
                                                </svg>

                                            </div>


                                            <button
                                                type="submit"
                                                class="ml-2 shrink-0 rounded-2xl bg-indigo-600 px-4 py-3 text-sm font-bold text-white shadow-md shadow-indigo-600/20 transition hover:-translate-y-0.5 hover:bg-indigo-500 sm:px-5"
                                            >
                                                Cari
                                            </button>

                                        </div>

                                    </form>


                                    {{-- SORT --}}
                                    <form
                                        action="{{ route('dashboard') }}"
                                        method="GET"
                                        class="w-full sm:w-auto"
                                    >

                                        @if ($search)

                                            <input
                                                type="hidden"
                                                name="search"
                                                value="{{ $search }}"
                                            >

                                        @endif

                                        @if ($category !== 'all')

                                            <input
                                                type="hidden"
                                                name="category"
                                                value="{{ $category }}"
                                            >

                                        @endif


                                        <select
                                            name="sort"
                                            onchange="this.form.submit()"
                                            class="w-full rounded-2xl border border-slate-200 bg-white py-3 pl-4 pr-10 text-sm font-medium text-slate-600 outline-none transition focus:border-indigo-400 focus:ring-4 focus:ring-indigo-500/10 sm:w-auto"
                                        >

                                            <option
                                                value="latest"
                                                {{ $sort === 'latest' ? 'selected' : '' }}
                                            >
                                                🆕 Task Terbaru
                                            </option>

                                            <option
                                                value="deadline"
                                                {{ $sort === 'deadline' ? 'selected' : '' }}
                                            >
                                                ⏰ Deadline Terdekat
                                            </option>

                                        </select>

                                    </form>


                                    {{-- CATEGORY --}}
                                    <form
                                        action="{{ route('dashboard') }}"
                                        method="GET"
                                        class="w-full sm:w-auto"
                                    >

                                        @if ($search)

                                            <input
                                                type="hidden"
                                                name="search"
                                                value="{{ $search }}"
                                            >

                                        @endif


                                        <input
                                            type="hidden"
                                            name="sort"
                                            value="{{ $sort }}"
                                        >


                                        <select
                                            name="category"
                                            onchange="this.form.submit()"
                                            class="w-full rounded-2xl border border-slate-200 bg-white py-3 pl-4 pr-10 text-sm font-medium text-slate-600 outline-none transition focus:border-indigo-400 focus:ring-4 focus:ring-indigo-500/10 sm:w-auto"
                                        >

                                            <option value="all">
                                                📂 Semua Kategori
                                            </option>

                                            @foreach ($categories as $cat)

                                                <option
                                                    value="{{ $cat->id }}"
                                                    {{ (string) $category === (string) $cat->id ? 'selected' : '' }}
                                                >
                                                    📁 {{ $cat->nama_kategori }}
                                                </option>

                                            @endforeach

                                        </select>

                                    </form>


                                    {{-- RESET --}}
                                    @if ($search || $category !== 'all')

                                        <a
                                            href="{{ route('dashboard', ['sort' => $sort]) }}"
                                            class="flex w-full items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-600 transition hover:border-rose-200 hover:bg-rose-50 hover:text-rose-600 sm:w-auto"
                                        >
                                            Reset
                                        </a>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- TASK ITEMS --}}
                    @forelse ($tasks as $task)

                        @php
                            $categoryName = $task->category?->nama_kategori ?? 'Tanpa kategori';
                            $isDone = $task->status === 'Selesai';
                        @endphp


                        <div class="group flex items-start gap-3 border-b border-slate-100 px-4 py-4 transition hover:bg-slate-50/70 last:border-0 sm:items-center sm:gap-4 sm:px-6 sm:py-5">

                            {{-- STATUS --}}
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl {{ $isDone ? 'bg-emerald-50 text-emerald-600' : 'bg-indigo-50 text-indigo-600' }}">

                                @if ($isDone)

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

                                @else

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
                                            d="M9 5H7a2 2 0 00-2 2v11a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0M9 5h6"
                                        />
                                    </svg>

                                @endif

                            </div>


                            {{-- TASK INFO --}}
                            <div class="min-w-0 flex-1">

                                <a
                                    href="{{ route('tasks.show', $task) }}"
                                    class="block truncate text-sm font-bold transition-colors sm:text-base {{ $isDone ? 'text-slate-400 line-through' : 'text-slate-800 group-hover:text-indigo-600' }}"
                                >
                                    {{ $task->judul }}
                                </a>


                                <div class="mt-1.5 flex flex-wrap items-center gap-2">

                                    <span class="inline-flex max-w-full items-center gap-1.5 truncate rounded-full bg-slate-100 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide text-slate-500">
                                        📁 {{ $categoryName }}
                                    </span>


                                    @if ($task->deadline)

                                        <span class="shrink-0 text-xs font-medium text-slate-400">
                                            {{ \Carbon\Carbon::parse($task->deadline)->translatedFormat('d M Y') }}
                                        </span>

                                    @endif

                                </div>

                            </div>


                            {{-- PRIORITY --}}
                            @if ($task->priority)

                                @php
                                    $priorityClass = match ($task->priority) {
                                        'Rendah' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        'Sedang' => 'bg-amber-50 text-amber-700 border-amber-200',
                                        'Tinggi' => 'bg-rose-50 text-rose-700 border-rose-200',
                                        default => 'bg-slate-50 text-slate-600 border-slate-200',
                                    };
                                @endphp


                                <span
                                    class="hidden shrink-0 rounded-full border px-3 py-1 text-[10px] font-bold uppercase tracking-wide sm:inline-flex {{ $priorityClass }}"
                                >
                                    {{ $task->priority }}
                                </span>

                            @endif


                            {{-- STATUS --}}
                            @if ($isDone)

                                <span class="hidden shrink-0 rounded-full bg-emerald-50 px-3 py-1 text-[10px] font-bold text-emerald-700 lg:inline-flex">
                                    SELESAI
                                </span>

                            @endif


                            {{-- ARROW --}}
                            <a
                                href="{{ route('tasks.show', $task) }}"
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-400 transition-all hover:bg-indigo-100 hover:text-indigo-600 group-hover:-translate-x-1"
                            >
                                →
                            </a>

                        </div>


                    @empty

                        <div class="px-4 py-14 text-center sm:px-6 sm:py-16">

                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-[2rem] border border-slate-100 bg-slate-50 text-2xl">
                                🔎
                            </div>


                            <p class="mt-4 font-bold text-slate-800">

                                @if ($search || $category !== 'all')

                                    Task tidak ditemukan

                                @else

                                    Belum ada tugas

                                @endif

                            </p>


                            <p class="mx-auto mt-1 max-w-md text-sm font-medium text-slate-400">

                                @if ($search && $category !== 'all')

                                    Tidak ada task yang cocok dengan "{{ $search }}" pada kategori tersebut.

                                @elseif ($search)

                                    Tidak ada task yang cocok dengan "{{ $search }}".

                                @elseif ($category !== 'all')

                                    Tidak ada task pada kategori tersebut.

                                @else

                                    Yuk tambahkan tugas pertamamu sekarang!

                                @endif

                            </p>


                            @if ($search || $category !== 'all')

                                <a
                                    href="{{ route('dashboard', ['sort' => $sort]) }}"
                                    class="mt-5 inline-flex rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-md shadow-indigo-600/20 transition hover:-translate-y-0.5 hover:bg-indigo-500"
                                >
                                    Reset Filter
                                </a>

                            @else

                                <a
                                    href="{{ route('tasks.create') }}"
                                    class="mt-5 inline-flex rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-md shadow-indigo-600/20 transition hover:-translate-y-0.5 hover:bg-indigo-500"
                                >
                                    + Tambah Tugas Baru
                                </a>

                            @endif

                        </div>

                    @endforelse


                    {{-- VIEW ALL --}}
                    @if (!$search && $category === 'all' && $totalTasks > 5)

                        <div class="border-t border-slate-100 bg-slate-50/50 px-4 py-4 text-center sm:px-6">

                            <a
                                href="{{ route('tasks.index') }}"
                                class="text-sm font-bold text-indigo-600 transition hover:text-indigo-800"
                            >
                                Lihat semua {{ $totalTasks }} tugas →
                            </a>

                        </div>

                    @endif

                </section>


                {{-- ================================================= --}}
                {{-- TIPS --}}
                {{-- ================================================= --}}
                <section class="mt-5 flex items-start gap-3 rounded-[1.5rem] border border-indigo-100 bg-indigo-50/50 px-4 py-4 sm:mt-6 sm:gap-4 sm:rounded-[1.75rem] sm:px-6 sm:py-5">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                        💡
                    </div>

                    <div class="min-w-0">

                        <h3 class="font-bold text-indigo-900">
                            Tips Mengelola Tugas
                        </h3>

                        <p class="mt-1 text-sm font-medium leading-6 text-indigo-700">
                            Gunakan kategori, prioritas, dan deadline untuk menentukan
                            tugas mana yang harus diselesaikan terlebih dahulu.
                        </p>

                    </div>

                </section>

            </div>
        </main>

    </div>
</div>

</x-app-layout>
