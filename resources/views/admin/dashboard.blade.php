<x-app-layout>

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

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

            <span
                class="inline-flex w-fit items-center gap-2 rounded-full bg-indigo-50 px-3.5 py-1.5 text-sm font-semibold text-indigo-700 ring-1 ring-indigo-100"
            >

                <span class="relative flex h-2 w-2">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-indigo-400 opacity-60"></span>
                    <span class="relative inline-flex h-2 w-2 rounded-full bg-indigo-500"></span>
                </span>

                Mode Admin

            </span>

        </div>

    </x-slot>


    {{-- ========================================================= --}}
    {{-- MAIN --}}
    {{-- ========================================================= --}}

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-gray-50 to-indigo-50/30 py-8">

        <div class="mx-auto w-full max-w-7xl space-y-7 px-4 sm:px-6 lg:px-8">


            {{-- ================================================= --}}
            {{-- TOP BAR --}}
            {{-- ================================================= --}}

            <div class="flex items-center justify-end">

                <div class="flex items-center gap-3">

                    {{-- ADMIN INFO --}}

                    <div
                        class="hidden items-center gap-3 rounded-2xl border border-gray-100 bg-white px-4 py-2.5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md sm:flex"
                    >

                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-50 font-bold text-indigo-600 ring-1 ring-indigo-100"
                        >
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>

                        <div class="min-w-0">

                            <p class="max-w-40 truncate text-sm font-semibold text-gray-900">
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
                            class="group flex h-11 items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 text-sm font-medium text-gray-600 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-rose-200 hover:bg-rose-50 hover:text-rose-600 focus:outline-none focus:ring-4 focus:ring-rose-500/10"
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

            <section
                class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-slate-950 via-[#111936] to-indigo-950 px-6 py-9 text-white shadow-xl shadow-indigo-950/20 sm:px-9 sm:py-11"
            >

                <div class="relative z-10">

                    <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">

                        <div class="max-w-3xl">

                            {{-- BADGE --}}

                            <div
                                class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 text-xs font-semibold text-indigo-200 ring-1 ring-white/10 backdrop-blur-sm"
                            >

                                <span class="h-1.5 w-1.5 rounded-full bg-indigo-300"></span>

                                Pusat Monitoring Sistem

                            </div>


                            <p class="mt-5 text-sm font-medium text-indigo-300">
                                Selamat datang kembali
                            </p>


                            <h1 class="mt-1 text-3xl font-bold tracking-tight sm:text-4xl">
                                Halo, {{ Auth::user()->name }}!
                            </h1>


                            <p class="mt-4 max-w-2xl text-sm leading-6 text-slate-300 sm:text-base">
                                Pantau kondisi pengguna, task, prioritas, status,
                                dan deadline seluruh sistem TaskFlow dari satu dashboard.
                            </p>


                            {{-- HERO METRICS --}}

                            <div class="mt-7 grid grid-cols-1 gap-3 sm:grid-cols-3">

                                {{-- TOTAL TASK --}}

                                <div
                                    class="rounded-2xl bg-white/10 p-4 ring-1 ring-white/10 backdrop-blur-sm transition hover:bg-white/[0.14]"
                                >

                                    <div class="flex items-center justify-between">

                                        <span class="text-xs font-medium text-slate-400">
                                            Total Task
                                        </span>

                                        <svg
                                            class="h-4 w-4 text-indigo-300"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M9 12h6m-6 4h6M9 8h1m5 12H7a2 2 0 01-2-2V6a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a2 2 0 01.293.707V18a2 2 0 01-2 2z"
                                            />
                                        </svg>

                                    </div>

                                    <p class="mt-2 text-2xl font-bold">
                                        {{ $totalTasks }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Seluruh task sistem
                                    </p>

                                </div>


                                {{-- DUE SOON --}}

                                <div
                                    class="rounded-2xl bg-amber-400/10 p-4 ring-1 ring-amber-300/20 backdrop-blur-sm transition hover:bg-amber-400/[0.14]"
                                >

                                    <div class="flex items-center justify-between">

                                        <span class="text-xs font-medium text-amber-200/80">
                                            Mendekati Deadline
                                        </span>

                                        <svg
                                            class="h-4 w-4 text-amber-300"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"
                                            />
                                        </svg>

                                    </div>

                                    <p class="mt-2 text-2xl font-bold text-amber-100">
                                        {{ $dueSoonTasks }}
                                    </p>

                                    <p class="mt-1 text-xs text-amber-200/60">
                                        Perlu diperhatikan
                                    </p>

                                </div>


                                {{-- OVERDUE --}}

                                <div
                                    class="rounded-2xl bg-rose-400/10 p-4 ring-1 ring-rose-300/20 backdrop-blur-sm transition hover:bg-rose-400/[0.14]"
                                >

                                    <div class="flex items-center justify-between">

                                        <span class="text-xs font-medium text-rose-200/80">
                                            Terlambat
                                        </span>

                                        <svg
                                            class="h-4 w-4 text-rose-300"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 9v4m0 4h.01M10.29 3.86l-7.82 14A2 2 0 004.22 21h15.56a2 2 0 001.75-3.14l-7.82-14a2 2 0 00-3.42 0z"
                                            />
                                        </svg>

                                    </div>

                                    <p class="mt-2 text-2xl font-bold text-rose-100">
                                        {{ $overdueTasks }}
                                    </p>

                                    <p class="mt-1 text-xs text-rose-200/60">
                                        Melewati deadline
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- HERO SIDE STAT --}}

                        <div class="hidden shrink-0 lg:block">

                            @php
                                $completionRate = $totalTasks > 0
                                    ? round(($selesaiTasks / $totalTasks) * 100)
                                    : 0;
                            @endphp

                            <div
                                class="flex h-48 w-48 flex-col items-center justify-center rounded-full border border-white/10 bg-white/5 shadow-inner backdrop-blur-sm"
                            >

                                <div
                                    class="flex h-36 w-36 flex-col items-center justify-center rounded-full bg-slate-950/70 ring-1 ring-white/10"
                                >

                                    <span class="text-3xl font-bold">
                                        {{ $completionRate }}%
                                    </span>

                                    <span class="mt-1 text-xs font-medium text-slate-400">
                                        Task Selesai
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- DECORATIVE --}}

                <div class="absolute -right-24 -top-28 h-80 w-80 rounded-full bg-indigo-400/10"></div>

                <div class="absolute -bottom-36 right-20 h-72 w-72 rounded-full bg-indigo-500/10"></div>

                <div class="absolute -left-28 bottom-[-110px] h-56 w-56 rounded-full bg-blue-500/5"></div>

            </section>


            {{-- ================================================= --}}
            {{-- USER STATISTICS --}}
            {{-- ================================================= --}}

            <section>

                <div class="mb-4">

                    <div class="flex flex-col justify-between gap-2 sm:flex-row sm:items-end">

                        <div>

                            <h3 class="text-lg font-bold text-gray-900">
                                Statistik Pengguna
                            </h3>

                            <p class="mt-1 text-sm text-gray-400">
                                Ringkasan akun yang terdaftar dalam sistem.
                            </p>

                        </div>

                        <span class="text-xs font-medium text-gray-400">
                            {{ $totalUsers }} akun terdaftar
                        </span>

                    </div>

                </div>


                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">


                    {{-- TOTAL USER --}}

                    <div
                        class="group relative overflow-hidden rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-indigo-100 hover:shadow-xl hover:shadow-indigo-100/40"
                    >

                        <div class="flex items-start justify-between">

                            <div>

                                <p class="text-sm font-semibold text-gray-500">
                                    Total User
                                </p>

                                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900">
                                    {{ $totalUsers }}
                                </p>

                            </div>

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 ring-1 ring-indigo-100"
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
                                        d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m6-10a4 4 0 100-8 4 4 0 000 8zm10 10v-2a4 4 0 00-3-3.87m-1-8a4 4 0 010 7.75"
                                    />
                                </svg>

                            </div>

                        </div>

                        <p class="mt-4 text-xs text-gray-400">
                            Semua akun yang terdaftar
                        </p>

                        <div class="absolute -bottom-8 -right-8 h-20 w-20 rounded-full bg-indigo-50 opacity-0 transition group-hover:opacity-100"></div>

                    </div>


                    {{-- ADMIN --}}

                    <div
                        class="group relative overflow-hidden rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-indigo-100 hover:shadow-xl hover:shadow-indigo-100/40"
                    >

                        <div class="flex items-start justify-between">

                            <div>

                                <p class="text-sm font-semibold text-gray-500">
                                    Total Admin
                                </p>

                                <p class="mt-2 text-3xl font-bold tracking-tight text-indigo-600">
                                    {{ $totalAdmins }}
                                </p>

                            </div>

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 ring-1 ring-indigo-100"
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
                                        d="M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4z"
                                    />
                                </svg>

                            </div>

                        </div>

                        <p class="mt-4 text-xs text-gray-400">
                            Pengelola sistem TaskFlow
                        </p>

                    </div>


                    {{-- REGULAR USER --}}

                    <div
                        class="group relative overflow-hidden rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-emerald-100 hover:shadow-xl hover:shadow-emerald-100/40"
                    >

                        <div class="flex items-start justify-between">

                            <div>

                                <p class="text-sm font-semibold text-gray-500">
                                    Pengguna Biasa
                                </p>

                                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900">
                                    {{ $totalRegularUsers }}
                                </p>

                            </div>

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 ring-1 ring-emerald-100"
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
                                        d="M17 20h5v-2a4 4 0 00-4-4h-1m-2-10a4 4 0 110 8 4 4 0 000-8zM2 20h10v-2a5 5 0 00-10 0v2zm5-8a4 4 0 100-8 4 4 0 000 8z"
                                    />
                                </svg>

                            </div>

                        </div>

                        <p class="mt-4 text-xs text-gray-400">
                            Pengguna utama TaskFlow
                        </p>

                    </div>


                    {{-- CATEGORY --}}

                    <div
                        class="group relative overflow-hidden rounded-3xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-violet-100 hover:shadow-xl hover:shadow-violet-100/40"
                    >

                        <div class="flex items-start justify-between">

                            <div>

                                <p class="text-sm font-semibold text-gray-500">
                                    Total Kategori
                                </p>

                                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900">
                                    {{ $totalCategories }}
                                </p>

                            </div>

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-2xl bg-violet-50 text-violet-600 ring-1 ring-violet-100"
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
                                        d="M4 6h16M4 12h16M4 18h10"
                                    />
                                </svg>

                            </div>

                        </div>

                        <p class="mt-4 text-xs text-gray-400">
                            Kategori yang tersedia
                        </p>

                    </div>

                </div>

            </section>


            {{-- ================================================= --}}
            {{-- TASK OVERVIEW --}}
            {{-- ================================================= --}}

            <section>

                <div class="mb-4">

                    <h3 class="text-lg font-bold text-gray-900">
                        Statistik Task
                    </h3>

                    <p class="mt-1 text-sm text-gray-400">
                        Distribusi status dan tingkat penyelesaian task seluruh pengguna.
                    </p>

                </div>


                <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">


                    {{-- STATUS CARD --}}

                    <div
                        class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm lg:col-span-2"
                    >

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-sm font-semibold text-gray-900">
                                    Distribusi Status
                                </p>

                                <p class="mt-1 text-xs text-gray-400">
                                    Kondisi task saat ini
                                </p>

                            </div>

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
                                        d="M3 12h18M12 3v18"
                                    />
                                </svg>

                            </div>

                        </div>


                        @php
                            $totalForPercentage = max((int) $totalTasks, 1);

                            $belumPercentage = round(($belumTasks / $totalForPercentage) * 100);
                            $prosesPercentage = round(($prosesTasks / $totalForPercentage) * 100);
                            $selesaiPercentage = round(($selesaiTasks / $totalForPercentage) * 100);
                        @endphp


                        {{-- BELUM --}}

                        <div class="mt-7">

                            <div class="flex items-center justify-between text-sm">

                                <div class="flex items-center gap-2">

                                    <span class="h-2.5 w-2.5 rounded-full bg-amber-500"></span>

                                    <span class="font-semibold text-gray-700">
                                        Belum
                                    </span>

                                </div>

                                <span class="font-bold text-gray-900">
                                    {{ $belumTasks }}
                                    <span class="ml-1 text-xs font-medium text-gray-400">
                                        ({{ $belumPercentage }}%)
                                    </span>
                                </span>

                            </div>

                            <div class="mt-2 h-2 overflow-hidden rounded-full bg-gray-100">

                                <div
                                    class="h-full rounded-full bg-amber-500 transition-all duration-500"
                                    style="width: {{ min($belumPercentage, 100) }}%"
                                ></div>

                            </div>

                        </div>


                        {{-- PROSES --}}

                        <div class="mt-5">

                            <div class="flex items-center justify-between text-sm">

                                <div class="flex items-center gap-2">

                                    <span class="h-2.5 w-2.5 rounded-full bg-indigo-500"></span>

                                    <span class="font-semibold text-gray-700">
                                        Proses
                                    </span>

                                </div>

                                <span class="font-bold text-gray-900">
                                    {{ $prosesTasks }}
                                    <span class="ml-1 text-xs font-medium text-gray-400">
                                        ({{ $prosesPercentage }}%)
                                    </span>
                                </span>

                            </div>

                            <div class="mt-2 h-2 overflow-hidden rounded-full bg-gray-100">

                                <div
                                    class="h-full rounded-full bg-indigo-500 transition-all duration-500"
                                    style="width: {{ min($prosesPercentage, 100) }}%"
                                ></div>

                            </div>

                        </div>


                        {{-- SELESAI --}}

                        <div class="mt-5">

                            <div class="flex items-center justify-between text-sm">

                                <div class="flex items-center gap-2">

                                    <span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span>

                                    <span class="font-semibold text-gray-700">
                                        Selesai
                                    </span>

                                </div>

                                <span class="font-bold text-gray-900">
                                    {{ $selesaiTasks }}
                                    <span class="ml-1 text-xs font-medium text-gray-400">
                                        ({{ $selesaiPercentage }}%)
                                    </span>
                                </span>

                            </div>

                            <div class="mt-2 h-2 overflow-hidden rounded-full bg-gray-100">

                                <div
                                    class="h-full rounded-full bg-emerald-500 transition-all duration-500"
                                    style="width: {{ min($selesaiPercentage, 100) }}%"
                                ></div>

                            </div>

                        </div>

                    </div>


                    {{-- COMPLETION RATE --}}

                    <div
                        class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 to-indigo-800 p-6 text-white shadow-lg shadow-indigo-900/20"
                    >

                        <div class="relative z-10">

                            <div class="flex items-center justify-between">

                                <div>

                                    <p class="text-sm font-semibold text-indigo-100">
                                        Completion Rate
                                    </p>

                                    <p class="mt-1 text-xs text-indigo-200/70">
                                        Tingkat penyelesaian task
                                    </p>

                                </div>

                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/10"
                                >

                                    <svg
                                        class="h-5 w-5 text-indigo-100"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 12l4 4L19 6"
                                        />
                                    </svg>

                                </div>

                            </div>


                            <div class="mt-8">

                                <div class="flex items-end gap-1">

                                    <span class="text-5xl font-bold tracking-tight">
                                        {{ $completionRate }}
                                    </span>

                                    <span class="mb-1 text-xl font-semibold text-indigo-200">
                                        %
                                    </span>

                                </div>

                                <p class="mt-2 text-sm text-indigo-200">
                                    {{ $selesaiTasks }} dari {{ $totalTasks }} task telah selesai.
                                </p>

                            </div>


                            <div class="mt-7 h-2 overflow-hidden rounded-full bg-white/10">

                                <div
                                    class="h-full rounded-full bg-white transition-all duration-500"
                                    style="width: {{ min($completionRate, 100) }}%"
                                ></div>

                            </div>

                        </div>


                        {{-- DECORATIVE --}}

                        <div class="absolute -right-12 -top-12 h-40 w-40 rounded-full bg-white/5"></div>

                        <div class="absolute -bottom-20 -left-10 h-48 w-48 rounded-full bg-indigo-400/10"></div>

                    </div>

                </div>

            </section>


            {{-- ================================================= --}}
            {{-- PRIORITY DISTRIBUTION --}}
            {{-- ================================================= --}}

            <section>

                <div class="mb-4">

                    <h3 class="text-lg font-bold text-gray-900">
                        Distribusi Prioritas
                    </h3>

                    <p class="mt-1 text-sm text-gray-400">
                        Jumlah task berdasarkan tingkat prioritas.
                    </p>

                </div>


                <div class="grid grid-cols-1 gap-5 md:grid-cols-3">


                    {{-- RENDAH --}}

                    <div
                        class="group rounded-3xl border border-emerald-100 bg-gradient-to-br from-emerald-50 via-white to-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-emerald-100/50"
                    >

                        <div class="flex items-center justify-between">

                            <div>

                                <div class="flex items-center gap-2">

                                    <span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span>

                                    <p class="text-sm font-semibold text-emerald-700">
                                        Prioritas Rendah
                                    </p>

                                </div>

                                <p class="mt-3 text-3xl font-bold text-gray-900">
                                    {{ $rendahTasks }}
                                </p>

                                <p class="mt-1 text-xs text-gray-400">
                                    Task prioritas rendah
                                </p>

                            </div>

                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-emerald-600 shadow-sm ring-1 ring-emerald-100"
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
                                        d="M19 13l-7 7-7-7m7 7V4"
                                    />
                                </svg>

                            </div>

                        </div>

                    </div>


                    {{-- SEDANG --}}

                    <div
                        class="group rounded-3xl border border-amber-100 bg-gradient-to-br from-amber-50 via-white to-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-amber-100/50"
                    >

                        <div class="flex items-center justify-between">

                            <div>

                                <div class="flex items-center gap-2">

                                    <span class="h-2.5 w-2.5 rounded-full bg-amber-500"></span>

                                    <p class="text-sm font-semibold text-amber-700">
                                        Prioritas Sedang
                                    </p>

                                </div>

                                <p class="mt-3 text-3xl font-bold text-gray-900">
                                    {{ $sedangTasks }}
                                </p>

                                <p class="mt-1 text-xs text-gray-400">
                                    Task prioritas sedang
                                </p>

                            </div>

                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-amber-600 shadow-sm ring-1 ring-amber-100"
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
                                        d="M12 8v8m-4-4h8"
                                    />
                                </svg>

                            </div>

                        </div>

                    </div>


                    {{-- TINGGI --}}

                    <div
                        class="group rounded-3xl border border-rose-100 bg-gradient-to-br from-rose-50 via-white to-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-rose-100/50"
                    >

                        <div class="flex items-center justify-between">

                            <div>

                                <div class="flex items-center gap-2">

                                    <span class="h-2.5 w-2.5 rounded-full bg-rose-500"></span>

                                    <p class="text-sm font-semibold text-rose-700">
                                        Prioritas Tinggi
                                    </p>

                                </div>

                                <p class="mt-3 text-3xl font-bold text-gray-900">
                                    {{ $tinggiTasks }}
                                </p>

                                <p class="mt-1 text-xs text-gray-400">
                                    Task prioritas tinggi
                                </p>

                            </div>

                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-rose-600 shadow-sm ring-1 ring-rose-100"
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
                                        d="M12 19V5m-6 6l6-6 6 6"
                                    />
                                </svg>

                            </div>

                        </div>

                    </div>

                </div>

            </section>


            {{-- ================================================= --}}
            {{-- QUICK ACCESS --}}
            {{-- ================================================= --}}

            <section
                class="relative overflow-hidden rounded-3xl border border-indigo-100 bg-gradient-to-br from-indigo-50 via-white to-slate-50 p-6 shadow-sm"
            >

                <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                    <div class="flex items-start gap-4">

                        <div
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white text-indigo-600 shadow-sm ring-1 ring-indigo-100"
                        >

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
                                Akses Administrasi
                            </h3>

                            <p class="mt-1 max-w-2xl text-sm leading-6 text-indigo-700">
                                Kelola akun pengguna atau buka halaman monitoring
                                untuk melihat task seluruh pengguna TaskFlow.
                            </p>

                        </div>

                    </div>


                    <div class="flex flex-col gap-3 sm:flex-row">


                        {{-- USER MANAGEMENT --}}

                        <a
                            href="{{ route('admin.users') }}"
                            class="group inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-700 px-5 py-3 text-sm font-semibold text-white shadow-md shadow-indigo-950/20 transition duration-200 hover:-translate-y-0.5 hover:bg-indigo-800 hover:shadow-lg"
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
                                    d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m6-10a4 4 0 100-8 4 4 0 000 8zm10 10v-2a4 4 0 00-3-3.87m-1-8a4 4 0 010 7.75"
                                />
                            </svg>

                            Manajemen User

                            <svg
                                class="h-4 w-4 transition-transform group-hover:translate-x-0.5"
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


                        {{-- MONITORING --}}

                        <a
                            href="{{ route('admin.tasks.monitoring') }}"
                            class="group inline-flex items-center justify-center gap-2 rounded-xl border border-indigo-200 bg-white px-5 py-3 text-sm font-semibold text-indigo-700 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-indigo-300 hover:bg-indigo-50 hover:shadow-md"
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
                                    d="M3 12s3-7 9-7 9 7 9 7-3 7-9 7-9-7-9-7z"
                                />

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="2.5"
                                />
                            </svg>

                            Monitoring Task

                            <svg
                                class="h-4 w-4 transition-transform group-hover:translate-x-0.5"
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


                <div class="absolute -right-16 -top-20 h-56 w-56 rounded-full bg-indigo-100/50"></div>

            </section>


            {{-- ================================================= --}}
            {{-- RECENT USERS --}}
            {{-- ================================================= --}}

            <section
                class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm"
            >

                <div
                    class="flex flex-col gap-4 border-b border-gray-100 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6"
                >

                    <div>

                        <div class="flex items-center gap-2">

                            <h3 class="font-semibold text-gray-900">
                                User Terbaru
                            </h3>

                            <span class="rounded-full bg-indigo-50 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-indigo-600">
                                Live
                            </span>

                        </div>

                        <p class="mt-1 text-xs text-gray-400">
                            Lima pengguna terbaru yang terdaftar
                        </p>

                    </div>


                    <div class="flex items-center gap-3">

                        <span
                            class="rounded-full bg-gray-100 px-3 py-1.5 text-xs font-medium text-gray-500"
                        >
                            {{ $totalUsers }} user
                        </span>

                        <a
                            href="{{ route('admin.users') }}"
                            class="text-sm font-semibold text-indigo-600 transition hover:text-indigo-800"
                        >
                            Lihat semua
                        </a>

                    </div>

                </div>


                @forelse ($users as $user)

                    @php

                        $userName = $user->name ?? 'User';

                        $userRole = $user->role ?? 'user';

                        $isAdmin = strtolower($userRole) === 'admin';

                        $initial = strtoupper(substr($userName, 0, 1));

                        $taskCount = $user->tasks_count
                            ?? optional($user->tasks)->count()
                            ?? 0;

                    @endphp


                    <div
                        class="group border-b border-gray-50 px-5 py-5 transition duration-200 last:border-0 hover:bg-indigo-50/20 sm:px-6"
                    >

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                            {{-- USER --}}

                            <div class="flex min-w-0 items-center gap-4">

                                <div
                                    class="relative flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-slate-800 to-indigo-700 text-lg font-bold text-white shadow-sm"
                                >

                                    {{ $initial }}

                                    <span
                                        class="absolute -bottom-0.5 -right-0.5 h-3 w-3 rounded-full border-2 border-white bg-emerald-500"
                                    ></span>

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


                            {{-- META --}}

                            <div class="flex flex-wrap items-center gap-3 sm:justify-end">

                                @if ($isAdmin)

                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-indigo-100 px-3 py-1.5 text-xs font-semibold text-indigo-800"
                                    >

                                        <span class="h-1.5 w-1.5 rounded-full bg-indigo-600"></span>

                                        Admin

                                    </span>

                                @else

                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700"
                                    >

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
                                    class="inline-flex items-center gap-1.5 rounded-xl px-3 py-2 text-sm font-medium
                                    {{ $taskCount > 0
                                        ? 'bg-indigo-50 text-indigo-700'
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
                                            d="M9 12h6m-6 4h6M9 8h1m5 12H7a2 2 0 01-2-2V6a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a2 2 0 01.293.707V18a2 2 0 01-2 2z"
                                        />
                                    </svg>

                                    {{ $taskCount }} Tugas

                                </span>

                            </div>

                        </div>

                    </div>


                @empty

                    <div class="flex flex-col items-center justify-center px-6 py-16 text-center">

                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gray-100 text-gray-400"
                        >

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
                                    d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m6-10a4 4 0 100-8 4 4 0 000 8zm10 10v-2a4 4 0 00-3-3.87m-1-8a4 4 0 010 7.75"
                                />
                            </svg>

                        </div>

                        <p class="mt-4 font-semibold text-gray-900">
                            Belum ada pengguna
                        </p>

                        <p class="mt-1 text-sm text-gray-400">
                            Tambahkan pengguna pertama ke TaskFlow.
                        </p>

                    </div>

                @endforelse

            </section>


            {{-- ================================================= --}}
            {{-- ADMIN INFORMATION --}}
            {{-- ================================================= --}}

            <section
                class="rounded-3xl border border-indigo-100 bg-gradient-to-br from-indigo-50 to-slate-50 px-5 py-5 shadow-sm sm:px-6"
            >

                <div class="flex items-start gap-3">

                    <div
                        class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-indigo-600 shadow-sm"
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
                                d="M12 9v3.75m0 3.75h.007M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />

                        </svg>

                    </div>


                    <div>

                        <p class="font-semibold text-indigo-950">
                            Akses Admin
                        </p>

                        <p class="mt-1 text-sm leading-6 text-indigo-700">
                            Admin dapat mengelola akun pengguna dan memantau kondisi
                            task seluruh sistem. Pengelolaan task tetap dilakukan
                            oleh masing-masing user.
                        </p>

                    </div>

                </div>

            </section>


        </div>

    </div>

</x-app-layout>