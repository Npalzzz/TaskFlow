<x-app-layout>

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <x-slot name="header">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <div class="flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-indigo-500"></span>

                    <p class="text-sm font-semibold text-indigo-600">
                        TaskFlow Admin
                    </p>
                </div>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-gray-900">
                    Monitoring Task
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Pantau aktivitas task seluruh pengguna TaskFlow.
                </p>
            </div>


            {{-- READ ONLY BADGE --}}

            <div class="inline-flex w-fit items-center gap-2 rounded-full border border-indigo-100 bg-indigo-50 px-4 py-2 text-sm font-semibold text-indigo-700">

                <span class="relative flex h-2 w-2">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-indigo-400 opacity-75"></span>
                    <span class="relative inline-flex h-2 w-2 rounded-full bg-indigo-500"></span>
                </span>

                Read-Only Monitoring

            </div>

        </div>

    </x-slot>


    {{-- ========================================================= --}}
    {{-- MAIN --}}
    {{-- ========================================================= --}}

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-indigo-50/30 py-8">

        <div class="mx-auto w-full max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">


            {{-- ================================================= --}}
            {{-- NAVIGATION --}}
            {{-- ================================================= --}}

            <div class="flex items-center justify-between">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="group inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-600 shadow-sm transition duration-200 hover:-translate-x-0.5 hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-600"
                >

                    <svg
                        class="h-4 w-4 transition-transform duration-200 group-hover:-translate-x-0.5"
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


                {{-- ADMIN PROFILE --}}

                <div class="hidden items-center gap-3 sm:flex">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-700 text-sm font-bold text-white shadow-sm">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div>

                        <p class="text-sm font-semibold text-gray-900">
                            {{ Auth::user()->name }}
                        </p>

                        <p class="text-xs text-gray-400">
                            Administrator
                        </p>

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- HERO --}}
            {{-- ================================================= --}}

            <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-950 via-[#111936] to-indigo-950 px-6 py-8 text-white shadow-xl shadow-indigo-950/20 sm:px-8 sm:py-10">

                {{-- Decorative background --}}

                <div class="pointer-events-none absolute -right-24 -top-24 h-80 w-80 rounded-full bg-indigo-400/10"></div>

                <div class="pointer-events-none absolute -bottom-40 right-24 h-80 w-80 rounded-full bg-indigo-500/10"></div>

                <div class="pointer-events-none absolute -left-20 bottom-0 h-56 w-56 rounded-full bg-blue-500/5"></div>


                <div class="relative z-10">

                    {{-- Label --}}

                    <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-3 py-1.5 text-xs font-semibold text-indigo-200 backdrop-blur-sm">

                        <svg
                            class="h-3.5 w-3.5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 13h2l2-9 4 16 2-7h8"
                            />
                        </svg>

                        Monitoring Sistem

                    </div>


                    {{-- Title --}}

                    <h1 class="mt-4 max-w-3xl text-3xl font-bold tracking-tight sm:text-4xl">
                        Pantau Seluruh Task
                    </h1>


                    {{-- Description --}}

                    <p class="mt-4 max-w-2xl text-sm leading-6 text-slate-300 sm:text-base">

                        Admin dapat memantau task seluruh pengguna,
                        termasuk pemilik, kategori, prioritas, status,
                        dan deadline tanpa mengambil alih pengelolaan task.

                    </p>


                    {{-- Stats --}}

                    <div class="mt-7 grid grid-cols-1 gap-3 sm:flex sm:flex-wrap">

                        {{-- TOTAL TASK --}}

                        <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/10 px-4 py-3 backdrop-blur-sm">

                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-500/20 text-indigo-200">

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

                            </div>

                            <div>

                                <p class="text-xs text-slate-400">
                                    Total Task
                                </p>

                                <p class="text-sm font-bold text-white">
                                    {{ $tasks->total() }}
                                </p>

                            </div>

                        </div>


                        {{-- MODE --}}

                        <div class="flex items-center gap-3 rounded-2xl border border-emerald-400/10 bg-emerald-400/10 px-4 py-3 backdrop-blur-sm">

                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-400/10 text-emerald-300">

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
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                    />
                                </svg>

                            </div>

                            <div>

                                <p class="text-xs text-emerald-200/70">
                                    Mode Akses
                                </p>

                                <p class="text-sm font-bold text-emerald-300">
                                    Read-Only
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </section>


            {{-- ================================================= --}}
            {{-- SEARCH & FILTER --}}
            {{-- ================================================= --}}

            <section class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm">

                {{-- HEADER --}}

                <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

                    <div class="flex items-start gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <circle cx="11" cy="11" r="7"></circle>

                                <path
                                    stroke-linecap="round"
                                    d="M20 20l-4-4"
                                />
                            </svg>

                        </div>

                        <div>

                            <h3 class="font-semibold text-gray-900">
                                Cari & Filter Task
                            </h3>

                            <p class="mt-1 text-sm text-gray-400">
                                Gunakan pencarian dan filter untuk menemukan task tertentu.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- FORM --}}

                <form
                    method="GET"
                    action="{{ route('admin.tasks.monitoring') }}"
                    class="p-5 sm:p-6"
                >

                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">

                        {{-- SEARCH --}}

                        <div class="lg:col-span-6">

                            <label
                                for="search"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >
                                Pencarian
                            </label>

                            <div class="relative">

                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">

                                    <svg
                                        class="h-4 w-4"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                    >
                                        <circle cx="11" cy="11" r="7"></circle>

                                        <path
                                            stroke-linecap="round"
                                            d="M20 20l-4-4"
                                        />
                                    </svg>

                                </div>

                                <input
                                    id="search"
                                    name="search"
                                    type="text"
                                    value="{{ $search }}"
                                    placeholder="Judul, user, email, kategori..."
                                    class="block w-full rounded-xl border-gray-200 bg-gray-50 py-3 pl-11 pr-4 text-sm font-medium text-gray-900 placeholder:text-gray-400 transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                                >

                            </div>

                        </div>


                        {{-- STATUS --}}

                        <div class="lg:col-span-3">

                            <label
                                for="status"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >
                                Status
                            </label>

                            <select
                                id="status"
                                name="status"
                                class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm font-medium text-gray-700 transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                            >

                                <option value="">
                                    Semua Status
                                </option>

                                <option
                                    value="belum"
                                    {{ $status === 'belum' ? 'selected' : '' }}
                                >
                                    Belum
                                </option>

                                <option
                                    value="proses"
                                    {{ $status === 'proses' ? 'selected' : '' }}
                                >
                                    Proses
                                </option>

                                <option
                                    value="selesai"
                                    {{ $status === 'selesai' ? 'selected' : '' }}
                                >
                                    Selesai
                                </option>

                            </select>

                        </div>


                        {{-- PRIORITY --}}

                        <div class="lg:col-span-3">

                            <label
                                for="priority"
                                class="mb-2 block text-sm font-semibold text-gray-700"
                            >
                                Prioritas
                            </label>

                            <select
                                id="priority"
                                name="priority"
                                class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm font-medium text-gray-700 transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10"
                            >

                                <option value="">
                                    Semua Prioritas
                                </option>

                                <option
                                    value="rendah"
                                    {{ $priority === 'rendah' ? 'selected' : '' }}
                                >
                                    Rendah
                                </option>

                                <option
                                    value="sedang"
                                    {{ $priority === 'sedang' ? 'selected' : '' }}
                                >
                                    Sedang
                                </option>

                                <option
                                    value="tinggi"
                                    {{ $priority === 'tinggi' ? 'selected' : '' }}
                                >
                                    Tinggi
                                </option>

                            </select>

                        </div>

                    </div>


                    {{-- ACTIONS --}}

                    <div class="mt-5 flex flex-col gap-2 sm:flex-row sm:justify-end">

                        <a
                            href="{{ route('admin.tasks.monitoring') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-600 transition hover:border-gray-300 hover:bg-gray-50 hover:text-gray-900"
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
                                    d="M4 4v5h5M20 20v-5h-5M5.05 15a7 7 0 0011.9 2M18.95 9a7 7 0 00-11.9-2"
                                />
                            </svg>

                            Reset

                        </a>


                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:bg-indigo-700 hover:shadow-md"
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
                                    d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"
                                />
                            </svg>

                            Terapkan Filter

                        </button>

                    </div>

                </form>

            </section>


            {{-- ================================================= --}}
            {{-- TASK MONITORING --}}
            {{-- ================================================= --}}

            <section class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm">

                {{-- TABLE HEADER --}}

                <div class="flex flex-col gap-4 border-b border-gray-100 px-5 py-5 sm:px-6 md:flex-row md:items-center md:justify-between">

                    <div>

                        <div class="flex items-center gap-2">

                            <h3 class="font-semibold text-gray-900">
                                Seluruh Task
                            </h3>

                            <span class="inline-flex items-center rounded-full bg-indigo-50 px-2.5 py-1 text-[11px] font-bold text-indigo-700">
                                {{ $tasks->total() }}
                            </span>

                        </div>

                        <p class="mt-1 text-xs text-gray-400">
                            Data task dari seluruh pengguna TaskFlow
                        </p>

                    </div>


                    <div class="inline-flex w-fit items-center gap-2 rounded-xl bg-gray-50 px-3 py-2 text-xs font-medium text-gray-500">

                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                        Monitoring aktif

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- DESKTOP TABLE --}}
                {{-- ================================================= --}}

                <div class="hidden overflow-x-auto md:block">

                    <table class="min-w-full">

                        <thead>

                            <tr class="border-b border-gray-100 bg-slate-50/70">

                                <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-gray-500">
                                    Task
                                </th>

                                <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-gray-500">
                                    Pemilik
                                </th>

                                <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-gray-500">
                                    Kategori
                                </th>

                                <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-gray-500">
                                    Deadline
                                </th>

                                <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-gray-500">
                                    Prioritas
                                </th>

                                <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-gray-500">
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100">

                            @forelse ($tasks as $task)

                                @php

                                    $taskUser = $task->user;
                                    $taskCategory = $task->category;

                                    $userName = $taskUser->name ?? 'User tidak ditemukan';

                                    $initial = strtoupper(substr($userName, 0, 1));

                                    $statusValue = strtolower($task->status ?? '');
                                    $priorityValue = strtolower($task->priority ?? '');

                                    $isCompleted = $statusValue === 'selesai';
                                    $isInProgress = $statusValue === 'proses';
                                    $isPending = $statusValue === 'belum';

                                    $isHigh = $priorityValue === 'tinggi';
                                    $isMedium = $priorityValue === 'sedang';
                                    $isLow = $priorityValue === 'rendah';

                                    $isOverdue = $task->deadline
                                        && !$isCompleted
                                        && $task->deadline->isPast();

                                @endphp


                                <tr class="group transition duration-150 hover:bg-indigo-50/20">


                                    {{-- TASK --}}

                                    <td class="px-6 py-5">

                                        <div class="max-w-sm">

                                            <p class="truncate text-sm font-bold text-gray-900">
                                                {{ $task->judul }}
                                            </p>

                                            @if ($task->deskripsi)

                                                <p class="mt-1 line-clamp-2 text-xs leading-5 text-gray-400">
                                                    {{ $task->deskripsi }}
                                                </p>

                                            @else

                                                <p class="mt-1 text-xs italic text-gray-300">
                                                    Tidak ada deskripsi
                                                </p>

                                            @endif

                                        </div>

                                    </td>


                                    {{-- USER --}}

                                    <td class="px-6 py-5">

                                        <div class="flex items-center gap-3">

                                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-700 text-xs font-bold text-white shadow-sm">
                                                {{ $initial }}
                                            </div>

                                            <div class="min-w-0">

                                                <p class="max-w-40 truncate text-sm font-semibold text-gray-900">
                                                    {{ $userName }}
                                                </p>

                                                <p class="max-w-40 truncate text-xs text-gray-400">
                                                    {{ $taskUser->email ?? '-' }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- CATEGORY --}}

                                    <td class="px-6 py-5">

                                        @if ($taskCategory)

                                            <span class="inline-flex max-w-36 truncate items-center rounded-lg border border-indigo-100 bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700">

                                                {{ $taskCategory->nama_kategori }}

                                            </span>

                                        @else

                                            <span class="text-xs italic text-gray-400">
                                                Tanpa kategori
                                            </span>

                                        @endif

                                    </td>


                                    {{-- DEADLINE --}}

                                    <td class="px-6 py-5">

                                        @if ($task->deadline)

                                            <div class="flex flex-col">

                                                <span class="text-sm font-semibold {{ $isOverdue ? 'text-rose-600' : 'text-gray-700' }}">

                                                    {{ $task->deadline->translatedFormat('d M Y') }}

                                                </span>


                                                @if ($isOverdue)

                                                    <span class="mt-1 inline-flex w-fit items-center gap-1 text-xs font-semibold text-rose-500">

                                                        <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>

                                                        Terlambat

                                                    </span>

                                                @elseif (!$isCompleted && $task->deadline->isToday())

                                                    <span class="mt-1 inline-flex w-fit items-center gap-1 text-xs font-semibold text-amber-600">

                                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                                        Hari ini

                                                    </span>

                                                @elseif (!$isCompleted && now()->diffInDays($task->deadline, false) <= 7)

                                                    <span class="mt-1 inline-flex w-fit items-center gap-1 text-xs font-semibold text-amber-600">

                                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                                        Mendekati deadline

                                                    </span>

                                                @endif

                                            </div>

                                        @else

                                            <span class="text-xs italic text-gray-400">
                                                Tidak ada deadline
                                            </span>

                                        @endif

                                    </td>


                                    {{-- PRIORITY --}}

                                    <td class="px-6 py-5">

                                        @if ($isHigh)

                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-3 py-1.5 text-xs font-semibold text-rose-700">

                                                <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>

                                                Tinggi

                                            </span>

                                        @elseif ($isMedium)

                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700">

                                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                                Sedang

                                            </span>

                                        @elseif ($isLow)

                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">

                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                                Rendah

                                            </span>

                                        @else

                                            <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-500">

                                                {{ ucfirst($task->priority ?? '-') }}

                                            </span>

                                        @endif

                                    </td>


                                    {{-- STATUS --}}

                                    <td class="px-6 py-5">

                                        @if ($isCompleted)

                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">

                                                <span class="flex h-4 w-4 items-center justify-center rounded-full bg-emerald-100">

                                                    <svg
                                                        class="h-2.5 w-2.5"
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

                                                Selesai

                                            </span>

                                        @elseif ($isInProgress)

                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700">

                                                <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>

                                                Proses

                                            </span>

                                        @elseif ($isPending)

                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700">

                                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                                Belum

                                            </span>

                                        @else

                                            <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-500">

                                                {{ ucfirst($task->status ?? 'Tidak diketahui') }}

                                            </span>

                                        @endif

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td colspan="6">

                                        <div class="flex flex-col items-center justify-center px-6 py-20 text-center">

                                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-500">

                                                <svg
                                                    class="h-7 w-7"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.7"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <circle cx="11" cy="11" r="7"></circle>

                                                    <path
                                                        stroke-linecap="round"
                                                        d="M20 20l-4-4"
                                                    />
                                                </svg>

                                            </div>

                                            <p class="mt-4 font-semibold text-gray-900">
                                                Tidak ada task ditemukan
                                            </p>

                                            <p class="mt-1 max-w-md text-sm text-gray-400">
                                                Tidak ada task yang sesuai dengan pencarian atau filter yang digunakan.
                                            </p>

                                            <a
                                                href="{{ route('admin.tasks.monitoring') }}"
                                                class="mt-5 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700"
                                            >
                                                Reset Filter
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- ================================================= --}}
                {{-- MOBILE --}}
                {{-- ================================================= --}}

                <div class="divide-y divide-gray-100 md:hidden">

                    @forelse ($tasks as $task)

                        @php

                            $taskUser = $task->user;
                            $taskCategory = $task->category;

                            $userName = $taskUser->name ?? 'User tidak ditemukan';

                            $initial = strtoupper(substr($userName, 0, 1));

                            $statusValue = strtolower($task->status ?? '');
                            $priorityValue = strtolower($task->priority ?? '');

                            $isCompleted = $statusValue === 'selesai';
                            $isInProgress = $statusValue === 'proses';
                            $isPending = $statusValue === 'belum';

                            $isOverdue = $task->deadline
                                && !$isCompleted
                                && $task->deadline->isPast();

                        @endphp


                        <div class="p-5 transition hover:bg-indigo-50/20">


                            {{-- USER --}}

                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-700 text-sm font-bold text-white shadow-sm">

                                    {{ $initial }}

                                </div>

                                <div class="min-w-0">

                                    <p class="truncate text-sm font-bold text-gray-900">
                                        {{ $userName }}
                                    </p>

                                    <p class="truncate text-xs text-gray-400">
                                        {{ $taskUser->email ?? '-' }}
                                    </p>

                                </div>

                            </div>


                            {{-- TASK --}}

                            <div class="mt-5">

                                <p class="text-base font-bold text-gray-900">
                                    {{ $task->judul }}
                                </p>

                                @if ($task->deskripsi)

                                    <p class="mt-1 line-clamp-3 text-sm leading-5 text-gray-400">
                                        {{ $task->deskripsi }}
                                    </p>

                                @else

                                    <p class="mt-1 text-xs italic text-gray-300">
                                        Tidak ada deskripsi
                                    </p>

                                @endif

                            </div>


                            {{-- META --}}

                            <div class="mt-4 flex flex-wrap gap-2">

                                @if ($taskCategory)

                                    <span class="rounded-lg bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700">

                                        {{ $taskCategory->nama_kategori }}

                                    </span>

                                @endif


                                {{-- PRIORITY --}}

                                @if (strtolower($task->priority ?? '') === 'tinggi')

                                    <span class="rounded-lg bg-rose-50 px-3 py-1.5 text-xs font-semibold text-rose-700">
                                        Tinggi
                                    </span>

                                @elseif (strtolower($task->priority ?? '') === 'sedang')

                                    <span class="rounded-lg bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700">
                                        Sedang
                                    </span>

                                @elseif (strtolower($task->priority ?? '') === 'rendah')

                                    <span class="rounded-lg bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                                        Rendah
                                    </span>

                                @else

                                    <span class="rounded-lg bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-500">
                                        {{ ucfirst($task->priority ?? '-') }}
                                    </span>

                                @endif


                                {{-- STATUS --}}

                                @if ($isCompleted)

                                    <span class="rounded-lg bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                                        Selesai
                                    </span>

                                @elseif ($isInProgress)

                                    <span class="rounded-lg bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700">
                                        Proses
                                    </span>

                                @elseif ($isPending)

                                    <span class="rounded-lg bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700">
                                        Belum
                                    </span>

                                @else

                                    <span class="rounded-lg bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-500">
                                        {{ ucfirst($task->status ?? '-') }}
                                    </span>

                                @endif

                            </div>


                            {{-- DEADLINE --}}

                            <div class="mt-5 flex items-center gap-3 rounded-xl border px-4 py-3
                                {{ $isOverdue
                                    ? 'border-rose-100 bg-rose-50/70 text-rose-600'
                                    : 'border-gray-100 bg-gray-50 text-gray-500'
                                }}"
                            >

                                <svg
                                    class="h-4 w-4 shrink-0"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    />
                                </svg>


                                <div>

                                    <p class="text-[11px] font-medium uppercase tracking-wide opacity-70">
                                        Deadline
                                    </p>

                                    @if ($task->deadline)

                                        <p class="text-sm font-semibold">

                                            {{ $task->deadline->translatedFormat('d M Y') }}

                                        </p>

                                        @if ($isOverdue)

                                            <p class="text-xs font-semibold">
                                                Terlambat
                                            </p>

                                        @elseif (!$isCompleted && $task->deadline->isToday())

                                            <p class="text-xs font-semibold text-amber-600">
                                                Hari ini
                                            </p>

                                        @elseif (!$isCompleted && now()->diffInDays($task->deadline, false) <= 7)

                                            <p class="text-xs font-semibold text-amber-600">
                                                Mendekati deadline
                                            </p>

                                        @endif

                                    @else

                                        <p class="text-sm italic">
                                            Tidak tersedia
                                        </p>

                                    @endif

                                </div>

                            </div>

                        </div>


                    @empty

                        <div class="px-6 py-16 text-center">

                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-500">

                                <svg
                                    class="h-7 w-7"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                    viewBox="0 0 24 24"
                                >
                                    <circle cx="11" cy="11" r="7"></circle>

                                    <path
                                        stroke-linecap="round"
                                        d="M20 20l-4-4"
                                    />
                                </svg>

                            </div>

                            <p class="mt-4 font-semibold text-gray-900">
                                Tidak ada task ditemukan
                            </p>

                            <p class="mt-1 text-sm text-gray-400">
                                Coba ubah pencarian atau filter.
                            </p>

                        </div>

                    @endforelse

                </div>


                {{-- ================================================= --}}
                {{-- PAGINATION --}}
                {{-- ================================================= --}}

                @if ($tasks->hasPages())

                    <div class="border-t border-gray-100 bg-slate-50/60 px-5 py-4 sm:px-6">

                        {{ $tasks->links() }}

                    </div>

                @endif

            </section>


            {{-- ================================================= --}}
            {{-- READ ONLY INFORMATION --}}
            {{-- ================================================= --}}

            <section class="relative overflow-hidden rounded-3xl border border-indigo-100 bg-gradient-to-br from-indigo-50 via-white to-slate-50 px-5 py-5 shadow-sm sm:px-6">

                <div class="relative flex items-start gap-4">

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">

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

                        <div class="flex flex-wrap items-center gap-2">

                            <p class="font-semibold text-indigo-950">
                                Monitoring bersifat Read-Only
                            </p>

                            <span class="rounded-full bg-indigo-100 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-indigo-700">
                                Admin
                            </span>

                        </div>

                        <p class="mt-1 text-sm leading-6 text-indigo-700">

                            Admin dapat melihat informasi task seluruh pengguna
                            untuk keperluan monitoring sistem, tetapi tidak dapat
                            menambah, mengubah, atau menghapus task milik pengguna.

                            Pengelolaan task tetap menjadi tanggung jawab masing-masing user.

                        </p>

                    </div>

                </div>

            </section>


            {{-- ================================================= --}}
            {{-- FOOTER NOTE --}}
            {{-- ================================================= --}}

            <div class="pb-4 text-center">

                <p class="text-xs text-gray-400">
                    TaskFlow · Admin Monitoring
                </p>

            </div>


        </div>

    </div>

</x-app-layout>